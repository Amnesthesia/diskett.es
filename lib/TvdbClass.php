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

		return $this->mirror;
    }
	
	public function getSeriesZip()
    {
		//$url = $mirror . '/api/' . '@apikey@' . '/series/' . '@series id@' . '/all/en.zip';
		$url = 'http://thetvdb.com/api/5AC2A3BD00F821B8/series/80379/all/en.zip'; //test string
		file_put_contents('../temp/series.zip', file_get_contents($url));

    }
	
	private function getUpdates()
    {
		
    }
}

//$test = new TvDB();
//$test->getSeriesZip();

?>