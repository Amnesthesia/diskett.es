<?php

require_once('databaseClass.php');
require_once('emailSenderClass.php');
require_once(PATH . '/interfaces/userInterface.php');

//DEBUG CODE, REMOVE
session_start();

/**
 * This class will represent either an existing user or a new user
 * The user object can be created without parameters if we want to
 * get a user's details from the database using the existing function
 * int DatabaseClass.
 */
class User implements iUser
{
	// This is used when reading values from database:
	// (ie. an existing user)
	private $id,
			$email,
			$password,
			$salt,
			$role_id,
			$country_id,
			$last_login;

	// This is used when creating a new user:
	private $fields = array('email', 'password', 'salt', 'role_id', 'country_id');
	private $values = array();


	/**
	 * Used to construct a new user object. The construct will only be 'valid',
	 * if we create a new user.
	 * @param string  $_email
	 * @param string  $_passwd
	 * @param string  $_salt
	 * @param int     $_roleId
	 * @param int     $_countryId
	 */
	public function __construct($_email = NULL, $_passwd = NULL, $_roleId = 0, $_countryId = NULL)
	{
		if (isset($_email) && isset($_passwd) && isset($_countryId)) //New user obj.?
		{
			$_salt = $this->createSalt();

			$this->values[] = $_email;
			$this->values[] = $this->createHash($_passwd, $_salt);
			$this->values[] = $_salt;
			$this->values[] = $_roleId;
			$this->values[] = $_countryId;
		}
	}

	/**
	 * Get the ID for this user
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the email address for this user
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the hashed password for this user
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	public function getSalt()
	{
		return $this->salt;
	}

	/**
	 * Get the role ID for this user
	 * @return int
	 */
	public function getRoleId()
	{
		return $this->role_id;
	}

	/**
	 * Get the country ID for this user
	 * @return int
	 */
	public function getCountryId()
	{
		return $this->country_id;
	}


	/**
	 * Set mail address for this user
	 * @param string $_mail
	 */
	public function setEmail($_mail)
	{
		$this->email = $_mail;
	}

	/**
	 * Set password for this user
	 * @param string $_password
	 */
	public function setPassword($_password)
	{
		$this->password = $_password;
	}

	/**
	 * Set the role ID for this user
	 * @param integer $_roleId
	 */
	public function setRoleId($_roleId = 0) 
	{
		$this->role_id = $_roleId;
	}

	/**
	 * Set the country ID for this user
	 * @param int $_countryId
	 */
	public function setCountryId($_countryId) 
	{
		$this->country_id = $_countryId;
	}

	/**
	 * Register/Save this user to the database
	 * @return int The ID this user was assigned in the database
	 */
	public function register()
	{
		$db = DatabaseHandler::getInstance();

		return $db->insert('user', $this->fields, $this->values);
	}

	/**
	 * Let a user login
	 * @param  string $password User's password
	 * @return [type]           [description]
	 */
	public function login($password)
	{
		if (password_verify($password . $this->getSalt(), $this->password))
		{
			$db = DatabaseHandler::getInstance();
			session_regenerate_id(true);
			$uniqueSessionToken = hash('sha1', session_id() . $this->getSalt());
			$_SESSION['token'] = $uniqueSessionToken;
			$_SESSION['uid'] = $this->getId();

			$db->update('UPDATE user SET last_activity=NOW() WHERE email=?', $this->email); // 9999-12-31 23:59:59
			$db->update("INSERT INTO user_session (id, session_data, session_ip)
						 VALUES (" . $this->getId() . ",'" . $uniqueSessionToken . "', '" . $_SERVER['REMOTE_ADDR'] . "')
			             ON DUPLICATE KEY
			                UPDATE session_data=?, session_ip=?", $uniqueSessionToken, $_SERVER['REMOTE_ADDR']);
		}
		else
		{
			// Password did not match, redirect user?
		}
	}

	public function forgotPassword() // This function may need to be rewritten!!!
	{
		// Not yet implemented
	}
	/**
	 * Logout a user and destroy and unset the current session
	 */
	public function logout()
	{
		// Delete user's entry in user_session
		
		session_unset();
		session_destroy();

		// Redirect to front page
	}

	public function forgotPassword() 
	{
		// Not yet implemented.
	}

	/**
	 * Check if a specific user is logged in.
	 * (This function is not pretty. Rewrite if possible)
	 * @return boolean User logged in or not
	 */
	public static function isLoggedIn()
	{
		$db = DatabaseHandler::getInstance();
		$timeExpired = NULL;


		if (!isset($_SESSION['uid'])) // Session is not set; user is not logged in
		{
			return false;
		}
		else // Session is set, check if session has expired:
		{
			$timeExpired = $db->read('SELECT COUNT(*) as exp
				                      FROM user 
				                      WHERE last_activity < (NOW() - INTERVAL 15 MINUTE) AND id=?', $_SESSION['uid']);

			if (!empty($timeExpired[0]['exp']))
			{
				session_unset();
				session_destroy();
			}
			else
			{
				$userData = $db->read('SELECT id
					                   FROM user_session 
					                   WHERE session_data=? AND session_ip=?', $_SESSION['token'], $_SERVER['REMOTE_ADDR']);

				if (!empty($userData[0]['id']))
				{
					User::updateSessionTime();

					return true; // Ip address and session id does match, user is logged in
				}
				else
					return false; // Ip address and session id does not match, possible session hijacking.
			}
		}
	}

	/**
	 * Updates a user's last activity entry in the database.
	 * @return int Rows affected by the query
	 */
	private static function updateSessionTime()
	{
		$db = DatabaseHandler::getInstance();

		return $db->update('UPDATE user 
			                SET last_activity=NOW() 
			                WHERE id=?', $_SESSION['uid']);
	}

	/**
	 * Hash the user's password so we can store it in the database, safely.
	 * @param  string $password
	 * @return string Password hash
	 */
	private function createHash($password, $salt)
	{
		// Striptag, stripslashes.
		return password_hash($password . $salt, PASSWORD_DEFAULT);
	}

	/**
	 * Generates a cryptographically strong salt
	 * @return string Salt
	 */
	private function createSalt()
	{
		return bin2hex(mcrypt_create_iv(30, MCRYPT_DEV_URANDOM));
	}
}

#$mail = $_GET['mail'];
#$user = DatabaseHandler::getInstance()->readToClass('SELECT * FROM `user` WHERE email=?', $mail, 'user');
#$user[0]->forgotPassword();

#var_dump($user);
#$user = DatabaseHandler::getInstance()->readToClass('SELECT * FROM user WHERE email=?', 'tommy.ingdal@gmail.com', 'User');

#$user[0]->login('1234');

#$user = new User('test@test.com', '1234', 0, 10);
#$user->register();
#
#$user[0]->logout();

#if (User::isLoggedIn())
#	echo "User is logged in.";
#else
#	echo "User is not logged in.";
