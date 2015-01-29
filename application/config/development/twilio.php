<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/

//    Number: 312-635-4633 
//    Twilio account: info@medmatch.us 
//    Password: Password123
	/**
	 * Mode ("sandbox" or "prod")
	 **/
	$config['mode']   = 'sandbox';

	/**
	 * Account SID
	 **/
	$config['account_sid']   = 'ACa00e2ffd1a976a31b0ab892fb77b34b4';

	/**
	 * Auth Token
	 **/
	$config['auth_token']    = '96bbee3d72798ceee302201689c77978';

	/**
	 * API Version
	 **/
	$config['api_version']   = '2010-04-01';

	/**
	 * Twilio Phone Number
	 **/
//	$config['number']        = '3126354633';
	$config['number']        = '+15005550006';


/* End of file twilio.php */