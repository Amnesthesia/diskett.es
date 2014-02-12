<?php

require_once('databaseClass.php');
require_once('userClass.php');

class UserSignup
{
	private $fields = array('email', 'password', 'country_id', 'role_id');
	private $values = array();


	public function __construct(User $userObj)
	{
		$this->values = array(
						$userObj->getEmail(), 
						$this->generateHash($userObj->getPassword()), 
						$userObj->getCountryId(), 
						$userObj->getRoleId()
							);
	}

	public function register()
	{
		$db = DatabaseHandler::getInstance();

		return $db->insert('user', $this->fields, $this->values);
	}

	private function generateHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}
}

$newUser = new User();

$newUser->setEmail('tommy.ingdal@gmail.com');
$newUser->setPassword('1234');
$newUser->setRoleId();
$newUser->setCountryId(10);

$userSignup = new UserSignup($newUser);
$userSignup->register();