<?php

interface iDatabase
{
	public static function getDbInstance();
	public function __destruct();

	public function insert($query);
	public function update($query);
	public function read($query);
	public function delete($query);
}

?>
