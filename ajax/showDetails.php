<?php
	require_once("../lib/showClass.php");
	
	/**
	** @todo Proper referrer checking -- no requests from third parties!
	**/

	if(!isset($_GET['id']) || !is_numeric($_GET['id']))
		die(json_encode(array()));

	$id = $_GET['id'];

	$s = new Show($id);

	$details = $s->getAttributes();
	$r = array_shift($s->getRelationships());
	
	$details["amount_episodes"] = count($r["object"]);

	echo json_encode($details);

?>