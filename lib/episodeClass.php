<?php

 /**
  * This class should now be set up enough to 
  * work with accessing or modifying table data.
  * 
  */
 
 class Episode extends ActiveRecord
 {
 	private $relationships = array(
 									array("relation" => "belongs_to",
										  "subject" => "show")
									);
	
	function __construct($id = 0)
	{
		if($id != 0)
			parent::__construct($id,$this->relationships);
	}
 }

?>