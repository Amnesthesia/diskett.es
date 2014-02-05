<?php

class TvDB
{
	private $serverTime;
	private $mirror;
	
	private function getServerTime()
    {
		$url = 'http://thetvdb.com/api/Updates.php?type=none';
		
		$xml = simplexml_load_file($url);
		$serverTime = $xml->Time;
		
		return $serverTime;
    }
	
	private function getPreviousServerTime()
    {
		
    }
	
	private function getMirrors()
    {
		$url = 'http://thetvdb.com/api/5AC2A3BD00F821B8/mirrors.xml';
		
		$xml = simplexml_load_file($url);
		$mirror = $xml->Mirror->mirrorpath;

		return $mirror;
    }
	
	private function getSeriesZip()
    {
		//$url = $mirror . '/api/' . '@apikey@' . '/series/' . '@series id@' . '/all/en.zip';
		$url = 'http://thetvdb.com/api/GetSeries.php?seriesname=the%20big%20bang%20theory';
		file_put_contents('./temp/', file_get_contents($url));

    }
	
	private function getUpdates()
    {
		
    }
}

$test = new TvDB();

$test->getSeriesZip();

?>