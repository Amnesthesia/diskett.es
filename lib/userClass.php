<?php

require_once('../interfaces/userInterface.php');
require_once('databaseClass.php');

class User implements iUser
{
	// This is used when reading values from database:
	// (ie. an existing user)
	private $id,
			$email,
			$password,
			$role_id,
			$country_id;

	// This is used when creating a new user:
	private $fields = array('email', 'password', 'role_id', 'country_id');
	private $values = array();

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


	public function getId()
	{
		return $this->id;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getRoleId()
	{
		return $this->role_id;
	}

	public function getCountryId()
	{
		return $this->country_id;
	}


	public function setEmail($_mail)
	{
		$this->email = $_mail;
	}

	public function setPassword($_password)
	{
		$this->password = $_password;
	}

	public function setRoleId($_roleId = 0) 
	{
		$this->role_id = $_roleId;
	}

	public function setCountryId($_countryId) 
	{
		$this->country_id = $_countryId;
	}


	public function register()
	{
		$db = DatabaseHandler::getInstance();
		$db->insert('user', $this->fields, $this->values);
	}


	private function createHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}
}