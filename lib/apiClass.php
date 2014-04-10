<?php

// This is the base class for a RESTful API. 
// Links will look like /<model>/<verb>/<arg1>/<arg2>/ etc

abstract class API
{
	/**
	 * HTTP state for request
	 */
	 protected $state = '';

	 /**
	  * The requested model (table)
	  */
	 protected $model = '';


	 /**
	  * Action to perform
	  */
	 protected $verb = '';


	 /**
	  * Array of arguments, like IDs
	  */
	 protected $args = Array();

	 /**
	  * Input of PUT requests
	  */
	 protected $file = NULL;

	 public function __construct($req)
	 {
	 	header("Access-Control-Allow-Origin: *");
	 	header("Access-Control-Allow-Methods: *");
	 	header("Content-Type: application/json");

	 	$this->args = explode('/', rtrim($req, '/'));
	 	$this->model = array_shift($this->args);

	 	
	 	// If the state is POST, check what type of HTTP state the request was made in,
	 	// and change the state variable accordingly.
	 	$this->state = $_SERVER["REQUEST_METHOD"];
	 	if($this->state == "POST" && array_key_exists('HTTP_X_HTTP_METHOD',$_SERVER))
	 	{
	 		if($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE')
	 			$this->state = "DELETE";
	 		else if($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT')
	 			$this->state = "PUT";
	 		else
	 			throw new Exception("Invalid HTTP state");
	 	}

	 	switch($this->state)
	 	{
	 		case 'POST':
	 			$this->verb = 'create';
	 		case 'DELETE':
	 			$this->request = $this->sanitize($_POST);
	 			$this->verb = 'delete';
	 			break;

	 		case 'GET':
	 			$this->verb = 'read';
	 			$this->request = $this->sanitize($_GET);
	 			break;

	 		case 'PUT':
	 			$this->verb = 'update';
	 			$this->request = $this->sanitize($_GET);
	 			$this->file = file_get_contents("php://input");
	 			break;
	 		default:
	 			$this->respond("Invalid HTTP state", 0);
	 			break;
	 	}
	 }


	 /**
	  * Creates a response from the server
	  *
	  * @param string $data
	  * @param integer $status
	  */
	 protected function respond($data, $status = 200)
	 {
	 	header("HTTP/1.1 ".$status." ".$this->requestStatus($status));
	 	return json_encode($data);
	 }


	 /**
	  * Sanitizes GET/POST info
	  * 
	  * @param mixed $data
	  * @return mixed
	  */
	 private function sanitize($data)
	 {
	 	$sanitized = array();

	 	// If this is an array, loop through it then recurse for each item
	 	if(is_array($data))
	 	{
	 		foreach($data as $key => $value)
	 			$sanitized[$key] = $this->sanitize($value);
	 	}
	 	else
	 		$sanitized = trim(strip_tags($data));

	 	return $sanitized;
	 }

	 /**
	  *	Returns the actual name for a status code
	  *
	  * @param integer $status
	  * @return string
	  */
	 private function requestStatus($status)
	 {
	 	$state = array(
	 					200 => "OK",
	 					403 => "Forbidden",
	 					404 => "Not found",
	 					405 => "Method Not Allowed",
	 					500 => "Internal Server Error"
	 					);
	 	return ($state[$status]) ? $state[$status] : $state[500];
	 }

	 /**
	  * Processes the query
	  * and returns a response
	  *
	  * @return string
	  */
	 public function process()
	 {
	 	if(method_exists($this, $this->model) > 0)
	 		return $this->respond($this->{$this->model}($this->args));
	 	else
	 		return $this->respond("Resource unavailable", 404);
	 }
}

?>