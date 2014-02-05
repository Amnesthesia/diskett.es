<?php

class customException extends Exception
{
	protected $title;

	public function __construct($title, $message, $code, Exception $previous = NULL)
	{
		$this->title = $title;

		parent::__construct($message, $code, $previous);
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function test()
	{
		echo "test";
	}
}


?>