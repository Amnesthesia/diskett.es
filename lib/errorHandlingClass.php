<?php

class errorHandling extends Exception
{
	protected $title;

	public function __construct($title, $message, $code, Exception $previous = NULL)
	{
		$this->title = $title;

		parent::construct($message, $code, $previous);
	}

	public function getTitle()
	{
		return $this->title;
	}
}


?>