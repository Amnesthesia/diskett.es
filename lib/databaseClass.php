<?php

require('../interfaces/databaseInterface.php');
require('../lib/customException.php');

error_reporting(-1);

/*
Singleton Pattern 
*/
class DatabaseHandler implements iDatabase
{
	public static $dbInstance = NULL;
	private $dbConfig = array();

	public static function getDbInstance()
	{
		if (!isset(DatabaseHandler::$dbInstance))
		{
			DatabaseHandler::$dbInstance = new DatabaseHandler();
		}

<<<<<<< HEAD
		// Her kan vi bruke en custom error handler
		$this->databaseHandler = new PDO('mysql:host=' . $this->dbConfig['Database']['Host'] .
				                         ';dbname=' . $this->dbConfig['Database']['DbName'] .
				                         ';charset=' . $this->dbConfig['Database']['Charset'],
				                          $this->dbConfig['Database']['User'], 
				                          $this->dbConfig['Database']['Password'],
				                          array(PDO::ATTR_EMULATE_PREPARES => false,
				                             	PDO::ATTR_ERRMODE => PDsuO::ERRMODE_EXCEPTION));
	}

	public function __destruct()
	{
		$this->databaseHandler = NULL;
=======
		return DatabaseHandler::$dbInstance;
>>>>>>> origin/Tommy
	}

	public function insert($table, $fields, $values)
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

	public function read($query)
	{
		$stmt = $this->databaseHandler->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function delete($query)
	{

	}

<<<<<<< HEAD
$db = new DatabaseHandler();
$db->read('SELECT * FROM `show`');
=======
	public function __destruct()
	{
		$this->databaseHandler = NULL;
	}

	private function __construct()
	{
		$this->dbConfig = parse_ini_file('../config/config.php', true); // Dette må gjøres på en bedre måte.

		if (!isset($this->databaseHandler))
		{
			// Her kan vi bruke en custom error handler
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

#$db = DatabaseHandler::getDbInstance();
#var_dump($db->read('SELECT `lst_update` FROM `show` WHERE `id` = 10'));

#$fields[] = 'id';
#$fields[] = 'imdb_id';
#$fields[] = 'zap2_id ';
#$fields[] = 'channel_id';
#$fields[] = 'banner_url';
#$fields[] = 'pilot_date';
#$fields[] = 'name';
#$fields[] = 'summary';
#$fields[] = 'lang';
#$fields[] = 'rating';
#$fields[] = 'lst_update';

#$values[] = '11';
#$values[] = '2321';
#$values[] = '31321';
#$values[] = '11';
#$values[] = 'http...';
#$values[] = '2014-02-05';
#$values[] = 'How I Met Your Mother';
#$values[] = 'Summary here...';
#$values[] = 'En';
#$values[] = '10';
#$values[] = '2014-02-05';

#$db->insert('`show`', $fields, $values);

#var_dump($db->read('SELECT * FROM `show`'));
>>>>>>> origin/Tommy
