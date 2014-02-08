<?php

function getShowId($show)
{
	$xmlData = file_get_contents('http://thetvdb.com/api/GetSeries.php?seriesname=' . urlencode($show));
	$xml = new SimpleXMLElement($xmlData);

	$items = $xml->xpath('/Data/Series[SeriesName ="' . $show . '"]/seriesid');

	return $items;
}


$items = getShowId("Jamie Oliver's Food Revolution");

print_r($items);

echo $items[0][0]

?>