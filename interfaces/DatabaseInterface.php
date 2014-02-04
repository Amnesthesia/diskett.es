<?php

interface DatabaseInterface
{
	public function __construct();
	public function __destruct();

	public function insert();
	public function update();
	public function read();
	public function delete();
}

?>
