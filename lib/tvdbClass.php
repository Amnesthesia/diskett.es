<?php


/*function __autoload($class_name)
{
    include_once '../lib/' . $class_name . '.php';
}*/

include_once '../lib/databaseClass.php';

class TvDB
{
	//private $mirror = 'http://thetvdb.com'; //test variable
    private $db;
    private $apiConfig;

    public function __construct()
    {
        $this->db = DatabaseHandler::getDbInstance();
        $this->apiConfig = parse_ini_file('../config/config.php', true);
    }

	public function getServerTime()
    {
		$url = 'http://thetvdb.com/api/Updates.php?type=none';
		
		$xml = simplexml_load_file($url);
		$serverTime = $xml->Time;
		
		return $serverTime;
    }
	
	public function getPreviousServerTime($showId)
    {
		$query = 'SELECT `lst_update` FROM `show` WHERE `id` =' .  $showId;
        $serverTime = $this->db->read($query);

        return $serverTime[0]['lst_update'];
    }
	
	public function getMirror()
    {
		$url = 'http://thetvdb.com/api/' . $this->apiConfig['Api']['Key'] . '/mirrors.xml';
		
		$xml = simplexml_load_file($url);
		$mirror = $xml->Mirror->mirrorpath;

		return $mirror;
    }
	
	public function getSeriesZip($seriesId)
    {
		$url = $this->getMirror() . '/api/' . $this->apiConfig['Api']['Key'] . '/series/' . $seriesId . '/all/en.zip';
		file_put_contents('../temp/' . $seriesId . '.zip', file_get_contents($url));
    }
	
	public function getUpdates($showId)
    {
        $url = 'http://thetvdb.com/api/Updates.php?type=all&time=' . $this->getPreviousServerTime($showId);

        $xmlData = file_get_contents($url);
        $xml = new SimpleXMLElement($xmlData);
        $xpath = $xml->xpath('//Series[contains(.,' . $showId . ')]/text()');

        if($xpath[0]==$showId)
        {
            $this->getSeriesZip($showId);
            //insert $this->getServerTime() i database til $showId
        }
        else
        {
            echo 'error';
        }
    }

    public function getShowId($showName)
    {
        $url = 'http://thetvdb.com/api/GetSeries.php?seriesname=' . urlencode($showName);

        $xmlData = file_get_contents($url);

        $xml = new SimpleXMLElement($xmlData);
        $xpath = $xml->xpath('//Series[SeriesName ="' . $showName . '"]/seriesid');

        return $xpath[0];

    }
}

//$test = new TvDB();

//$test->getUpdates(70327)
//$test->getShowId('Revolution');
//$test->getPreviousServerTime(10);
//$test->getSeriesZip('80379');

?>