<?php

class Bloomapi {
    var $ssl = FALSE;
    var $url = "http://www.bloomapi.com/api/sources/usgov.hhs.npi/";
    
    public function __construct() {
    }
    
    /*
     * @params = array('address'=>'');
     */
    public function validate_npi_number($npi_number) {
        
        
        
        $url = $this->url.$npi_number;
        

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);

        // Turn off the server and peer verification (TrustManager Concept).
        if ($this->ssl === FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }


        $response = curl_exec($ch);
        curl_close($ch);

        $status = "";
        if ($response) {
            $rsp = json_decode($response,TRUE);
            if(isset($rsp['result'])){
                $result = $rsp['result'];
                if( isset($result["type"]) ){
                    $npi_type = $result["type"];
                    if($npi_type == "individual"){
                        $status = "invalid";
                    }
                    else{
                        $status = "ok";
                    }
                }
            }
            return $status;
        } else {
            return false;
        }
    }
    
    

}

?>