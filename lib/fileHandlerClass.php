<?php

include_once '../lib/activeRecord.php';
include_once '../lib/showClass.php';
include_once '../lib/episodeClass.php';
include_once '../lib/databaseClass.php';

class FileHandler
{

	public function unzip($zipFile) //navn på zip.fil (seriesId) eller update zip (navn)
	{
        if(is_int($zipFile))
        {
            $file = '../temp/' . $zipFile . '.zip';
            $path = '../temp/' . $zipFile;

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
            $file = '../updates/' . $zipFile;
            $path = '../updates/';

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
	
	public function deleteTempFiles()
	{
		$files = glob('../temp/*');
        $dirs = scandir('../temp/');
		foreach($files as $file)
		{ 
			if(is_file($file)) unlink($file);
		}
        //var_dump($dirs);
        foreach($dirs as $dir)
        {
            if ($dir !="." AND $dir !="..") // directories '.' and '..'
            {
                if(is_dir("../temp/" . $dir))
                {
                    $dirFile = glob("../temp/" . $dir . "/*");
                    foreach($dirFile as $file)
                    {
                        if(is_file($file)) unlink($file);
                    }
                    rmdir("../temp/" . $dir);
                }
            }

        }
	}

    public function loadDataFromFile($showId)
    {
        $xmlData = file_get_contents("../temp/" . $showId . "/en.xml");
        $xml = new SimpleXMLElement($xmlData);

        $this->loadShowFromFile($xml);
        $this->loadEpisodesFromFile($xml);
    }

    public function loadShowFromFile($xml)
    {
        $id = $xml->Series->id;
        $imdb_id = $xml->Series->IMDB_ID;
        $zap2_id = $xml->Series->zap2it_id;
        $channelId = $xml->Series->Network;
        $poster = $this->loadImage($xml->Series->poster);
        $pilot_date = $xml->Series->FirstAired;
        $name = $xml->Series->SeriesName;
        $summary = $xml->Series->Overview;
        //$summary = "random text";
        $lang = $xml->Series->Language;
        $rating = $xml->Series->Rating;
        $lst_update = date("Y-m-d", (string)$xml->Series->lastupdated);
        //var_dump($lst_update);

        $attributes = array("id" => $id, "imdb_id" => $imdb_id, "zap2_id" => $zap2_id, "channel_id" => $channelId, "poster" => $poster, "pilot_date" => $pilot_date, "name" => $name, "summary" => $summary, "lang" => $lang, "rating" => $rating, "lst_update" => $lst_update);

        $show = new Show($attributes);
        $show->save();

        /*$show->setAttribute("id", $id);
        $show->setAttribute("imdb_id", $imdb_id);
        $show->setAttribute("zap2_id", $zap2_id);
        $show->setAttribute("banner_url", $banner_url);
        $show->setAttribute("pilot_date", $pilot_date);
        $show->setAttribute("name", $name);
        $show->setAttribute("summary", $summary);
        $show->setAttribute("lang", $lang);
        $show->setAttribute("rating", $rating);
        $show->setAttribute("lst_update", $lst_update);
        $show->save();*/
    }

    public function loadEpisodesFromFile($xml)
    {
        foreach($xml->Episode AS $episode)
        {
            $seriesId = $episode->seriesid;
            $episodeNr = $episode->EpisodeNumber;
            $season = $episode->SeasonNumber;

            if(!Episode::exists(array($seriesId, $season, $episodeNr)))
            {
                $episodeId = $episode->id;
                $name = $episode->EpisodeName;
                $summary = $episode->Overview;
                $attributes = array("show_id" => $seriesId, "episode_id" => $episodeId, "season" => $season, "episode" => $episodeNr, "name" => $name, "summary" => $summary);

                $episodeObj = new Episode($attributes);
                $episodeObj->save();
            }

        }
    }

    public function loadImage($filename)
    {
        // Download poster
        file_put_contents('../media/' . $filename, file_get_contents('http://www.thetvdb.com/banners/' . $filename));
        
        // Hash filename
        $hashName = md5_file('../media/' . $filename);
        
        // Move to posters folder
        rename('../media/' . $filename, '../media/posters/' . $hashName . '.jpg');

        // Return new filename
        return $hashName . '.jpg';
    }
}

//$test = new FileHandler();
//$test->unzip('80379');
//$test->loadDataFromFile(153021);
//$test->deleteTempFiles();
//$array = array("id"=>)
//$show = new Show(70327);
//$show->setAttribute("imdb_id", 1565);
//var_dump($show);

?>