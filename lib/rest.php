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
			}
			
		}

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
				$this->db->insert("user_session",array("session_data","session_ip"),array($hash,$_SERVER["REMOTE_ADDR"]));

				return array("session" => array("token" => $hash, "user_id" => $res[0]["id"]));
			}
			else
				return array("session" => array("error" => 404));	
		}


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

		public function users()
		{
			$args = func_get_args();
			switch($this->verb)
			{
				case 'create':
					return $this->createUser(array_shift($args));
				case 'read':
					return $this->getUsers(array_shift($args));

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

		/**
		 ** Just as with the other methods,
		 ** this one returns all shows and its episodes if 
		 ** no show_id is provided. If a show ID is provided,
		 ** it ... as you may have guessed... returns that (or those)
		 ** specific shows
		 **
		 **/
		private function getShows()
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

		private function createUser()
		{
			$data = json_decode(file_get_contents("php://input")); // Work-around for JSON POST..?

			if(empty($data))
				$this->respond("Internal Server Error", 500);
			$salt = rand()+time();
			
			$password = password_hash($data->user->password . $salt, PASSWORD_DEFAULT);
			
			$this->db->insert("user",array("email","password","salt","role_id","country_id"), array($data->user->email,$data->user->password,$salt,"5","1"));



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
						  		 user_show.is_favorite as usisfav 
						  		 FROM user JOIN roles 
						  		 ON(user.role_id=roles.id) 
						  		 LEFT JOIN user_show 
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
						  		 user_show.is_favorite as usisfav 
						  		 FROM user JOIN roles 
						  		 ON(user.role_id=roles.id) 
						  		 LEFT JOIN user_show 
						  		 ON(user.id = user_show.user_id)
						  		 WHERE user.id IN (".$qmarks.")";

				$userkey = "user";

				$res = $this->db->read($query,$args[0]);
			}
			$data = array($userkey => array(), "role" => array());
			

			$unique = array();
			$map = array();

		
			$i = 0;

			foreach($res as $r)
			{
				// Each row contains the same show info for many show_ids;
				// so make sure we keep the user data unique in the list and sort out 
				// the episode data.
				if(!in_array($r["uid"],$unique))
				{
					// Add the show ID to the unique-array
					$unique[] = $r["uid"];

					// Set up a map to map the shows ID to the key in the list
					$map[$r["uid"]] = $i++;
					if($r["usid"] != NULL && $r["usid"] != "NULL")
						$data[$userkey][] = array("id" => $r["uid"],
													 "email" => $r["uemail"],
													 "password" => $r["upassword"],
													 "role_id" => $r["urole"],
													 "country_id" => $r["ucountry"],
													 "last_activity" => $r["ulastactive"],
													 "shows" => array($r["usid"])
														);
					else
						$data[$userkey][] = array("id" => $r["uid"],
													 "email" => $r["uemail"],
													 "password" => $r["upassword"],
													 "role_id" => $r["urole"],
													 "country_id" => $r["ucountry"],
													 "last_activity" => $r["ulastactive"],
													 "shows" => array()
														);
					$data["role"][] = array("id" => $r["rid"],
											 "name" => $r["rname"],
											 "description" => $r["rdescription"],
											 "is_admin" => $r["risadmin"]);
				}
				// Continue adding episode IDs onto the show - use the map!
				else
					$data[$userkey][$map[$r["uid"]]]["shows"][] = $r["eid"];

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
	}
?>