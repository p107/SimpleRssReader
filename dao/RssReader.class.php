<?php

/**
 * Klasa pobierająca newsy z pliku XML kanału RSS.
 */
class RssReader {
	
	private $filter = null;
	private $rss_data = null;
	
	public function __construct() {
	}
	
	public function parseXML($xml) {
		$this->rss_data = @simplexml_load_string($xml);
	}
	
	public function getRssData() {
		if (($this->rss_data === false) || !isset($this->rss_data->channel, $this->rss_data->channel->item)) {
			return false;
		}
		$result = array();
		if (isset($this->filter)) {
			foreach ($this->rss_data->channel->item as $item) {
				if (stripos($item->description, $this->filter) !== false) {
					$words = str_to_words_array($item->description);
					if (in_array($this->filter, $words)) {
						$result[] = $item;
					}
				}
			}
		}
		else {
			$result = $this->rss_data->channel->item;
		}
		return $result;
	}
	
	public function setFilter($phrase) {
		$this->filter = strtolower($phrase);
	}
	
}