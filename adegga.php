<?php

/**
 * Extends AdeggaCore with Public methods 
 *
 * @package AdeggaAPI
 * @author Rui Cruz
 */
class Adegga extends AdeggaCore {
	
	/**
	 * Overload the AdeggaCore constructor to set the default $request_format
	 *
	 * @param string $api_key 
	 * @param string $request_format 
	 * @param string $api_endpoint 
	 * @author Rui Cruz
	 */
	function __construct($api_key, $request_format = 'json', $api_endpoint = null) {
		
		parent::__construct($api_key, $api_endpoint = null);
		
		$this->request_format = $request_format;
	
	}
	
	/**
	 * Get wine information using an AVIN code
	 *
	 * @param string $avin 
	 * @return mixed
	 * @author Rui Cruz
	 */
	public function getWineByAvin($avin) {
		
		$args = func_get_args();
		
		$response = $this->makeRequest('GetWineByAvin', $args);
		
		if ($response !== false) {
			
			return $response->response->aml->wines->wine[0];
			
		}
		
		return false;
		
	}
	
	/**
	 * Get producer information using the producer ID
	 *
	 * @param int $id 
	 * @return void
	 * @author Rui Cruz
	 */
	public function getProducerByID($id) {
		
		$args = func_get_args();
		
		$response = $this->makeRequest('GetProducerByID', $args);
		
		if ($response !== false) {
			
			return $response->response->aml->producers->producer[0];
			
		}
		
		return false;
		
	}
		
}

?>