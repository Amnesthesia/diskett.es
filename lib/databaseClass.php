<?php

require('../interfaces/databaseInterface.php');
require('../lib/customException.php');

error_reporting(1);

/**
 * 
 */
class DatabaseHandler implements iDatabase
{
	private static $dbInstance = NULL;
	private $dbConfig = array();


	/**
	 * Create the database object
	 * @return object Instance of DatabaseHandler Class
	 */
	public static function getDbInstance()
	{
		if (!isset(DatabaseHandler::$dbInstance))
		{
			DatabaseHandler::$dbInstance = new DatabaseHandler();
		}

		return DatabaseHandler::$dbInstance;
	}

	/**
	 * Insert data in the database
	 * @param  string $table
	 * @param  array  $fields
	 * @param  array  $values 
	 */
	public function insert($table, array $fields, array $values)
	{
		$queryFields = NULL;
		$queryValues = NULL;
		
		if (is_array($fields))
		{
			foreach($fields as $key => $field)
			{
				if ($key == 0)
					$queryFields .= $field;
				else
					$queryFields .= ', ' . $field;
			}
		}
		else
			$queryFields .= $fields;


		if (is_array($values))
		{
			foreach($values as $key => $value)
			{
				if ($key == 0)
					$queryValues .= '?';
				else
					$queryValues .= ', ?';
			}
		}
		else
			$queryValues .= ':value';

		$insertData = $this->databaseHandler->prepare('INSERT INTO ' . $table . ' ('. $queryFields .') VALUES (' . $queryValues . ')');


		if (is_array($values))
			$insertData->execute($values);
		else
			$insertData->execute(array(':value' => $values));
	}

	public function update($query)
	{

	}

	/**
	 * Extract information from the database
	 * @return array Data returned from the database
	 */
	public function read()
	{
		$arguments = func_get_args();
		$query = array_shift($arguments);

		$stmt = $this->databaseHandler->prepare($query);
		$stmt->execute($arguments);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Delete information in the database
	 * @param  string $table
	 * @param  int    $id
	 * @return int    Number of affected rows
	 */
	public function delete($table, $id)
	{
		$stmt = $this->databaseHandler->prepare('DELETE FROM ' . $table . 'WHERE id=:id');
		$stmt->bindValue(':id', $id, PDO::PARAM_STR);
		$stmt->execute();

		return $aff_row = $stmt->rowCount(); // How many affected rows?
	}

	/**
	 * Terminate the database connection
	 */
	public function __destruct()
	{
		$this->databaseHandler = NULL;
	}

	/**
	 * Connect to the database with the credentials stored in the config file
	 */
	private function __construct()
	{
		$this->dbConfig = parse_ini_file('../config/config.php', true); // Make a config class?

		if (!isset($this->databaseHandler))
		{
			// Custom error handler?
			$this->databaseHandler = new PDO('mysql:host=' . $this->dbConfig['Database']['Host'] .
					                         ';dbname=' . $this->dbConfig['Database']['DbName'] .
					                         ';charset=' . $this->dbConfig['Database']['Charset'],
					                          $this->dbConfig['Database']['User'], 
					                          $this->dbConfig['Database']['Password'],
					                          array(PDO::ATTR_EMULATE_PREPARES => false,
					                             	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
	}
}