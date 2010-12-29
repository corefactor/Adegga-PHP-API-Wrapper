<?php

class Adegga extends AdeggaCore {
	
	
	
	/*
	protected function GetWineByAvin() {
		
		return $this->makeRequest('GetWineByAvin', func_get_args());
		
	}
	*/
	
	public function GetProducerByID() {
		
		return $this->makeRequest('GetProducerByID', func_get_args());
		
	}
	
}

?>