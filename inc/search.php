<?php
require(PATH . '/lib/tvdbClass.php');
$q = ucwords($_GET['searchquery']);

$show = new TvDb();
$show->getShow($q);
