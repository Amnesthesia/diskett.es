<?php
require_once("databaseClass.php");

class Table
{
	private $table,              //Name of the table
            $columns = array(),
			$primary_keys = array();  // List of columns
	private static $table_cache = array(); // Keep table-data cached as static
	
	
	function __construct($class_name)
	{
		$this->table = strtolower($class_name);
		$table_info = $this->getTableInfo();
	
	}
	
	public static function load($class_name)
	{
		if(isset(self::$table_cache[$class_name]))
			return self::$table_cache[$class_name];
		else 
			self::$table_cache[$class_name] = new Table($class_name);
		
		return self::$table_cache[$class_name];	
	}
	
	/**
	 * Fetches information about table (column rows)
	 */
	private function getTableInfo()
	{
		$db = DatabaseHandler::getInstance();
		
		foreach($db->read("DESCRIBE `".$this->table."`") as $col_info)
		{
			if(array_key_exists("Field", $col_info))
				$this->columns[] = $col_info["Field"]; 
		}
		
		foreach($db->read("SHOW keys FROM `".$this->table."` WHERE key_name = 'PRIMARY'") as $row)
			if(array_key_exists("Column_name", $row))
				$this->primary_keys[] = $row["Column_name"];
		
	}
	
	/**
	 * Returns the primary keys for this table
	 * 
	 * @return array
	 */
	public function getPrimaryKeys()
	{
		return $this->primary_keys;
	}
	
	/**
	 * Returns name of table
	 */
	public function getName()
	{
		return $this->table;
	}
	
	/**
	 * Returns list of column names
	 */
	public function getColumns()
	{
		return $this->columns;
	}
}