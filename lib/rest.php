<?php
	require_once("apiClass.php");
	require_once("showClass.php");
	require_once("databaseClass.php");

	/**
	** JSON Objects retrieved look like:
	** {users: {["id" : 1, "email" : "emailaddr",..], ["id" : 2,... ]}}
	** {user: {["id": 1], "email" : "emailaddr"} }
	**/

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

		// Method for logging in!
		public function session()
		{
			$args = func_get_args();
			switch($this->verb)
			{
				case 'create':
					return $this->verifyLogin($_POST["session"]);
				case 'read':
					return $this->authorizeSession($args[0]);
				case 'delete':
					return $this->deauthorizeSession($args[0]);
		
			}
			
		}

		/**
		 **	ALL VERBS GO HERE.
		 ** THESE METHODS REDIRECT TO PRIVATE METHODS
		 ** FOR FURTHER PROCESSING DEPENDING ON HTTP STATE.
		 **/

		// Retrieve, create or update user info
		public function users()
		{
			$args = func_get_args();
			switch($this->verb)
			{
				case 'create':
					return $this->createUser(array_shift($args));
				case 'read':
					return $this->getUsers(array_shift($args));
				case 'update':
					return $this->updateUsers(array_shift($args));

			}
		}

		// Fetch shows
		public function shows()
		{
			$args = func_get_args();

			switch($this->verb)
			{
				case 'read':
					return $this->getShows(array_shift($args));

			}

		}

		// Fetch all episodes by owner show
		public function episodes()
		{
			$args = func_get_args();

			switch($this->verb)
			{

				case 'read':
					return $this->getEpisodes(array_shift($args));
					break;
			}
		}

		// Follow a show
		public function follow()
		{
			switch($this->verb)
			{
				// This is really ugly, stupid and unconventional; dont do this...
				case 'read':
					return $this->followShow($_GET);
			}
		}

		// Mark an episode as watched
		public function watch()
		{
			switch($this->verb)
			{
				// this too..
				case 'read':
					return $this->watchEpisode($_GET);
			}
		}

		public function seen()
		{
			switch($this->verb)
			{
				case 'read':
					return $this->watchedEpisodes($_REQUEST);
			}
		}




		// Verify login information from email and password
		private function verifyLogin($session)
		{

			$email = $session["identification"];
			$password = $session["password"];

			$res = $this->db->read("SELECT id,salt,password FROM user WHERE email = ?",$email);

			if(!empty($res) && count($res[0])>0 && password_verify($password.$res[0]["salt"],$res[0]["password"]))
			{
				// Hash to use for this session
				$hash = hash("sha256",$res[0]["id"].$res[0]["salt"].time());
				
				// Save it ... and return it
				$this->db->insert("user_session",array("id", "session_data","session_ip"),array($res[0]["id"],$hash,$_SERVER["REMOTE_ADDR"]));

				return array("session" => array("token" => $hash, "user_id" => $res[0]["id"]));
			}
			else
				header('HTTP/1.0 401 Unauthorized');
		}

		// Verify that a session exists (return token if it does, otherwise return null)
		private function authorizeSession($session)
		{



			$res = $this->db->read("SELECT id FROM user_session WHERE session_data = ?",$session["session"]["token"]);

			if(!empty($res) && count($res[0])>0)
			{
				return array("session" => array("token" => $session));
			}
			else
				return array("session" => array("token" => NULL));
		}

		
		// Log a user out
		private function deauthorizeSession($session)
		{
			$res = $this->db->read("DELETE FROM user_session WHERE session_data = ?",$session[0]);
			return array("session" => array());
		}


		// Returns all episodes a user has watched from a series
		private function watchedEpisodes()
		{
			$args = array_shift(func_get_args());

			if(!isset($args["token"]) || !isset($args["sid"]))
				return array();

			$res = $this->db->read("SELECT episode_id FROM user_episodes WHERE user_id=(SELECT user_id FROM user_session WHERE session_data = ?) AND show_id = ?",$args["token"],$args["sid"]);
			$ids = array();

			foreach($res as $r)
				$ids[] = $r["episode_id"];

			return $ids;
		}


		// Let a user follow a show (or unfollow if it's already followed)
		private function followShow($args)
		{
			if(!isset($args['token']) || !isset($args['sid']))
				return array("session" => array("error" => 401));

			// Insert if nothing was deleted
			if(!$this->db->rowsChanged("DELETE FROM user_show WHERE user_id=(SELECT id FROM user_session WHERE session_data = ?) AND show_id=?;",array($args['token'],$args['sid'])))
			{
				$this->db->rowsChanged("REPLACE INTO user_show VALUES((SELECT id FROM user_session WHERE session_data = ?), ?,0);",array($args['token'],$args['sid']));
			}
			
			return array("session" => array("token" => $args['token']));
		}

		// Let a user mark an episode as watched (or unmark it if it's already watched)
		private function watchEpisode($args)
		{
			if(!isset($args['token']) || !isset($args['eid']))
				return $array;

			// Insert if nothing was deleted
			if(!$this->db->rowsChanged("DELETE FROM user_episodes WHERE user_id=(SELECT id FROM user_session WHERE session_data = ?) AND episode_id=?;",array($args['token'],$args['eid'])))
			{
				$this->db->rowsChanged("REPLACE INTO user_episodes VALUES((SELECT id FROM user_session WHERE session_data = ?), ?);",array($args['token'],$args['eid']));
			}
			
			return array("session" => array("token" => $args['token']));
		}

		
		

		/**
		 ** Just as with the other methods,
		 ** this one returns all shows and its episodes (for individual shows) if 
		 ** no show_id is provided. If a show ID is provided,
		 ** it ... as you may have guessed... returns that (or those)
		 ** specific shows
		 **
		 **/
		private function getShows()
		{
			// If we get a list of IDs for shows, we'll get them as ids[]=id1&ids[]=id2 etc
			
			$args = func_get_args();
			if(count($args)<1 && isset($_GET['ids']) && count($_GET['ids'])>0)
				$args = $_GET['ids'];

			
			$showkey = "shows";
			//$page = $_GET['page'];

			// Load list
			if(count($args[0])<1)
			{
				$loadingList = true;
				$page = (isset($_GET['page']) ? 25*($_GET["page"]-1) : 0);
				$search = (isset($_GET['search']) ? $_GET['search'] : false);
				$token = (isset($_GET['token']) ? $_GET['token'] : false);

				$query = "SELECT `tvseries`.id as sid,
						 `tvseries`.IMDB_ID as simdb,
						 `tvseries`.zap2it_id as szap2,
						 `tvseries`.Network as schannel,
						 `tvseries`.bannerrequest as sposter,
						 `tvseries`.Genre as sgenre,
						 `tvseries`.FirstAired as spilot_date,
						 `tvseries`.SeriesName as sname, 
						 `tvseries`.Overview as ssummary, 
						 `tvseries`.Rating as srating, 
						 `tvseries`.lastupdated as slst_update";

				if($search)
				{
					$query .= ", MATCH(SeriesName,Overview) AGAINST(?) as relevance, 
								 MATCH(SeriesName) AGAINST(?) as titlerelevance 
								 FROM `tvseries` WHERE MATCH(SeriesName,Overview) 
								 AGAINST(?) OR MATCH(SeriesName) AGAINST(?) 
								 OR SeriesName LIKE ? 
								 ORDER BY titlerelevance DESC, relevance DESC LIMIT ?,50";
					$qfill = array_fill(0,5,$search);
					$qfill[] = $page;
					$res = $this->db->read($query,$qfill);
				}
				else if($token)
				{

					$query = "SELECT `user_show`.show_id,
						 `tvseries`.id as sid,
						 `tvseries`.IMDB_ID as simdb,
						 `tvseries`.zap2it_id as szap2,
						 `tvseries`.Network as schannel,
						 `tvseries`.bannerrequest as sposter,
						 `tvseries`.Genre as sgenre,
						 `tvseries`.FirstAired as spilot_date,
						 `tvseries`.SeriesName as sname, 
						 `tvseries`.Overview as ssummary, 
						 `tvseries`.Rating as srating, 
						 `tvseries`.lastupdated as slst_update FROM user_session 
						 JOIN user_show ON(user_show.user_id = user_session.id) JOIN `tvseries`  
						 ON (user_show.show_id=`tvseries`.id) WHERE `user_session`.session_data = ?";
					$res = $this->db->read($query,$token);
				}
				else
				{
					$query .= " FROM `tvseries` ORDER BY Rating DESC LIMIT ?,25";
					$res = $this->db->read($query,$page);
				}
				
				
				
			}
			// Load individual
			else
			{
				//$showkey = "show";
				$loadingList = false;
				//$page = $_GET['page'];
				$qs = count($args[0]);
				$qmarks = array_fill(0,$qs,"?");
				$qmarks = implode($qmarks,",");
				

				
				$query = "SELECT `tvseries`.id as sid,
						 `tvseries`.IMDB_ID as simdb,
						 `tvseries`.zap2it_id as szap2,
						 `tvseries`.Network as schannel,
						 `tvseries`.bannerrequest as sposter,
						 `tvseries`.Genre as sgenre,
						 `tvseries`.FirstAired as spilot_date,
						 `tvseries`.SeriesName as sname, 
						 `tvseries`.Overview as ssummary, 
						 `tvseries`.Rating as srating, 
						 `tvseries`.lastupdated as slst_update FROM `tvseries` WHERE `tvseries`.id IN (".$qmarks.")";
				$res = $this->db->read($query,$args[0]);

			}


			// Iterate through results, store show_ids to get all episodes later on
			// and set up a data array for JSON conversion
			$data = array($showkey => array(), "episodes" => array());
		
			$unique = array();
			$map = array();
	
			$i = 0;
			foreach($res as $r)
			{

				// Add the show ID to the unique-array
				$unique[] = $r["sid"];

				// Set up a map to map the shows ID to the key in the list
				$map[$r["sid"]] = $i++;
				$data[$showkey][] = array("id" => $r["sid"],
												 "imdb" => $r["simdb"],
												 "zap2" => $r["szap2"],
												 "channel" => $r["schannel"],
												 "poster" => $r["sposter"],
												 "pilot_date" => $r["spilot_date"],
												 "name" => $r["sname"],
												 "summary" => $r["ssummary"],
												 "rating" => $r["srating"],
												 "lst_update" => $r["slst_update"],
												 "episodes" => array()
													);
				
			
			}
			
			if(count($unique)<1)
			{
				return $data;
			}	
			$qs = count($unique);
			$qmarks = array_fill(0,$qs,"?");
			$qmarks = implode($qmarks,",");

			// Because the database is huge, we avoid doing JOINS on it... Performance
			// turned out to be really slow with joins :(
			// It results in 2 extra queries, but we'll have to live with that ...
			$eps = "SELECT `tvepisodes`.id AS eid, 
						 `tvepisodes`.seriesid as eshow
						 FROM `tvepisodes` WHERE `tvepisodes`.seriesid IN(".$qmarks.")";

			$episodes = $this->db->read($eps,$unique);

			$episode_ids = array();

			foreach($episodes as $e)
			{
				$data[$showkey][$map[$e["eshow"]]]["episodes"][] = $e["eid"];
				$episode_ids[] = $e["eid"];
			}

			// Skip loading episodes if we're loading a list of shows
			if($loadingList)
				return $data;

			// ... otherwise, add all episodes to the array:
			$episodeObjects = $this->getEpisodes($episode_ids);

			$data["episodes"] = $episodeObjects["episodes"];

			return $data;
				
			
		}

		/** Returns an array of "episodes" for each episode ID provided as argument **/

		private function getEpisodes()
		{
			// If we get a list of IDs for episodes, we'll get them as ids[]=id1&ids[]=id2 etc
			$args = array_shift(func_get_args());
			if(count($args)<1 && isset($_GET['ids']) && count($_GET['ids'])>0)
				$args = $_GET['ids'];

			$qs = count($args);
			$qmarks = array_fill(0,$qs,"?");
			$qmarks = implode($qmarks,",");

			// Keep all episodes in this array
			$data = array("episodes" => array());

			$eps = "SELECT `tvepisodes`.id AS eid, 
						 `tvepisodes`.seriesid as eshow,
						 `tvseasons`.season as eseason,
						 `tvepisodes`.EpisodeNumber as eepisode, 
						 `tvepisodes`.EpisodeName as ename, 
						 `tvepisodes`.Overview as esummary, 
						 `tvepisodes`.FirstAired as edate FROM `tvepisodes` JOIN `tvseasons` ON(`tvepisodes`.seasonid = `tvseasons`.id) WHERE `tvepisodes`.id IN(".$qmarks.") ORDER BY eseason ASC,eepisode ASC";
			$episodes = $this->db->read($eps,$args);

			foreach($episodes as $e)
			{
				$data["episodes"][] = array( "id" => $e["eid"],
														"show_id" => $e["eshow"],
														"season" => $e["eseason"],
														"name" => $e["ename"],
														"episodeNum" => $e["eepisode"],
														"summary" => $e["esummary"],
														"date" => $e["edate"]);
			}

			return $data;
		}


		/**
		 ** If no user ID(s) are provided, it returns 
		 ** all users WITHOUT their associated shows.
		 ** If a user ID is specified, it returns
		 ** the user object, together with all shows
		 ** watched by that user.
		 **
		 **/
		private function getUsers()
		{
			$args = func_get_args();
			$userkey = "users";

			if(empty($args[0]) || $args[0] == NULL)
			{
				$query = "SELECT user.id as uid,
						  		 user.email as uemail,
						  		 user.password as upassword,
						  		 user.role_id as urole,
						  		 user.country_id as ucountry,
						  		 user.last_activity as ulastactive,
						  		 roles.id as rid,
						  		 roles.name as rname,
						  		 roles.description as rdescription,
						  		 roles.is_admin as risadmin,
						  		 user_show.show_id as usid,
						  		 user_show.user_id as usuid,
						  		 user_show.is_favorite as usisfav,
						  		 user_episodes.episode_id as epid  
						  		 FROM user JOIN roles 
						  		 ON(user.role_id=roles.id) 
						  		 LEFT JOIN user_show 
						  		 LEFT JOIN user_episodes
						  		 ON(user_episodes.user_id = user.id)
						  		 ON(user.id = user_show.user_id);";
							 $res = $this->db->read($query);
			}
			else
			{
				$qs = count($args[0]);
				$qmarks = array_fill(0,$qs,"?");
				$qmarks = implode($qmarks,",");

				$query = "SELECT user.id as uid,
						  		 user.email as uemail,
						  		 user.password as upassword,
						  		 user.role_id as urole,
						  		 user.country_id as ucountry,
						  		 user.last_activity as ulastactive,
						  		 roles.id as rid,
						  		 roles.name as rname,
						  		 roles.description as rdescription,
						  		 roles.is_admin as risadmin,
						  		 user_show.show_id as usid,
						  		 user_show.user_id as usuid,
						  		 user_show.is_favorite as usisfav,
						  		 user_episodes.episode_id as epid 
						  		 FROM user JOIN roles 
						  		 ON(user.role_id=roles.id) 
						  		 LEFT JOIN user_show 
						  		 ON(user.id = user_show.user_id)
						  		 LEFT JOIN user_episodes
						  		 ON(user_episodes.show_id = user_show.show_id)
						  		 WHERE user.id IN (".$qmarks.")";

				$userkey = "user";

				$res = $this->db->read($query,$args[0]);
			}

			// Sideload role with user
			$data = array($userkey => array(), "role" => array());
			

			$unique = array();
			$map = array();

		
			$i = 0;

			foreach($res as $r)
			{
				// Each row contains the same user info for ids;
				// so make sure we keep the user data unique in the list and sort out 
				// the episode data.
				if(!in_array($r["uid"],$unique))
				{
					// Add the show ID to the unique-array
					$unique[] = $r["uid"];

					// Set up a map to map the shows ID to the key in the list
					$map[$r["uid"]] = $i++;
					if($r["usid"] != NULL && $r["usid"] != "NULL")
					{

						$data[$userkey][] = array("id" => $r["uid"],
													 "email" => $r["uemail"],
													 "password" => $r["upassword"],
													 "role_id" => (int)$r["urole"],
													 "country_id" => $r["ucountry"],
													 "last_activity" => $r["ulastactive"],
													 "shows" => array($r["usid"])
														);
					}
					else
						$data[$userkey][] = array("id" => $r["uid"],
													 "email" => $r["uemail"],
													 "password" => $r["upassword"],
													 "role_id" => (int)$r["urole"],
													 "country_id" => $r["ucountry"],
													 "last_activity" => $r["ulastactive"],
													 "shows" => array()
														);
					$data["role"][] = array("id" => $r["rid"],
											 "name" => $r["rname"],
											 "description" => $r["rdescription"],
											 "is_admin" => $r["risadmin"]);
				}
				// Continue adding show IDs and episode IDs onto the user - use the map!
				else
				{
					if(!in_array($r["usid"],$data[$userkey][$map[$r["uid"]]]["shows"]))
						$data[$userkey][$map[$r["uid"]]]["shows"][] = $r["usid"];
					
				}

				/*$data["episodes"][] = array("id" => $r["eid"],
												"show_id" => $r["eshow"],
												"season" => $r["eseason"],
												"episode" => $r["eepisode"],
												"summary" => $r["esummary"],
												"date" => $r["edate"]);*/
			}

			if(!empty($args[0]) && $args[0] != NULL && count($data[$userkey][0]["shows"])>0)
				return array_merge($data,$this->shows($data[$userkey][0]["shows"]));

			return $data;
		}


		// Creates a new user from JSON
		private function createUser()
		{
			$data = json_decode(file_get_contents("php://input")); // Work-around for JSON POST..?

			if(empty($data))
				$this->respond("Internal Server Error", 500);
			$salt = rand()+time();
			
			$password = password_hash($data->user->password . $salt, PASSWORD_DEFAULT);
			
			$this->db->insert("user",array("email","password","salt","role_id","country_id"), array($data->user->email,$password,$salt,"5","1"));



			$query = "SELECT user.id as uid,
					  		 user.email as uemail,
					  		 user.password as upassword,
					  		 user.role_id as urole,
					  		 user.country_id as ucountry,
					  		 user.last_activity as ulastactive,
					  		 roles.id as rid,
					  		 roles.name as rname,
					  		 roles.description as rdescription,
					  		 roles.is_admin as risadmin,
					  		 user_show.show_id as usid,
					  		 user_show.user_id as usuid,
					  		 user_show.is_favorite as usisfav 
					  		 FROM user JOIN roles 
					  		 ON(user.role_id=roles.id) 
					  		 LEFT JOIN user_show 
					  		 ON(user.id = user_show.user_id)
					  		 WHERE user.email = ?";

			$userkey = "user";

			$res = $this->db->read($query,$data->user->email);
			$res = array_shift($res);


			$data = array($userkey => array(), "role" => array());
			

			
			$data[$userkey][] = array("id" => $res["uid"],
									  "email" => $res["uemail"],
									  "password" => $res["upassword"],
									  "role_id" => $res["urole"],
									  "country_id" => $res["ucountry"],
									  "last_activity" => $res["ulastactive"],
									  "shows" => array()
											);
					
			$data["role"][] = array("id" => $res["rid"],
									"name" => $res["rname"],
									"description" => $res["rdescription"],
									"is_admin" => $res["risadmin"]);
				
			return $data;
		}


		// Update one a
		private function updateUser($args)
		{
			$id = array_shift($args);
			$user = array_shift($args);

			$query = "UPDATE user SET password = ?, last_activity = NOW() WHERE id = ?;";
			$this->db->update($query,$user["password"],$id);


			return $this->users($id);
		}
	}
?>