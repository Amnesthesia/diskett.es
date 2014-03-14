<?php

require_once PATH . '/lib/activeRecord.php';
require_once PATH . '/lib/showClass.php';
require_once PATH . '/lib/episodeClass.php';
require_once PATH . '/lib/databaseClass.php';

class FileHandler
{

    /**
     * Unzips the given file based on input
     *
     * @param integer $zipFile 	name of the zipfile to unzip
     */
	public function unzip($zipFile) //navn på zip.fil (seriesId) eller update zip (navn)
	{
        if(is_int($zipFile))
        {
            $file = PATH . '/temp/' . $zipFile . '.zip';
            $path = PATH . '/temp/' . $zipFile;

            $zip = new ZipArchive;
            $res = $zip->open($file);

            if ($res === TRUE)
            {
                $zip->extractTo($path);
                $zip->close();
            }
            else
            {
                echo "Couldn't open $file";
            }
        }
        if(is_string($zipFile))
        {
            $file = PATH . '/updates/' . $zipFile;
            $path = PATH . '/updates/';

            $zip = new ZipArchive;
            $res = $zip->open($file);

            if ($res === TRUE)
            {
                $zip->extractTo($path);
                $zip->close();
            }
            else
            {
                echo "Couldn't open $file";
            }
        }

	}

    /**
     * Deletes all files in temp folder
     */
	public function deleteTempFiles()
	{
		$files = glob(PATH . '/temp/*');
        $dirs = scandir(PATH . '/temp/');
		foreach($files as $file)        //runs through all files and deletes them
		{ 
			if(is_file($file)) unlink($file);
		}
        foreach($dirs as $dir)          //runs through all directories in directory
        {
            if ($dir !="." AND $dir !="..") // directories '.' and '..'
            {
                if(is_dir(PATH . "/temp/" . $dir))
                {
                    $dirFile = glob(PATH . "/temp/" . $dir . "/*");
                    foreach($dirFile as $file)  //deletes all files in directory
                    {
                        if(is_file($file)) unlink($file);
                    }
                    rmdir(PATH . "/temp/" . $dir);
                }
            }

        }
	}

    /**
     * Initiates the right functions to load info from
     * downloaded xml files
     *
     * @param integer $showId	ID of the show to load info to
     */
    public function loadDataFromFile($showId)
    {
        $xmlData = file_get_contents(PATH . "temp/" . $showId . "/en.xml");
        $xml = new SimpleXMLElement($xmlData);

        $this->loadShowFromFile($xml);
        $this->loadEpisodesFromFile($xml);
    }

    /**
     * Loads all info about a given show and saves to database
     *
     * @param integer $xml	xml document with all info about the show
     */
    public function loadShowFromFile($xml)
    {
        $id = trim($xml->Series->id);
        $imdb_id = trim($xml->Series->IMDB_ID);
        $zap2_id = trim($xml->Series->zap2it_id);
        $channelId = trim($xml->Series->Network);
        $poster = trim($this->loadImage($xml->Series->poster));
        $pilot_date = trim($xml->Series->FirstAired);
        $name = trim($xml->Series->SeriesName);
        $summary = trim($xml->Series->Overview);
        $lang = trim($xml->Series->Language);
        $rating = trim($xml->Series->Rating);
        $lst_update = trim(date("Y-m-d", (string)$xml->Series->lastupdated)); //reads and convert value to right format

        $attributes = array("id" => $id, "imdb_id" => $imdb_id, "zap2_id" => $zap2_id, "channel_id" => $channelId, "poster" => $poster, "pilot_date" => $pilot_date, "name" => $name, "summary" => $summary, "lang" => $lang, "rating" => $rating, "lst_update" => $lst_update);

        $show = new Show($attributes);  //creates show object filled with all info and saves to database
        $show->save();

    }

    /**
     * Loads all info about a given show and saves to database
     *
     * @param integer $xml	xml document with all info about the episode
     */
    public function loadEpisodesFromFile($xml)
    {
        foreach($xml->Episode AS $episode)
        {
            $seriesId = $episode->seriesid;
            $episodeNr = $episode->EpisodeNumber;
            $season = $episode->SeasonNumber;
            $date = $episode->FirstAired;

            if(!Episode::exists(array($seriesId, $season, $episodeNr))) //skips loading episode if already in database | saves resources
            {
                $episodeId = $episode->id;
                $name = $episode->EpisodeName;
                $summary = $episode->Overview;

                $attributes = array("show_id" => $seriesId, "episode_id" => $episodeId, "season" => $season, "episode" => $episodeNr, "name" => $name, "summary" => $summary, "date" => $date);

                $episodeObj = new Episode($attributes); //creates episode object with all info and saves to database
                $episodeObj->save();
            }

        }
    }

    /**
     * Loads image and md5 the name to be added in database
     *
     * @param integer $filename     filename of the image to load
     */
    private function loadImage($filename)
    {
        // Hash filename
        $hashName = md5($filename);

        // Check if file already exists. Don't want to create a new object here, so I can't use ActiveRecord...?
        $imageHash = DatabaseHandler::getInstance()->read('select count(*) as exist from `show` where poster=?', md5($filename) . '.jpg');

        if (@$imageHash[0]['exist'] == 0)
        {
            // Download poster
            file_put_contents(PATH . '/media/' . $filename, file_get_contents('http://www.thetvdb.com/banners/' . $filename));
                
            // Move to posters folder
            rename(PATH . '/media/' . $filename, PATH . '/media/posters/' . $hashName . '.jpg');
        }
        return $hashName . '.jpg';   
    }
}
?>