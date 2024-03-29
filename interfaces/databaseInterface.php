<?php

interface iDatabase
{
	public static function getInstance();
	public function __destruct();

	public function insert($table, array $fields, array $values);
	public function update();
	public function read();
	public function delete($table, $id);
	public function readToClass();
}

?>
