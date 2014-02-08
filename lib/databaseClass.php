<?php

error_reporting(-1);

require('../interfaces/databaseInterface.php');
require('../lib/customException.php');


class DatabaseHandler extends customException implements iDatabase
{
	private $databaseHandler = NULL;
	private $dbConfig = array();
	//test


	public function __construct()
	{
		$this->dbConfig = parse_ini_file('../config/config.php', true); // Dette må gjøres på en bedre måte.


		// Her kan vi bruke en custom error handler
		$this->databaseHandler = new PDO('mysql:host=' . $this->dbConfig['Database']['Host'] .
				                         ';dbname=' . $this->dbConfig['Database']['DbName'] .
				                         ';charset=' . $this->dbConfig['Database']['Charset'],
				                          $this->dbConfig['Database']['User'], 
				                          $this->dbConfig['Database']['Password'],
				                          array(PDO::ATTR_EMULATE_PREPARES => false,
				                             	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

	public function __destruct()
	{
		$this->databaseHandler = NULL;
	}

	public function insert($query)
	{

	}

	public function update($query)
	{

	}

	public function read($query)
	{
		$stmt = $this->databaseHandler->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function delete($query)
	{

	}
}

$db = new DatabaseHandler();
$db->read('SELECT * FROM `show`');


?>
