<?php

require_once('configurationClass.php');
require_once(PATH . '/interfaces/databaseInterface.php');

/**
 * 
 */
class DatabaseHandler implements iDatabase
{
	private static $instance = NULL;
	private $dbConfig = array();


	/**
	 * Create the database object
	 * @return object Instance of DatabaseHandler Class
	 */
	public static function getInstance()
	{
		if (!isset(DatabaseHandler::$instance))
		{
			DatabaseHandler::$instance = new DatabaseHandler();
		}

		return DatabaseHandler::$instance;
	}

	/**
	 * Insert data in the database
	 * @param  string $table
	 * @param  array  $fields
	 * @param  array  $values 
	 * @return string Id of last inserted row
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


		return $this->databaseHandler->lastInsertId();
	}


	/**
	 * Updated information in the database
	 * @return int Rows affected
	 */
	public function update()
	{
		$arguments = func_get_args();

		// If the arguments are provided in an array,
		// flatten it first
		if(is_array($arguments) && count($arguments) == 1 && count($arguments[0])>1)
			$arguments = array_shift($arguments);

		$query = array_shift($arguments);

		$stmt = $this->databaseHandler->prepare($query);
		$stmt->execute($arguments);

		return $stmt->rowCount();
	}


	/**
	 * Extract information from the database
	 * @return array Data returned from the database
	 */
	public function read() // read('query', 'param1', 'param2', ...);
	{
		$arguments = func_get_args();

		$query = array_shift($arguments);

		$stmt = $this->databaseHandler->prepare($query);
		
		if(array_key_exists(0, $arguments) && is_array($arguments[0]))
			$stmt->execute($arguments[0]);
		else
			$stmt->execute($arguments);
		

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Read data from database and creates a object of type '<class>'
	 * @return <class> object
	 */
	public function readToClass() // readToClass('query', 'className');
	{
		$arguments = func_get_args();
		$class = array_pop($arguments); // Class name
		$query = array_shift($arguments); // Query

		$stmt = $this->databaseHandler->prepare($query);
		$stmt->execute($arguments);

		return $stmt->fetchAll(PDO::FETCH_CLASS, $class);
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

		return $stmt->rowCount(); // How many affected rows?
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
		$this->dbConfig = Configuration::getInstance()->getConfig('Database');

		if (!isset($this->databaseHandler))
		{
			// Custom error handler?
			$this->databaseHandler = new PDO('mysql:host=' . $this->dbConfig['Host'] .
					                         ';dbname=' . $this->dbConfig['DbName'] .
					                         ';charset=' . $this->dbConfig['Charset'],
					                          $this->dbConfig['User'], 
					                          $this->dbConfig['Password'],
					                          array(PDO::ATTR_EMULATE_PREPARES => false,
					                             	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
	}
}