<?php
	require_once("apiClass.php");
	require_once("showClass.php");
	require_once("databaseClass.php");


	// It's easy to add more models to this class!
	// Just create a method named what the resource is called,
	// like "show" or "episode". Then, switch on the $this->verb
	// attribute and return what you want to return in JSON
	// for the 4 different actions: create, read, update, delete.
	class RestAPI extends API
	{
		private $db;

		public function __construct($request, $source)
		{
			parent::__construct($request);
			$this->db = DatabaseHandler::getInstance();
			
		}

		// Shortcut for fetching all (by plural)
		public function shows()
		{
			$args = func_get_args();
			$showkey = "shows";

			if(empty($args[0]) || $args[0] == NULL)
			{
				$query = "SELECT `show`.id as sid,
							 `show`.imdb_id as simdb,
							 `show`.zap2_id as szap2,
							 `show`.channel_id as schannel,
							 `show`.poster as sposter,
							 `show`.lang as slang,
							 `show`.pilot_date as spilot_date,
							 `show`.name as sname, 
							 `show`.summary as ssummary, 
							 `show`.rating as srating, 
							 `show`.lst_update as slst_update,
							 CONCAT(`episode`.`show_id`,',',`episode`.`season`,',',`episode`.`episode`) AS eid, 
							 `episode`.show_id as eshow,
							 `episode`.season as eseason,
							 `episode`.episode as eepisode, 
							 `episode`.name as ename, 
							 `episode`.summary as esummary, 
							 `episode`.date as edate FROM `show` 
							 LEFT JOIN `episode` ON (`show`.id = `episode`.show_id) 
							 ORDER BY srating ASC;";
							 $res = $this->db->read($query);
			}
			else
			{
				$qs = count($args[0]);
				$qmarks = array_fill(0,$qs,"?");
				$qmarks = implode($qmarks,",");

				$query = "SELECT `show`.id as sid,
							 `show`.imdb_id as simdb,
							 `show`.zap2_id as szap2,
							 `show`.channel_id as schannel,
							 `show`.poster as sposter,
							 `show`.lang as slang,
							 `show`.pilot_date as spilot_date,
							 `show`.name as sname, 
							 `show`.summary as ssummary, 
							 `show`.rating as srating, 
							 `show`.lst_update as slst_update,
							 CONCAT(`episode`.`show_id`,',',`episode`.`season`,',',`episode`.`episode`) AS eid, 
							 `episode`.show_id as eshow,
							 `episode`.season as eseason,
							 `episode`.episode as eepisode, 
							 `episode`.name as ename, 
							 `episode`.summary as esummary, 
							 `episode`.date as edate FROM `show` 
							 LEFT JOIN `episode` ON (`show`.id = `episode`.show_id) 
							 WHERE `show`.id IN (".$qmarks.") ORDER BY srating ASC;";

				$showkey = "show";
				$res = $this->db->read($query,$args[0]);
			}

			$data = array($showkey => array(), "episodes" => array());
			

			$unique = array();
			$map = array();

		
			$i = 0;

			foreach($res as $r)
			{
				// Each row contains the same show info for many episodes;
				// so make sure we keep the shows unique in the list and sort out 
				// the episode data.
				if(!in_array($r["sid"],$unique))
				{
					// Add the show ID to the unique-array
					$unique[] = $r["sid"];

					// Set up a map to map the shows ID to the key in the list
					$map[$r["sid"]] = $i++;
					$data[$showkey][] = array("id" => $r["sid"],
													 "imdb_id" => $r["simdb"],
													 "zap2_id" => $r["szap2"],
													 "channel_id" => $r["schannel"],
													 "poster" => $r["sposter"],
													 "lang" => $r["slang"],
													 "pilot_date" => $r["spilot_date"],
													 "name" => $r["sname"],
													 "summary" => $r["ssummary"],
													 "rating" => $r["srating"],
													 "lst_update" => $r["slst_update"],
													 "episodes" => array($r["eid"])
														);
				}
				// Continue adding episode IDs onto the show - use the map!
				else
					$data[$showkey][$map[$r["sid"]]]["episodes"][] = $r["eid"];

				$data["episodes"][] = array("id" => $r["eid"],
												"show_id" => $r["eshow"],
												"season" => $r["eseason"],
												"episode" => $r["eepisode"],
												"summary" => $r["esummary"],
												"date" => $r["edate"]);
			}

			return $data;

		}

		public function show()
		{
			$args = func_get_args();

			switch($this->verb)
			{

				case 'read':
					if(empty($args) || !$args[0])
					{	
						$data = array("shows" => array(), "episodes" => array());
						$showlist = Show::getList();
						$increment = 0;

						foreach($showlist as $s)
						{
							// Take all regular attributes and put them in the array
							// but also add episodes in a serialized manner under the
							// "episodes" key
							$data["shows"][$increment++] = array_merge($s->getAttributes(),array("episodes" => $s->getEpisodes()));
							var_dump($data);
							foreach($data["shows"][$increment]->getChildren("Episode") as $e)
							{
								$ep = new Episode($ep);
								$ep->setAttribute("id",serialize(array($ep->getAttribute("show_id"),$ep->getAttribute("season"),$ep->getAttribute("episode_id"))));

								$data["episodes"][] = $ep->getAttributes();
							}
							
						}			
					}
					else
					{
						$show = new Show($args[0]);
						$data["shows"][0] = array_merge($show->getAttributes(),array("episode" => array(1)));
						
					}
					return $data;
					break;
			}
		}

		// Fetch all episodes by owner show
		public function episodes()
		{
			$args = func_get_args();

			switch($this->verb)
			{

				case 'read':
					$episodes = array("episode" => array());
					
					
					foreach($args[0] as $argument)
					{
						$episode = new Episode(array(104641,0,1));
						$episode->setAttribute("show",$episode->getAttribute("show_id"));
						
						$episodes["episode"][] = array(1);
					}	

					return $episodes;
					break;
			}
		}

		public function episode()
		{
			$args = func_get_args();

			switch($this->verb)
			{

				case 'read':
					$episodes = array("episodes" => array());
					
					
					foreach($args[0] as $argument)
					{
						$episode = new Episode(array(104641,0,1));
						$episode->setAttribute("show",$episode->getAttribute("show_id"));
						
						$episodes["episode"][] = $episode->getAttributes();
					}	

					return $episodes;
					break;
			}
		}

		/*public function episode()
		{
			$args = func_get_args();

			switch($this->verb)
			{

				case 'read':
					
					$episode = new Episode($args[0]);
					return $episode->getAttributes();
					break;
			}
		}*/
	}
?>