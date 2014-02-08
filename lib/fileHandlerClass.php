<?php

class FileHandler
{
	public function unzip($zipFile) //navn på zip.fil (seriesId)
	{
		$file = '../temp/' . $zipFile;
		$path = '../temp';

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
}

//$test = new FileHandler();
//$test->unzip('series.zip');
//$test->deleteTempFiles();

?>