<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Request{

	private $_controller;
	private $_method;
	private $_args;
	private static $_self;

	public static function getInstance()
	{
		if(is_null(self::$_self)){
			self::$_self = new self();
		}
		return self::$_self;
	}

	private function __construct(){
		if (isset($_GET['url'])) {
			$url = filter_input(INPUT_GET, "url",FILTER_SANITIZE_URL);
			$url = explode("/", $url);
			$url = array_filter($url);

			$this->_controller = array_shift($url);
			$this->_method = array_shift($url);
			$this->_args = $url;
		}
		if (!$this->_controller)
			$this->_controller = DEFAULT_CONTROLLER;

		if(!$this->_method)
			$this->_method = DEFAULT_METHOD;

		if (!isset($this->_args)) {
			$this->_args = array();
		}
	}

	// getters
	public function getController() {
		return $this->_controller;
	}
	public function getMethod(){
	 return $this->_method; 
	}
	public function getArgs() {
		return $this->_args;
	}
}

?>
