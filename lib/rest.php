<?php
	require_once("apiClass.php");
	require_once("showClass.php");


	// It's easy to add more models to this class!
	// Just create a method named what the resource is called,
	// like "show" or "episode". Then, switch on the $this->verb
	// attribute and return what you want to return in JSON
	// for the 4 different actions: create, read, update, delete.
	class RestAPI extends API
	{

		public function __construct($request, $source)
		{
			parent::__construct($request);

			
		}

		public function show()
		{
			$args = func_get_args();

			switch($this->verb)
			{

				case 'read':
					if(empty($args) || !$args[0])
					{	
						$data = array();
						$showlist = Show::getList();

						foreach($showlist as $s)
							$data[] = $s->getAttributes();				
					}
					else
					{
						$show = new Show($args[0]);
						$data = $show->getAttributes();
					}
					return $data;
					break;
			}
		}

		public function episode()
		{
			$args = func_get_args();

			switch($this->verb)
			{

				case 'read':
					
					$episode = new Episode($args[0]);
					return $episode->getAttributes();
					break;
			}
		}
	}
?>