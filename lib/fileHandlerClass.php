<?php

include_once '../lib/activeRecord.php';
include_once '../lib/showClass.php';

class FileHandler
{

	public function unzip($zipFile) //navn på zip.fil (seriesId)
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
	
	public function deleteTempFiles()
	{
		$files = glob('../temp/*');
		foreach($files as $file)
		{ 
			if(is_file($file)) unlink($file);
		}
	}

    public function loadDataFromFile($showId)
    {
        $xmlData = file_get_contents("../temp/" . $showId . "/en.xml");
        $xml = new SimpleXMLElement($xmlData);

        $id = $xml->Series->id;
        $imdb_id = $xml->Series->IMDB_ID;
        $zap2_id = $xml->Series->zap2it_id;
        //$channelId = $xml->Series->
        $banner_url = $xml->Series->banner;
        $pilot_date = $xml->Series->FirstAired;
        $name = $xml->Series->SeriesName;
        //$summary = $xml->Series->Overview;
        $summary = "random text";
        $lang = $xml->Series->Language;
        $rating = $xml->Series->Rating;
        $lst_update = date("Y-m-d", (string)$xml->Series->lastupdated);
        //var_dump($lst_update);

        $attributes = array("id" => $showId, "imdb_id" => $imdb_id, "zap2_id" => $zap2_id, "banner_url" => $banner_url, "pilot_date" => $pilot_date, "name" => $name, "summary" => $summary, "lang" => $lang, "rating" => $rating, "lst_update" => $lst_update);
        $show = new Show($attributes);
        var_dump($show);
        //$show->save();

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
}

$test = new FileHandler();
//$test->unzip('80379');
$test->loadDataFromFile(80379);
//$test->deleteTempFiles();
//$array = array("id"=>)
//$show = new Show(70327);
//$show->setAttribute("imdb_id", 1565);
//var_dump($show);

?>