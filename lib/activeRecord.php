<?php
require_once("table.php");


class ActiveRecord
{
	private $attributes = array(),
			$modified = array(),
			$new_record = true,
			$relationships = array();
	
	
	/**
	 * Creates an object based on its ID
	 * If an array is passed instead of ID, will mass-assign
	 * $id elements as attributes.
	 * 
	 * @param mixed $id
	 */
	function __construct($id = 0)
	{
		if(is_numeric($id) && $id > 0)
			$this->find($id);
		else if(is_array($id) && count($id) > 0)
		{
			$this->attributes = $id;
			
			if(isset($id["id"]) && is_numeric($id) && $id > 0)
				$this->new_record = false;
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
			$this->new_record = false;
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
		      if($relation["relation"] == "has_one" || $relation["relation"] == "belongs_to" )
			  {
			  	$query = "SELECT `" . self::getTable()->getName() . "`.*,`".$relation["subject"]."`.id as obj_id FROM `" . self::getTable()->getName() . "` ";
				$query .= "JOIN `".Table::getTable($relation["subject"])->getName()."` ";
				
				if(isset($relation["using"]))
				{
					if(is_array($relation["using"]) && count($relation["using"])>1)
						$query .= " ON (`".array_shift($relation["using"])."` = `".array_shift($relation["using"])."`);";
					else
					{
						$query .= " ON `".Table::load($relation["subject"])->getName()."`";
						$query .= ".`".Table::load($relation["subject"])->getName()."_".$relation["using"];
						$query .= "` = `".self::getTable()->getName()."`.`id`;";
					}
						
				}
				
				$attr = $db->read($query,$id);
				
				$class = ucfirst($relation["subject"]);
				
				if(array_key_exists("obj_id", $row[0]))
				{
					$this->relationships[] = array("type" => $relation["relation"],
					                               "class" => $class, 
					                               "object" => new $class($row[0]["obj_id"]));
					unset($row[0]["obj_id"]);
				}
				
					
			  }
			  else if($relation["relation"] == "has_many")
			  {
			  	
				// Get attributes for object first
				$tmp_attr = $db->read("SELECT * FROM `".self::getTable()->getName()."` WHERE `id` = ? LIMIT 1",$id);
				$this->attributes = $tmp_attr[0];
				
			  	$query = "SELECT `id` FROM `".Table::load($relation["subject"])->getName()."` WHERE `".self::getTable()->getName()."_id` = ?";
				
				$result = $db->read($query, $this->attributes["id"]);
				
				$relationship_with = array();
				
				
				// Populate array with IDs of objects
				
				/**
				 * @todo Decide whether we should store list of IDs or list of objects
				 */
				 
				$class = ucfirst($relation["subject"]);
				
				foreach($result as $row)
					$relationship_with[] = $row["id"]; // Alternative below:
					// $relationship_with[] = new $class($row["id"]); 
					
				
				$relationship = array("type" => "has_many",
									  "class" => $class,
									  "object" => $relationship_with
									  );
				
				
				
			  }
			
		  }	
		if(empty($this->__relationships))
		{
			$query = "SELECT * FROM `" . self::getTable()->getName() . "` WHERE `".self::getTable()->getName()."` id = ?";
			$attr = $db->read($query, $id);
			$attr = $attr[0];
		}
			
		
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
		
		// If new record, do an insert and toggle new_record
		if($this->new_record)
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
			
			$this->setAttribute("id", $db->insert(self::getTable()->getName(), $new_cols, $new_vals));
			$this->new_record = false;
			
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