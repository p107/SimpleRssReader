<?php
/** 
 * Klasa kontrolera aplikacji pobierającej wpisy z kanału xlab.pl
 */
class XLab extends Controller{
	
	private $xml_data = null;
	private $rss_data = null;
	
	protected function getData() {
		$this->xml_data = @file_get_contents(variable('feed_url'));
		if ($this->xml_data !== false) {
			$reader = new RssReader();
			$reader->parseXML($this->xml_data);
			if (!empty($_GET['filter'])) {
				$reader->setFilter($_GET['filter']);
			}
			$this->rss_data = $reader->getRssData();
		}
	}
	
	public function render() {
		if ($this->xml_data === false) {
			$render_list = 'Błąd pobierania danych. Sprawdz konfigurację.';
		}
		else if (empty($this->rss_data)) {
			$render_list = 'Brak wyników.';
		}
		else {
			$render_list = template('news_list', array(
				'items' => $this->rss_data,
			));
		}
		$render_block = template('block', array(
			'title' => 'xlab.pl', 
			'content' => $render_list,
		));
		$render_main = template('index', array(
			'title' => 'Simple RSS Reader', 
			'content' => $render_block,
		));

		echo $render_main;
	}
	
}
