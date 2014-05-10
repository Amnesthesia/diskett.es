<?php
    require_once("activeRecord.php");
    require_once("episodeClass.php");
	
	
    class Show extends ActiveRecord 
    {
    	private $_banners = array();
    	private $relationships = array(
 									array("relation" => "has_many",
										  "subject" => "episode"),

 									array("relation" => "belongs_to",
 										  "subject" => "channel")
									);
    	private $episodes = array();
		
		function __construct($id = 0)
		{
			if($id != 0)
				parent::__construct($id,$this->relationships);

			$e = $this->getChildren("Episode");

			if(count($e)>0)
				foreach($e as $ep)
				{
					$this->episodes[] = serialize($ep);
				}

		}
		
		/**
		 * Getters
		 */
    	
    	/**
		 * Accessor for variable _imdb_url
		 * 
		 * @return string URL to IMDb
		 */
    	public function getIMDbID()
		{
			return $this->getAttribute("imdb_id");	
		}
		
		
		/**
		 * Accessor for variable _zap2_url
		 * 
		 * @return string URL to zap2
		 */
		public function getZap2ID()
		{
			return $this->getAttribute("zap2_id");
		}
		
		
		/**
		 * Accessor for variable _banners
		 * 
		 * @param integer $single (Optional) Get banner at index 
		 * @return mixed    List of paths to banners (or single URL)
		 */
		public function getBanners($single = 0)
		{
			if($single > 0)
				if(array_key_exists($single, $this->_banners))
					return $this->_banners[$single];
			return $this->getAttribute("banners");
		}
		
		/**
		 * Accessor for variable _pilot_date
		 * 
		 * @return string Timestamp for pilot episode
		 */
		public function getPilotDate()
		{
			return $this->getAttribute("pilot_date");
		}
		
		/**
		 * Accessor for variable _title
		 * 
		 * @return string Title of the show
		 */
		public function getTitle()
		{
			return $this->getAttribute("name");
		}
		
		/**
		 * Accessor for variable _summary
		 * 
		 * @return string Summary synopsis of the show
		 */
		public function getSummary()
		{
			return $this->getAttribute("summary");
		}
		
		/**
		 * Accessor for variable _channel
		 * 
		 * @return Channel Channel-object
		 */
		public function getChannel()
		{
			return $this->getAttribute("channel_id");
		}
		
		/**
		 * Accessor for variable _rating
		 * 
		 * @return integer Rating (out of 10)
		 */
		public function getRating()
		{
			return $this->getAttribute("rating");
		}
		
		/**
		 * Accessor for variable _actors
		 * 
		 * @param string $character
		 * @return array Returns all actors if no character name provided
		 */
		public function getActors($character = NULL)
		{
			if($character != NULL)
				if(array_key_exists($character, $this->_actors))
					return $this->_character[$character];
			return $this->getAttribute("actors");
		}
		
		/**
		 * Accessor for variable _last_update
		 * 
		 * @return string Timestamp of when data for this show was last updated
		 */
		public function getLastUpdate()
		{
			return $this->getAttribute("lst_update");
		}


		/**
		 * "Wrapper" for static parent method -- returns list of objects instead of keys
		 *
		 * @return array
		**/
		static public function getList($index = 0, $column = "name", $descending = ASC)
		{
			/**
			 *	@todo THIS FUNCTION MAKES UNNECESSARILY MANY TRANSACTIONS. CUSTOMIZE QUERY FOR THIS, DON'T USE FIND().
			 */
			$q = "SELECT id,(SELECT count(*) FROM episode WHERE show_id=id) as episodecount FROM `show` ORDER BY `$column` ".($descending ? "DESC" : "ASC")." LIMIT ".$index.",".DEFAULT_LIST_SIZE;
			$rows = DatabaseHandler::getInstance()->read($q);
			foreach($rows as $row)
				$obj[] = new Show($row["id"]);
			

			return $obj;
		}
		
		/**
		 * Setters for member variables
		 */
		 
		 
		/**
		 * Mutator for variable _imdb_url
		 * 
		 * @param string $url
		 */
		public function setIMDbID($id = NULL)
		{
			if($id != NULL)
				$this->setAttribute("imdb_id", $id);
		}
		
		/**
		 * Mutator for variable _zap2_url
		 * 
		 * @param string $id
		 */
		public function setZap2URL($id = NULL)
		{
			if($id != NULL)
				$this->setAttribute("zap2_id", $id);
		}

		/**
		 * Mutator for _banners array
		 * If provided with index, update element at index,
		 * otherwise append URL to list. 
		 * 
		 * @param string $url
		 * 
		 */
		public function setBanners($url, $index = NULL)
		{
			if($index!=NULL)
				$this->setAttribute("banners", $url, $index);
			else
			    $this->setAttribute("banners", $url);	
		}
		
		
		/**
		 * Mutator for _pilot_date
		 * 
		 * @param string $date Date in any format because PHP is magical
		 */
		public function setPilotDate($date = NULL)
		{
			if($date != NULL)
				$this->setAttribute("pilot_date", strtotime($date));

		} 
		
		/**
		 * Mutator for _title
		 * 
		 * @param string $title 
		 */
		public function setTitle($title = NULL)
		{
			if($title != NULL)
				$this->setAttribute("title", $title);
		}
		
		/**
		 * Mutator for _summary
		 * 
		 * @param string $summary
		 */
		public function setSummary($summary = NULL)
		{
			if($summary != NULL)
				$this->setAttribute("summary", $summary);
		}
		
		/**
		 * Mutator for _channel
		 * 
		 * @param integer $channel
		 * 
		 */
		 public function setChannel($channel)
		 {
		 	$this->setAttribute("channel_id",$channel);
		 }
		 
		 /**
		  * Mutator for _rating
		  * 
		  * @param integer $rating
		  */
		  public function setRating($rating)
		  {
		  	$this->setAttribute("rating", $rating);
		  }
		  
		  /**
		   * Mutator for _actors array
		   * Updates Actor[Character Name] if provided with $characterName.
		   * Otherwise adds $actor to list
		   * 
		   * @param mixed $actor
		   * @param string $characterName
		   */
		   public function setActors($actor, $characterName = NULL)
		   {
		   	/**
			 * @todo Temporary -- not sure if class is Actor or Character
			 */
			 
		   	if(get_class($actor) == 'Actor' or get_class($actor) == 'Character')
			{
				if($characterName!=NULL)
					$this->setAttribute("actors", $actor, $characterName);
				else
					$this->setAttribute("actors", $actor);
			}
		}
		   
		   /**
		    * Mutator for _last_update
		    * If called without arguments, sets current time.
		    * 
		    * @param string $last_update Timestamp for last update of Show information
		    */
		   public function setLastUpdate($last_update = NULL)
		   {
		   	if($last_update == NULL)
				$last_update = time();
			
			$this->setAttribute("lst_update", $last_update);
		   }
		   
		   /**
		    * Mutator for id
		    * Changing this to a non-existing ID will cause the creation of a new show.
		    * Uhm. Also, changing ID to the ID of another show 
		    * 
		    * @param integer $id
		    */
		    public function setID($id = NULL)
			{
				if($id != NULL)
					$this->setAttribute("id", $id);
			}


			/**
			 * Returns episodes for REST API
			 */
			public function getEpisodes()
			{
				return $this->episodes;
			}
    }
?>