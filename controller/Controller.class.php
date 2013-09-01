<?php
/**
 * Abstrakcyjna klasa kontrolera
 */
abstract class Controller
{
	function __construct() {
		$this->getData();
	}
	
    abstract protected function getData();
    abstract public function render();   
}

