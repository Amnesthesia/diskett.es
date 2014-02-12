<?php

require_once('databaseClass.php');
require_once('emailSenderClass.php');
require_once(PATH . '/interfaces/userInterface.php');

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
			$role_id,
			$country_id,
			$last_login;

	// This is used when creating a new user:
	private $fields = array('email', 'password', 'role_id', 'country_id');
	private $values = array();


	/**
	 * Used to construct a new user object. The construct will only be 'valid',
	 * if we create a new user.
	 * @param string  $_email
	 * @param string  $_passwd
	 * @param int     $_roleId
	 * @param int     $_countryId
	 */
	public function __construct($_email = NULL, $_passwd = NULL, $_roleId = 0, $_countryId = NULL)
	{
		if (isset($_email) && isset($_passwd) && isset($_countryId)) //New user obj.?
		{
			$this->values[] = $_email;
			$this->values[] = $this->createHash($_passwd);
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
		$db->insert('user', $this->fields, $this->values);
	}

	public function login($password)
	{
		if (password_verify($password, $this->password))
		{
			$db = DatabaseHandler::getInstance();
			$db->update('UPDATE user SET last_login=NOW() WHERE email=?', $this->email); // 9999-12-31 23:59:59

			// Password did match, do som session() shit right here...
		}
		else
		{
			// Password did not match, redirect user?
		}
	}

	public function forgotPassword() // This function may need to be rewritten!!!
	{		
		$mailSender = MailSender::getInstance();
		$db = DatabaseHandler::getInstance();

		$newPassword = hash('sha1', mt_rand(1, 999999) . $this->getEmail());

		$db->update('UPDATE `user` SET password=? WHERE email=?', $this->createHash($newPassword), $this->email);

		$message = 'Your new password is: ' . $newPassword . "\r\n";
		$message .= 'Remember to change your password after you login!' . "\r\n";

		return $mailSender->sendMail($this->email, 'Password Reset', $message);
	}

	/**
	 * Hash the user's password so we can store it in the database, safely.
	 * @param  string $password
	 * @return string Password hash
	 */
	private function createHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}
