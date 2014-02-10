<?php

require_once('databaseClass.php');
require_once('../interfaces/userInterface.php');

class User implements iUser
{
	private $id;
	private $email;
	private $password;
	private $role_id;
	private $country_id;


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

	public function setRoleId($_roleId) 
	{
		$this->role_id = $_roleId;
	}

	public function setCountryId($_countryId) 
	{
		$this->country_id = $_countryId;
	}
}