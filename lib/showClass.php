<?php
    require_once("activeRecord.php");
	
	
    class Show extends ActiveRecord 
    {
    	private $_imdb_id, 
    	        $_zap2_id,
    	        $_banners = array(),
    	        $_pilot_date,
    	        $_name,
    	        $_summary,
    	        $_channel,
    	        $_rating,
    	        $_actors,
    	        $_lst_update,
				$_id;
		
		
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
			return $this->_getAttribute("imdb_id");	
		}
		
		
		/**
		 * Accessor for variable _zap2_url
		 * 
		 * @return string URL to zap2
		 */
		public function getZap2ID()
		{
			return $this->_getAttribute("zap2_id");
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
			return $this->_getAttribute("banners");
		}
		
		/**
		 * Accessor for variable _pilot_date
		 * 
		 * @return string Timestamp for pilot episode
		 */
		public function getPilotDate()
		{
			return $this->_getAttribute("pilot_date");
		}
		
		/**
		 * Accessor for variable _title
		 * 
		 * @return string Title of the show
		 */
		public function getTitle()
		{
			return $this->_getAttribute("name");
		}
		
		/**
		 * Accessor for variable _summary
		 * 
		 * @return string Summary synopsis of the show
		 */
		public function getSummary()
		{
			return $this->_getAttribute("summary");
		}
		
		/**
		 * Accessor for variable _channel
		 * 
		 * @return Channel Channel-object
		 */
		public function getChannel()
		{
			return $this->_getAttribute("channel_id");
		}
		
		/**
		 * Accessor for variable _rating
		 * 
		 * @return integer Rating (out of 10)
		 */
		public function getRating()
		{
			return $this->_getAttribute("rating");
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
			return $this->_getAttribute("actors");
		}
		
		/**
		 * Accessor for variable _last_update
		 * 
		 * @return string Timestamp of when data for this show was last updated
		 */
		public function getLastUpdate()
		{
			return $this->_getAttribute("lst_update");
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
				$this->_setAttribute("imdb_id", $id);
		}
		
		/**
		 * Mutator for variable _zap2_url
		 * 
		 * @param string $id
		 */
		public function setZap2URL($id = NULL)
		{
			if($id != NULL)
				$this->_setAttribute("zap2_id", $id);
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
				$this->_setAttribute("banners", $url, $index);
			else
			    $this->_setAttribute("banners", $url);	
		}
		
		
		/**
		 * Mutator for _pilot_date
		 * 
		 * @param string $date Date in any format because PHP is magical
		 */
		public function setPilotDate($date = NULL)
		{
			if($date != NULL)
				$this->_setAttribute("pilot_date", strtotime($date));

		} 
		
		/**
		 * Mutator for _title
		 * 
		 * @param string $title 
		 */
		public function setTitle($title = NULL)
		{
			if($title != NULL)
				$this->_setAttribute("title", $title);
		}
		
		/**
		 * Mutator for _summary
		 * 
		 * @param string $summary
		 */
		public function setSummary($summary = NULL)
		{
			if($summary != NULL)
				$this->_setAttribute("summary", $summary);
		}
		
		/**
		 * Mutator for _channel
		 * 
		 * @param integer $channel
		 * 
		 */
		 public function setChannel($channel)
		 {
		 	$this->_setAttribute("channel_id",$channel);
		 }
		 
		 /**
		  * Mutator for _rating
		  * 
		  * @param integer $rating
		  */
		  public function setRating($rating)
		  {
		  	$this->_setAttribute("rating", $rating);
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
					$this->_setAttribute("actors", $actor, $characterName);
				else
					$this->_setAttribute("actors", $actor);
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
			
			$this->_setAttribute("lst_update", $last_update);
		   }
		   
		   /**
		    * Mutator for _id
		    * Changing this to a non-existing ID will cause the creation of a new show.
		    * Uhm. Also, changing ID to the ID of another show 
		    * 
		    * @param integer $id
		    */
		    public function setID($id = NULL)
			{
				if($id != NULL)
					$this->_setAttribute("id", $id);
			}
		   
		   	
		   
		
    }
?>