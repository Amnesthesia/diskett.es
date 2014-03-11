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
        $this->db = DatabaseHandler::getInstance();
        $this->apiConfig = parse_ini_file('../config/config.php', true);
    }

	public function getServerTime()
    {
		$url = 'http://thetvdb.com/api/Updates.php?type=none';
		
		$xml = simplexml_load_file($url);
		$serverTime = (int)$xml->Time;

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
	
	public function getUpdate($showId)
    {
        $url = 'http://thetvdb.com/api/Updates.php?type=all&time=' . strtotime($this->getPreviousServerTime($showId));

        $xmlData = file_get_contents($url);
        $xml = new SimpleXMLElement($xmlData);
        $xpath = $xml->xpath('//Series[contains(.,' . $showId . ')]/text()');

        if($xpath[0]==$showId)
        {
            $this->getSeriesZip($showId);

            $this->db->update("UPDATE `show` SET lst_update=?  WHERE id=?", date('Y-m-d', $this->getServerTime()), $showId);
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

//var_dump(strtotime($test->getPreviousServerTime(70327)));
//echo date("Y-m-d", $test->getServerTime());
//$test->getMirror();
//$test->getServerTime();
//$test->getServerTime();
//$test->getUpdate(70327);
//var_dump($test->getShowId('The Big Bang Theory'));
//echo $test->getPreviousServerTime(70327);
//$test->getSeriesZip('80379');

?>