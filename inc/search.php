<?php
require(PATH . '/lib/tvdbClass.php');
$q = ucwords($_GET['searchquery']);

$show = new TvDb();
$show->getShow($q);

//Ugly hack, redirect to show page. This HAS to be fixed later on
if (!$show->getShowId($q) == NULL)
	Header('Location: index.php?page=details&id=' . $show->getShowId($q));