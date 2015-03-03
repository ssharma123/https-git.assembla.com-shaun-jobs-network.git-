<?php

	/*
	
		Copyright: RIVS.com LLC
		Creation Date: 2013-01-17
		Update Date: 2013-01-17
		Author: Dominik Kondrat <dk(at)rivs.com>
		
		This file is a helper class for interaction with RIVS REST API
	
	*/

	class RIVS {
		private static $sAccessToken;
		private static $sAppName;

		public function __construct($sAccessToken = NULL, $sAppName = NULL) {
			$this->sAccessToken = $sAccessToken;
			$this->sAppName = $sAppName;
		}
		
		public function call($sCall, $aData = NULL) {
			// Check if passed data is valid
			if(!is_null($aData) && !is_array($aData)) die('Data passed to RIVS::call has to be an array');
			
			// Set Event
			$aData['sCall'] = $sCall;
			
			// Get Data String
			$sData = json_encode($aData);
		
			// Build cURL call
			$rCh = curl_init(); 
			curl_setopt($rCh, CURLOPT_URL, "https://www.rivs.com/rest/".$this->sAccessToken.'/'); 
			curl_setopt($rCh, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($rCh, CURLOPT_POSTFIELDS, $sData);
			curl_setopt($rCh, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($rCh, CURLOPT_HTTPHEADER, array('Content-Type: application/json','User-Agent: '.$this->sAppName,'Content-Length: ' . strlen($sData)));
			$rOutput = curl_exec($rCh); 
			curl_close($rCh); 
			$aData = json_decode($rOutput,true);
			
			// If data was incorrect: die
			if(is_null($aData)) die('Invalid Data Received: '.$rOutput);
			
			// Return data
			return $aData;
		}
		
	}
	
?>