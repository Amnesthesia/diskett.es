<?php
require_once("table.php");


class ActiveRecord
{
	private $attributes = array(),
			$modified = array(),
			$new_record = true,
			$relationships = array();
	
	function __construct($id = 0)
	{
		if($id > 0)
			$this->find($id);
	}		
	
	
	
	/**
	 * Sets an attribute (use this method even if you write custom setters!)
	 * 
	 * @param string $name
	 * @param string $value
	 */
	public function setAttribute($name, $value, $index = -1)
	{
		if(is_array($this->attributes[$name]))
		{
			if($index != -1)
				$this->attributes[$index] = $value;
			else 
				$this->attributes[] = $value;
			
		}
		else 
		{
			$this->attributes[$name] = $value;
		}
		if($name == "id" && isset($this->attributes["id"]))
			$this->__new_record = false;
		$this->modified[$name] = 1;
	}
	
	/**
	 * Gets an attribute (use this method even if you write custom getters)
	 * Returns NULL if none exists.
	 * 
	 * @param string $attr
	 * @return mixed
	 */
	public function getAttribute($attr)
	{
		if(array_key_exists($attr, $this->attributes))
			return $this->attributes[$attr];
		else
			return NULL;
	}
	
	/**
	 * Loads attributes from database into attributes
	 * and makes them accessible.
	 * 
	 * @param integer $id 	ID of row to instantiate
	 */
	public function find($id = NULL)
	{
		$db = DatabaseHandler::getInstance();
		
		
		foreach($this->__relationships as $relation)
		  if(isset($relation["relation"]) && isset($relation["subject"]) && isset($relation["using"]))
		  {
		      if($relation["relation"] == "has_one")
			  {
			  	$query = "SELECT `" . self::getTable()->getName() . "`.*,`".$relation["subject"]."`.id FROM `" . self::getTable()->getName() . "` ";
				$query .= "JOIN `".Table::getTable($relation["subject"])->getName()."` ";
				
				if(isset($relation["using"]))
				{
					if(is_array($relation["using"]) && count($relation["using"])>1)
						$query .= " ON (`".array_shift($relation["using"])."` = `".array_shift($relation["using"])."`);";
					else
						$query .= " USING ".$relation["using"].";";
						
				}
				
				$attr = $db->read($query,$id);
				
				$class = ucfirst($relation["subject"]);
				
				$this->attributes["has_one"] = new $class(array_pop($attr[0]));
					
			  }
			  else if($relation["relation"] == "has_many")
			  {
			  	
				
			  }
			  else if($relation["relation"] == "belongs_to")
			  {
			  	
				
			  }
			  else if($relation["relation"] == "many_many")
			  {
			  		
			  	
			  }
			
		  }	
		if(empty($this->__relationships))
			$query = "SELECT * FROM `" . self::getTable()->getName() . "` ";
			
		
		 "WHERE id = ?";
		
		
		$attr = $db->read($query, $id);
		$this->attributes = $attr[0];
	}
	
	
	/**
	 * Returns the table for the current class (lowercase version of class name)
	 * 
	 * @return Table
	 */
	public static function getTable()
	{
		return Table::load(get_called_class());
	}
	
	
	/**
	 * Saves the object (or creates new row if no existing ID)
	 * 
	 */
	public function save()
	{
		
		$db = DatabaseHandler::getInstance();
		
		// If new record, do an insert and toggle __new_record
		if($this->__new_record)
		{
			// Find out what columns have values
			$new_cols = array();
			$new_vals = array();
			
			foreach($this->attributes as $colname => $colval)
				if(isset($colname) && isset($colval))
				{
					$new_cols[] = $colname;
					$new_vals[] = $colval;
				} 
			
			$this->_setAttribute("id", $db->insert(self::getTable()->getName(), $new_cols, $new_vals));
			$this->__new_record = false;
			
		}
		// If an existing object, update row
		else 
		{
		 // Iterate through all attributes (columns) of this object
		 // and add column name, followed by value, to $modify array
		 $modify = array();
			
		 foreach($this->modified as $column => $value)
		 {
					
			if($value == 1)
			{
				$modify[] = $column;
				$modify[] = $this->attributes[$column];
			}
						
		 }	
		 
		 // Now, make ? = ? x amount of times split by comma in the query; 
		 // x being amount of fields to change
		 if(!empty($modify))
		 {
		 	$modify_query = "UPDATE `".self::getTable()->getName()."` SET " . implode(",",array_fill(0,(count($modify)/2),"? = ?"). "WHERE id = ?";
			
			// Prepend the query to the start of the array
			array_unshift($modify,$modify_query);
			
			
			// ... and execute it!
			$db->update($parameters);
		 }
		}
	}
}
?>