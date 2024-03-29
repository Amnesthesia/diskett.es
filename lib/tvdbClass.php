<?php
require_once PATH . './lib/activeRecord.php';
require_once PATH . './lib/showClass.php';
require_once PATH . './lib/fileHandlerClass.php';

class TvDB
{
    private $apiConfig = array();

    /**
     * Create object and initiate config variables
     */
    public function __construct()
    {
        $this->apiConfig = Configuration::getInstance()->getConfig('Api');
    }

    /**
     * Executes functions to get to get shows from tvdb and into the database based on show id
     *
     * @param integer $id 	ID to what show to initiate
     */
    public function getShow($id)
    {
        if(!$id == null)
        {
            $fileHandler = new FileHandler();

            if(is_string($id))
            {
                $id = (int)$this->getShowId($id);       //if id is string, run function to get id based on string
            }

            if(Show::exists(array($id)))                //if a show with show_id == $id exists in databasethen run update function
            {
                if($this->getUpdate($id))
                {
                    $fileHandler->unzip($id);
                    $fileHandler->loadDataFromFile($id);
                }
            }
            else                                        //if not exists, get all show info
            {
                if($id != 0)
                {
                    $this->getShowZip($id);
                    $fileHandler->unzip($id);
                    $fileHandler->loadDataFromFile($id);
                }
            }
            $fileHandler->deleteTempFiles();
        }
        else echo "No input";
    }

    /**
     * Gets the Unix-timespamp from tvdb server
     */
	public function getServerTime()
    {
		$url = 'http://thetvdb.com/api/Updates.php?type=none';
		
		$xml = simplexml_load_file($url);
		$serverTime = (int)$xml->Time;

		return $serverTime;
    }

    /**
     * Gets the the timestamp stored in the database
     *
     * @param integer $showId 	ID to the show to get timestamp from
     */
	public function getPreviousServerTime($showId)
    {
        $show = new Show(array($showId));
        $serverTime = $show->getAttribute("lst_update");        //gets attribute from database

        return $serverTime;
    }

    /**
     * Gets the current mirror from tvdb
     */
	public function getMirror()
    {
		$url = 'http://thetvdb.com/api/' . $this->apiConfig['Key'] . '/mirrors.xml';
		
		$xml = simplexml_load_file($url);
		$mirror = $xml->Mirror->mirrorpath;

		return $mirror;
    }

    /**
     * Downloads the zip with all the show info
     *
     * @param integer $showId 	ID to the show to download
     */
	public function getShowZip($showId)
    {
		$url = $this->getMirror() . '/api/' . $this->apiConfig['Key'] . '/series/' . $showId . '/all/en.zip';
		file_put_contents(PATH . '/temp/' . $showId . '.zip', file_get_contents($url));
    }

    /**
     * If show already exists, checks if any new updates the past 7days.
     * Downloads updates if there are any.
     *
     * @param integer $showId 	ID to the show to update
     */
	public function getUpdate($showId)
    {
        $files = scandir(PATH . '/updates/');            //gets a list of all files/dirs in directory
        $found = false;                             //found updates_week.xml?
        foreach($files as $file)                    //loops through files
        {
            if($file == "updates_week.xml")         //if the right file found
            {
                $found = true;                      //found the file
                $xmlData = file_get_contents(PATH . "/updates/updates_week.xml");
                $xml = new SimpleXMLElement($xmlData);
                $xpathT = $xml->xpath('//Data/@time');   //Time of when the file was last updated

                $show = new Show(array($showId));
                $serverTime = strtotime($show->getAttribute("lst_update"));        //gets attribute from database

                if(!(time()-(60*60*24*7)) < $xpathT[0])              //checks if file older then 7days
                {
                    $fileHandler = new FileHandler();
                    $url = $this->getMirror() . '/api/' . $this->apiConfig['Key']  . '/updates/updates_week.zip';
                    file_put_contents(PATH . '/updates/updates_week.zip', file_get_contents($url));
                    $fileHandler->unzip("updates_week.zip");
                }

                $xpath = $xml->xpath('//Series/id[contains(.,' . $showId . ')]/text()'); //finds element of show

                if(isset($xpath[0]) AND $xpath[0] == $showId AND (time() - $serverTime) > (60*60*24*6)) //if element found and is right get zip with info and 6days have passed since last update
                {
                    $this->getShowZip($showId);
                    return true;                            //return true that update took place
                }
                else
                    return false;                           //no new updates

            }
        }
        if($found == false)                                 //if file not found, download from scratch and run function again
        {
            $fileHandler = new FileHandler();

            $url = $this->getMirror() . '/api/' . $this->apiConfig['Key'] . '/updates/updates_week.zip';
            file_put_contents(PATH . '/updates/updates_week.zip', file_get_contents($url));
            $fileHandler->unzip("updates_week.zip");
            $this->getUpdate($showId);                      //runs the getUpdate again after getting updates
        }
    }

    /**
     * Gets the ID for a show, based on its name
     *
     * @param integer $showName 	Exact name of show to get ID
     */
    public function getShowId($showName) //Must be spelled correctly with capital letters
    {
        $url = 'http://thetvdb.com/api/GetSeries.php?seriesname=' . urlencode($showName);

        $xmlData = file_get_contents($url);

        $xml = new SimpleXMLElement($xmlData);

	@$seriesId = ($xml[0]->Series->seriesid);

       //$xpath = $xml->xpath("//Series[SeriesName[contains(translate(.,'ABCDEFGHJIKLMNOPQRSTUVWXYZ','abcdefghjiklmnopqrstuvwxyz'), translate('" . $showName . "','ABCDEFGHJIKLMNOPQRSTUVWXYZ','abcdefghjiklmnopqrstuvwxyz'))]]/seriesid"); //case-insensitive input for xpath
	
	//$xpath = $xml->xpath("//Series[SeriesName[contains(lower-case(" . $showName . "))]]");

	if (@$seriesId != NULL)
	    return $seriesId;
        else
            return false;
    }
}
