<?php

require_once("activeRecord.php");


class User extends ActiveRecord 
{
	private $_test_variable;
	
	public function getTestVariable()
	{
		return $this->_test_variable;
	}
}