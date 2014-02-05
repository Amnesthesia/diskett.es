<?php

error_reporting(-1);

/*
Host: 198.211.121.199
User: epguideuser
Password: (DJSIODH/NC&T#/)NC#
Database: epguide
*/

require('../interfaces/databaseInterface.php');
require('../lib/errorHandlingClass.php');


class DatabaseHandler extends errorHandling implements iDatabase
{
	private $databaseHandler = NULL;
	private $dbConfig = array();


	public function __construct()
	{
		$this->dbConfig = parse_ini_file('../config/config.php'); // Dette må gjøres på en bedre måte.

		echo $this->dbConfig['Host'];
	}

	public function __destruct()
	{
		$this->databaseHandler = NULL;
	}

	public function insert()
	{

	}

	public function update()
	{

	}

	public function read()
	{

	}

	public function delete()
	{

	}
}

$db = new DatabaseHandler();


?>
