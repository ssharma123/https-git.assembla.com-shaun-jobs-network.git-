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
	$config['account_sid']   = 'AC8dfd04b3d65a82a57c65d8ad76223dfb';

	/**
	 * Auth Token
	 **/
	$config['auth_token']    = '9ae52efe74e7d8ec9a4595bfc42b3afa';

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