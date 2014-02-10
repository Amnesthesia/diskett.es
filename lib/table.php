<?php
require_once("databaseClass.php");

class Table
{
	private $__table,              //Name of the table
            $__columns = array();  // List of columns
	private static $__table_cache = array(); // Keep table-data cached as static
	
	
	function __construct($class_name)
	{
		$this->__table = strtolower($class_name);
		$table_info = $this->_getTableInfo();
	
	}
	
	public static function load($class_name)
	{
		if(isset(self::$__table_cache[$class_name]))
			return self::$__table_cache[$class_name];
		else 
			self::$__table_cache[$class_name] = new Table($class_name);
		
		return self::$__table_cache[$class_name];	
	}
	
	/**
	 * Fetches information about table (column rows)
	 */
	private function _getTableInfo()
	{
		$db = DatabaseHandler::getInstance();
		
		foreach($db->read("DESCRIBE `".$this->__table."`") as $col_info)
		{
			if(array_key_exists("Field", $col_info))
				$this->__columns[] = $col_info["Field"]; 
		}
		
	}
	
	/**
	 * Returns name of table
	 */
	public function getName()
	{
		return $this->__table;
	}
	
	/**
	 * Returns list of column names
	 */
	public function getColumns()
	{
		return $this->__columns;
	}
	
    
    	
}

?>