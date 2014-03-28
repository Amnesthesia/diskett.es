<?php

require_once('configurationClass.php');

class Log
{
	public static function logError($errMsg)
	{
		$file = fopen(PATH . 'logs/' . date('Y-d-m') . '.txt', 'a'); // 2014-03-11
		fwrite($file, '[' . date('Y-d-m H:i:s') .']: ' . $errMsg . "\r\n"); // Write error msg to file
	}

	public static function displayError($errMsg)
	{
		// Display error to user. Use a notify plugin (JQuery)
	}
}