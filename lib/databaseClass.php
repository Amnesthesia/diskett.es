<?php

error_reporting(-1);

require('../interfaces/databaseInterface.php');
require('../lib/customException.php');


class DatabaseHandler extends customException implements iDatabase
{
	private $databaseHandler = NULL;
	private $dbConfig = array();


	public function __construct()
	{
		$this->dbConfig = parse_ini_file('../config/config.php', true); // Dette må gjøres på en bedre måte.

		try
		{
			$this->databaseHandler = new PDO('mysql:host=' . $this->dbConfig['Databases']['Host'] .
				                             ';dbname=' . $this->dbConfig['Database']['DbName'] .
				                             ';charset=' . $this->dbConfig['Database']['Charset'],
				                             $this->dbConfig['Database']['User'], 
				                             $this->dbConfig['Database']['Password'],
				                             array(PDO::ATTR_EMULATE_PREPARES => false,
				                             	   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} 
		catch(Exception $e)
		{
			throw new customException('test', 'test', 10);
		}
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
