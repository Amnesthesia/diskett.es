<?php
require_once("table.php");


class ActiveRecord
{
	private $__attributes = array(),
			$__modified = array();
	
	public function __call($name, $arguments)
	{
		if(substr($name,0,3) == "set")
		{
			echo "Got request";
			
			$underscore_capitals = strtolower(preg_replace('/([A-Z])/', '_$1', substr($name,3)));
			
			$this->$$underscore_capitals = array_shift($arguments);
			
			echo $this->$$varName;
			
		}
	}
	
	/**
	 * Sets an attribute (use this method even if you write custom setters!)
	 * 
	 * @param string $name
	 * @param string $value
	 */
	public function setAttribute($name, $value)
	{
		$this->__attributes[$name] = $value;
		$this->__modified[$name] = 1;
	}
	
	public static function getTable()
	{
		return Table::load(get_called_class());
	}
	
	public function save()
	{
		$db = DatabaseHandler::getDbInstance();
				
		$current = $$db->read("SELECT * FROM show WHERE id = ?", $this->_id);
				
		foreach($current as $column => $value)
		{
			$col = "_".$column;
					
			if($this->$$col != $value)
				$db->update("UPDATE `".strtolower(get_class($this))."` SET $" );
						
		}
	}
}
?>