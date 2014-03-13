<?php


/*function __autoload($class_name)
{
    include_once '../lib/' . $class_name . '.php';
}*/

//include_once '../lib/databaseClass.php';
include_once '../lib/activeRecord.php';
include_once '../lib/showClass.php';
include_once '../lib/fileHandlerClass.php';
include_once '../lib/configurationClass.php';

class TvDB
{
	//private $mirror = 'http://thetvdb.com'; //test variable
    private $db;
    private $apiConfig = array();

    public function __construct()
    {
        //$this->db = DatabaseHandler::getInstance();
        //$this->apiConfig = parse_ini_file('../config/config.php', true);
        $this->apiConfig = Configuration::getInstance()->getConfig('Api');
    }

    public function getShow($id)
    {
        if(!$id == null)
        {
            $fileHandler = new FileHandler();

            if(is_string($id))
            {
                $id = $this->getShowId($id);
            }

            if(Show::exists($id))
            {
                echo "exists";
                $this->getUpdate($id);
                $fileHandler->unzip($id);
                $fileHandler->loadDataFromFile($id);
            }
            else
            {
                $this->getShowZip($id);
                $fileHandler->unzip($id);
                $fileHandler->loadDataFromFile($id);
            }
            $fileHandler->deleteTempFiles();
        }
        else echo "No input";
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
		//$query = 'SELECT `lst_update` FROM `show` WHERE `id` =' .  $showId;
        //$serverTime = $this->db->read($query);

        $show = new Show(array($showId));
        $serverTime = $show->getAttribute("lst_update");

        //return $serverTime[0]['lst_update'];
        return $serverTime;
    }
	
	public function getMirror()
    {
		$url = 'http://thetvdb.com/api/' . $this->apiConfig['Key'] . '/mirrors.xml';
		
		$xml = simplexml_load_file($url);
		$mirror = $xml->Mirror->mirrorpath;

		return $mirror;

    }
	
	public function getShowZip($showId)
    {
		$url = $this->getMirror() . '/api/' . $this->apiConfig['Key'] . '/series/' . $showId . '/all/en.zip';
		file_put_contents('../temp/' . $showId . '.zip', file_get_contents($url));

        //$fileHandler = new FileHandler(); //testing
        //$fileHandler->unzip($showId);
        //$fileHandler->loadDataFromFile($showId);
    }
	
	public function getUpdate($showId)
    {
        $url = 'http://thetvdb.com/api/Updates.php?type=all&time=' . strtotime($this->getPreviousServerTime($showId));
        echo "update"; //test
        $xmlData = file_get_contents($url);
        $xml = new SimpleXMLElement($xmlData);
        $xpath = $xml->xpath('//Series[contains(.,' . $showId . ')]/text()');

        if($xpath[0]==$showId)
        {
            $this->getShowZip($showId);
            echo "nyupdate"; //test
            //$this->db->update("UPDATE `show` SET lst_update=?  WHERE id=?", date('Y-m-d', $this->getServerTime()), $showId);
            //$show = new Show(array($showId));
            //$show->setAttribute("lst_update", date('Y-m-d', $this->getServerTime()));
            //$show->save();
            //$r = FileHandlerClass::unzip($showId); //test var


        }
        else
        {
            echo 'error';
        }
    }

    public function getShowId($showName) //Must be spelled correctly with capital letters
    {
        $url = 'http://thetvdb.com/api/GetSeries.php?seriesname=' . urlencode($showName);

        $xmlData = file_get_contents($url);

        $xml = new SimpleXMLElement($xmlData);
        $xpath = $xml->xpath('//Series[SeriesName ="' . $showName . '"]/seriesid');

        return $xpath[0];

    }
}

$test = new TvDB();
$test->getShow("Vikings");
//$test->getShowId("True Detective");
//var_dump(strtotime($test->getPreviousServerTime(70327)));
//echo date("Y-m-d", $test->getServerTime());
//$test->getMirror();
//$test->getServerTime();
//$test->getServerTime();
//$test->getUpdate(70327);
//var_dump($test->getShowId('The Big Bang Theory'));
//echo $test->getPreviousServerTime(70327);
//$test->getSeriesZip(80379);
//$test->getSeriesZip($test->getShowId("The Walking Dead"));
?>