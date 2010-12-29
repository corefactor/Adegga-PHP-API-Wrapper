<?php

/**
 * Adegga API Core Wrapper
 * Handles basic requests and parameters
 *
 * @package AdeggaAPI
 * @author Rui Cruz
 */
Class AdeggaCore {
	
	protected $api_key = null;
	
	protected $request_format = null;
	
	protected $api_endpoint = 'http://api.adegga.com/rest/v1.0/';
	
	private $log = null;
	
	
	function __construct($api_key, $api_endpoint = null) {
		
		$this->api_key = $api_key;
		
		if (!is_null($api_endpoint)) {
			
			$this->api_endpoint = $api_endpoint;
			
		}
		
	}
	
	/**
	 * Handmade API requests
	 *
	 * @param string $method 
	 * @param array $params 
	 * @param string $format 
	 * @return mixed
	 * @author Rui Cruz
	 */
	public function get($method, $params = array(), $format = 'json') {
		
		if (empty($this->api_key)) {
			trigger_error('No API key defined', E_USER_ERROR);
			return false;
		}
		
		$this->request_format = $format;
		
		if (method_exists($this, $method)) {
			
            $result = call_user_func_array(array($this, $method), $params);
			return $result;
			
        } else {

			#trigger_error(sprintf('Method: %s not defined in the API Wrapper', $method), E_USER_ERROR);
			return $this->makeRequest($method, $params);
	
		}
	
	}
	
	protected function buildRequest($method, $params = null) {
		
		$param_str = null;
		
		foreach($params as $param) {
			$param_str .= '/' . $param;
		}

		return sprintf('%s%s%s/&format=%s&key=%s', $this->api_endpoint, $method, $param_str, $this->request_format, $this->api_key);
		
	}
	
	protected function makeRequest($method, $params = null) {
		
		$request_url = $this->buildRequest($method, $params);
		
		$response = file_get_contents($request_url);
		
		if ($this->request_format == 'json' && $response !== false) {
			
			$response = json_decode($response);
			
		}
		
		$this->log($request_url, $response);
		
		return $response;
		
	}
	
	protected function log($request_url, $response) {
		
		$this->log[] = array('request' => $request_url, 'response' => $response);
		
	}
	
	public function getLog() {
		
		return $this->log;
		
	}
	
}

?>