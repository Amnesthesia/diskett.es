<?php
require_once("table.php");

/**
** @todo Move definitions of constants to config
*/



class ActiveRecord
{
	private $attributes = array(),
			$modified = array(),
			$new_record = true,
			$relationships = array(),
			$theoreticalRelationships = array();
	
	
	/**
	 * Creates an object based on its ID
	 * If an array is passed instead of ID, will mass-assign
	 * $id elements as attributes.
	 * 
	 * @param mixed $id
	 */
	function __construct($keys = array(), $relationships = array())
	{
		if(!empty($relationships))
			$this->theoreticalRelationships = $relationships;
		if(is_array($keys) && count($keys) > 0 && count($keys) !== count(self::getTable()->getPrimaryKeys()))
		{
			$this->attributes = $keys;
			
			// Assume this isn't a new record if it was mass-assigned;
			// but if ANY primary key is missing, set this to be a new record
			
			// Actually, don't assume anything because data may be imported and 
			// primary keys may or may not indicate a new entry. Check for their existence.
			#$this->new_record = false;

			$primaryKeyQuery = array();
			$primaryKeyValues = array();

			foreach(self::getTable()->getPrimaryKeys() as $k)
			{
				// If the primary key doesn't exist in mass-assignment,
				// this must be a new record
				if(!array_key_exists($k,$keys))
					$this->new_record = true;

				// Otherwise, add it to $primaryKeyValues for double-checking
				else
					$primaryKeyValues[] = $keys[$k];

			}

			// If all primary-keys existed and this *supposedly* is an existing
			// record, confirm it by checking the database for their existence
			if($this->new_record && count($primaryKeyValues))
			{
				if(self::exists($primaryKeyValues))
					$this->new_record = false;
			} 

		}
		else
			$this->find($keys);
	}		
	
	/**
	 * Checks for the existence of a row with specified primary key values in the database
	 *
	 * @param mixed $primaryKeyValues
	 * @return boolean
	 **/
	public static function exists($primaryKeyValues = array())
	{
		if(empty($primaryKeyValues))
			return;

		foreach(self::getTable()->getPrimaryKeys() as $k)
			$primaryKeyQuery[] = $k." = ?";

		$q = "SELECT count(*) as c FROM `".self::getTable()->getName()."` WHERE ".implode(" AND ",$primaryKeyQuery);
			
		$result = DatabaseHandler::getInstance()->read($q,$primaryKeyValues);

		if($result[0]["c"] > 0)
			return true;
		return false;
	} 
	
	
	/**
	 * Sets an attribute (use this method even if you write custom setters!)
	 * 
	 * @param string $name
	 * @param string $value
	 */
	public function setAttribute($name, $value, $index = -1)
	{
		if(array_key_exists($name,$this->attributes) && is_array($this->attributes[$name]))
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
		if(in_array($name,self::getTable()->getPrimaryKeys()) && isset($this->attributes[$name]))
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
	 * Gets all attributes
	 * Returns empty array if none exist.
	 * 
	 * @param string $attr
	 * @return mixed
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Gets all relationships (or relationships of a certain type)
	 * for the object
	 *
	 * @param string $type
	 * @return array
	**/
	public function getRelationships($type = NULL)
	{
		if($type!=NULL)
		{
			$rel = array();
			foreach($this->relationships as $r)
				if($r["type"] == $type)
					$rel[] = $r;
			return $rel;
		}
		return $this->relationships;
	}

	/**
	 * Gets parent object for objects with a "belongs_to" relationship
	 * and returns NULL for objects with other relationship types.
	 *
	 * @return class
	**/
	public function getParent()
	{
		foreach($this->relationships as $r)
			if($r["type"] == "belongs_to")
				return $r["object"];
		return NULL;
	}

	/**
	 * Gets sibling object for objects with a "has_one" relationship
	 * and returns NULL for objects with other relationship types.
	 *
	 * @return class
	**/
	public function getSibling()
	{
		foreach($this->relationships as $r)
			if($r["type"] == "has_one")
				return $r["object"];
		return NULL;
	}

	/**
	 * Gets child object for objects with one or more "has_many" relationships
	 * and returns NULL for objects with other relationship types.
	 *
	 * @param string $class
	 * @return class
	**/
	public function getChildren($class = NULL)
	{
		$children = array();
		foreach($this->relationships as $r)
			if($r["type"] == "has_many")
				if($class == NULL)
					$children[$r["class"]] = $r["object"];
				else
					return $r["object"];

		if(count($children)>0)
			return $children;
		return NULL;
	}

	/**
     * Gets a list of x row-items (as defined by DEFAULT_LIST_SIZE) sorted by $column 
     * starting at $index.
     * Returns an array of primary keys to instantiate objects from.
     *
     * @param string $column
     * @param integer $index
     * @param boolean $descending
    **/
   	static public function getKeyList($index = 0, $column = "name", $descending = ASC)
   	{
   		$query = "SELECT ".implode(",",self::getTable()->getPrimaryKeys())." FROM `".self::getTable()->getName()."` ORDER BY ".$column;
   		$query .= ($descending ? " DESC" : " ASC");
   		$query .= " LIMIT $index,".DEFAULT_LIST_SIZE;

   		return DatabaseHandler::getInstance()->read($query);
   	}
	
	/**
	 * Loads attributes from database into attributes
	 * and makes them accessible.
	 * 
	 * @param integer $keys 	Primary key(s) of row to instantiate
	 */
	public function find($keys = NULL)
	{
		$db = DatabaseHandler::getInstance();
		
		
		foreach($this->theoreticalRelationships as $relation)
		  if(isset($relation["relation"]) && isset($relation["subject"]))
		  {
		      if($relation["relation"] == "has_one" || $relation["relation"] == "belongs_to" )
			  {
			  	$query = "SELECT `" . self::getTable()->getName() . "`.*,`".$relation["subject"]."`.id as obj_id FROM `" . self::getTable()->getName() . "` ";
				
			  	/**
			  	 *	@todo Change JOIN statement from LEFT JOIN (using this during development when referenced rows may not exist)
			  	 **/
				$query .= "LEFT JOIN `".Table::load($relation["subject"])->getName()."` ";
				
				if(isset($relation["using"]) && is_array($relation["using"]) && count($relation["using"])>1)
				{
					$query .= " ON (`".array_shift($relation["using"])."` = `".array_shift($relation["using"])."`);";	
				}
				else
				{
					$query .= " ON `".self::getTable()->getName()."`";
					$query .= ".`".Table::load($relation["subject"])->getName()."_id";
					$query .= "` = `".Table::load($relation["subject"])->getName()."`.`id`";
				}

				$query .= " WHERE ";
				$tmpKeyQ = array();
				foreach(self::getTable()->getPrimaryKeys() as $pk)
					$tmpKeyQ[] = "`".self::getTable()->getName()."`.`".$pk."` = ?";

				if(count($tmpKeyQ)>1)
					$query .= implode(" AND ",$tmpKeyQ);
				else
					$query .= $tmpKeyQ[0];

				
				$attr = $db->read($query,$keys);
				
				$class = ucfirst($relation["subject"]);
				
				if(array_key_exists("obj_id", $attr))
				{
					$this->relationships[] = array("type" => $relation["relation"],
					                               "class" => $class, 
					                               "object" => new $class(array($attr[0]["obj_id"]))
					                               );
					unset($attr[0]["obj_id"]);
				}
				
				// If this is an array containing only an array, flatten it a bit
				if(count($attr) == 1)
					$attr = $attr[0];
					
			  }
			  else if($relation["relation"] == "has_many")
			  {
			  	
				// Get attributes for object first
				$query = "SELECT * FROM `".self::getTable()->getName()."` WHERE "; 

				// Append primary keys to query
				$tmpKeyQ = array();
				foreach(self::getTable()->getPrimaryKeys() as $pk)
					$tmpKeyQ[] = "`".$pk."` = ?";

				if(count($tmpKeyQ)>1)
					$query .= implode(",",$tmpKeyQ);
				else
					$query .= $tmpKeyQ[0];
				
				$query .= " LIMIT 1";
				$tmp_attr = $db->read($query,$keys);
				$attr = array_shift($tmp_attr);

				// Get primary keys for relationship-object
				$primary_keys = Table::load($relation["subject"])->getPrimaryKeys();
				
			  	$query = "SELECT ".implode(",",$primary_keys)." FROM `".Table::load($relation["subject"])->getName()."` WHERE `".self::getTable()->getName()."_id` = ?";
				
				$result = $db->read($query, $attr["id"]);
				
				
				$relationship_with = array();
				
				
				// Populate array with IDs of objects
				
				/**
				 * @todo Decide whether we should store list of IDs or list of objects
				 */
				 
				$class = ucfirst($relation["subject"]);
				
				if(!empty($result))
				foreach($result as $row)
				{
					$tmp_fields = array();
					foreach($primary_keys as $pk)
						$tmp_fields[] = $row[$pk];

					$relationship_with[] = $tmp_fields; // Alternative below:
					// $relationship_with[] = new $class($tmp_fields);

				} 
					
				
				$this->relationships[] = array("type" => "has_many",
									  "class" => $class,
									  "object" => $relationship_with
									  );				
				
			  }
			
		  }	
		if(empty($this->theoreticalRelationships))
		{
			$query = "SELECT * FROM `" . self::getTable()->getName() . "` WHERE ";
			
			$tmpKeyQ = array();
			foreach(self::getTable()->getPrimaryKeys() as $pk)
				$tmpKeyQ[] = "`".$pk."` = ?";

			if(count($tmpKeyQ)>1)
				$query .= implode(" AND ",$tmpKeyQ);
			else
				$query .= $tmpKeyQ[0];

			$attr = $db->read($query, $keys);
			$attr = $attr[0];
		}
		$this->new_record = false;
		$this->attributes = $attr;

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
	 * @deprecated
	 */
	/*public function save()
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
		 // and add column name to $modify_col, followed by value in $modify array
		 $modify = array();
		 $modify_col = array();

		 foreach($this->modified as $column => $value)
		 {
					
			if($value == 1)
			{
				$modify_col[] = "`".$column."` = ?";
				$modify[] = $this->attributes[$column];
			}
						
		 }	
		 
		 // Now, make ? = ? x amount of times split by comma in the query; 
		 // x being amount of fields to change
		 if(!empty($modify))
		 {
		 	$modify_query = "UPDATE `".self::getTable()->getName()."` SET ".implode(",",$modify_col)." WHERE ";
			
			// Use the appropriate key(s)
			$tmpKeyQ = array();
			foreach(self::getTable()->getPrimaryKeys() as $pk)
			{
				$tmpKeyQ[] = "`".$pk."` = ?";
				$modify[] = $this->attributes[$pk];
			}

			if(count($tmpKeyQ)>1)
				$modify_query .= implode(" AND ",$tmpKeyQ);
			else
				$modify_query .= $tmpKeyQ[0];

			// Prepend the query to the start of the array
			array_unshift($modify,$modify_query);

			
			
			
			// ... and execute it!
			$db->update($modify);
		 }
		}
	}*/
	
	/**
	 * Saves the object (or creates new row if no existing ID)
	 * 
	 */
	public function save()
	{
		
		$db = DatabaseHandler::getInstance();
		

		// Find out what columns have values
		$cols = array();
		$vals = array();
		$updateCols = array();

		foreach($this->attributes as $colname => $colval)
		{
			// Skip this column if it's "obj_id" -- that column is solely for
			// relation-purposes :)
			if($colname == "obj_id")
				continue;

			$cols[] = $colname;
			$vals[] = $colval;
			$updateCols[] = "`".$colname."` = ?";
		} 
		
		 // Now, construct the query ...

		 $query = "INSERT INTO `".self::getTable()->getName()."` (`".implode("`,`", $cols)."`) VALUES (".implode(",",array_fill(0,count($this->attributes),"?")).")"; // Removed -1, do we need this?
		 $query .= " ON DUPLICATE KEY UPDATE ".implode(",",$updateCols);
			
		 // Throw all values (all cols and values ... twice) so far into an array ...
		 $modify = array_merge($vals,$vals);


		// Prepend the query to the start of the array
		array_unshift($modify,$query);

		// ... and execute it!
		$db->update($modify);
		 
		
	}
}
?>