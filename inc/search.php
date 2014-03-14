<?php
require(PATH . '/lib/tvdbClass.php');
$q = ucwords($_GET['searchquery']);

$show = new TvDb();
$show->getShow($q);

//Ugly hack, redirect to show page. This HAS to be fixed later on
<<<<<<< HEAD
if (!$show->getShowId($q) == NULL)
	Header('Location: index.php?page=details&id=' . $show->getShowId($q));
=======
if (!$show->getShow($q) != false)
	Header('Location: index.php?page=details&id=' . $show->getShowId($q));
>>>>>>> 8b1faba87b83c5cd178c4f3e5dc9720c6c85e7b8
