<?php

libxml_use_internal_errors(true);

class TPB
{
	private static $instance;

	private $url = 'http://thepiratebay.se/search/',
	        $quality, 
	        $query,
	        $domContent;


	public static function getInstance()
	{
		if (!isset(TPB::$instance))
		{
			TPB::$instance = new TPB();
		}

		return TPB::$instance;
	}

	public function find($query, $quality = NULL)
	{
		$this->domDocument->loadHTMLFile(urlencode($this->url . $query . ' ' . $quality . '/0/7/0'));
		$xpath = new DOMXPath($this->domDocument);

		$nodes = $xpath->query("//a[@title='Download this torrent using magnet']/@href");

		return $this->cleanUpResults($nodes);
	}

	private function cleanUpResults($nodes)
	{
		$results = array();

		foreach($nodes as $node)
		{
			array_push($results, $node->nodeValue);
		}

		return $results;
	}

	private function __construct()
	{
		$this->domDocument = new DomDocument;
	}
}