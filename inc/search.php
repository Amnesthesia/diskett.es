<?php
require(PATH . '/lib/tvdbClass.php');
$q = ucwords($_GET['searchquery']);

$show = new TvDb();
$show->getShow($q);

$id = $show->getShowId($q);

//Ugly hack, redirect to show page. This HAS to be fixed later on
if ($id != false)
	Header('Location: index.php?page=details&id=' . $show->getShowId($q));
else
	echo "Error: Could not find '" . $q . "' in the database.";
