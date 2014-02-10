<?php
require_once("table.php");


class ActiveRecord
{
	private $__attributes = array(),
			$__modified = array(),
			$__new_record = true;
	
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
	public function setAttribute($name, $value, $index = -1)
	{
		if(is_array($this->__attributes[$name]))
		{
			if($index != -1)
				$this->__attributes[$index] = $value;
			else 
				$this->__attributes[] = $value;
			
		}
		else 
		{
			$this->__attributes[$name] = $value;
		}
		if($name == "id" && isset($this->__attributes["id"]))
			$this->__new_record = false;
		$this->__modified[$name] = 1;
	}
	
	public function create($id = NULL)
	{
		$db = DatabaseHandler::getInstance();
		
		$this->__attributes = array_shift($db->read("SELECT * FROM " . self::getTable()->getName() . " WHERE id = ?", $id));
		
	}
	
	
	
	public static function getTable()
	{
		return Table::load(get_called_class());
	}
	
	public function save()
	{
		
		$db = DatabaseHandler::getInstance();
		
		
		if($this->__new_record)
		{
			// Find out what columns have values
			$new_cols = array();
			$new_vals = array();
			
			foreach($this->__attributes as $colname => $colval)
				if(isset($colname) && isset($colval))
				{
					$new_cols[] = $colname;
					$new_vals[] = $colval;
				} 
			
			$this->_setAttribute("id", $db->insert(self::getTable()->getName(), $new_cols, $new_vals));
			$this->__new_record = false;
			
		}
		else 
		{
		 foreach($this->__modified as $column => $value)
		 {
			$col = "_".$column;
					
			if($value == 1)
			{
				$parameters[] = "UPDATE `".self::getTable()->getName()."` SET ? = ? WHERE id = ?;";
				$parameters[] = $column;
				$parameters[] = $this->__attributes[$column];
				$parameters[] = $this->__attributes["id"];
				
				$db->update($parameters);
			}
						
		 }	
		}
	}
}
?>