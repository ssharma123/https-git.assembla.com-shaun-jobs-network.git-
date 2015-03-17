<?php

class Google_geolocation {

    var $geocoding = "";
    var $sensor = "false"; // Type String , Indicates whether or not the geocoding request comes from a device with a location sensor. This value must be either true or false.
    var $ssl = FALSE;

    public function __construct() {

        if ($this->ssl === FALSE) {
            $this->geocoding = "http://maps.googleapis.com/maps/api/geocode/json?";
        } else {
            $this->geocoding = "https://maps.googleapis.com/maps/api/geocode/json?";
        }
    }

    /*
     * @params = array('address'=>'');
     */
    public function get_logitute_latitude($params) {
        $urlParam = "";
        if (is_array($params)) {
            foreach ($params as $key => $val) {
                $urlParam .= $key . "=" . urlencode($val) . "&";
            }
        }
        
        $url = $this->geocoding.$urlParam . "sensor=" . $this->sensor;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);


        // Set the request as a POST FIELD for curl.
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        // Turn off the server and peer verification (TrustManager Concept).
        if ($this->ssl === FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }


        $response = curl_exec($ch);
        curl_close($ch);

        $responseObj = json_decode($response);
        if ($responseObj->status == "OK") {
            if( count($responseObj->results) == 1 ){
                $resultAry = get_object_vars($responseObj->results[0]->geometry->location);
                
                return $resultAry;
            }
            else {
                return false;
            }
            
        } else {
            return false;
        }
    }
    
    /*
     * @params = array('address'=>'');
     */
    public function get_address_component($params, $return_type = '') {
        $urlParam = "";
        if (is_array($params)) {
            foreach ($params as $key => $val) {
                $urlParam .= $key . "=" . urlencode($val) . "&";
            }
        }
        
        $url = $this->geocoding.$urlParam . "sensor=" . $this->sensor;
        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);


        // Set the request as a POST FIELD for curl.
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        // Turn off the server and peer verification (TrustManager Concept).
        if ($this->ssl === FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }


        $response = curl_exec($ch);
        curl_close($ch);

        $responseObj = json_decode($response);
        if ($responseObj->status == "OK") {
            if( count($responseObj->results) == 1 ){
                $return = FALSE;
                
                if($return_type != ""){
                    
                    if(!isset($responseObj->results[0]->address_components)){
                        $return = FALSE;
                    }
                    if($return_type == 'city'){
                        
                    }
                    else if($return_type == "city_code"){

                        $address_components = (array) $responseObj->results[0]->address_components;
                        
                        foreach($address_components as $component){
                            $component_types = (isset($component->types)) ? $component->types : array();
                            if(in_array('administrative_area_level_1', $component_types)){
                                if(isset($component->short_name)){
                                    $return = $component->short_name;
                                }
                            }
                        }
                    }
                }
                else{
                    $return = get_object_vars($responseObj->results[0]);
                }
                
                return $return;
            }
            else {
                return false;
            }
            
        } else {
            return false;
        }
    }

}

?>