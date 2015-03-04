<?php

class Sajari {
    var $ssl = FALSE;
    
    public function __construct() {
    }
    
    /*
     * @params = array('address'=>'');
     */
    public function sajari_request($type ,$params) {
        
        
        
        if (is_array($params)) {
            $post_data = http_build_query($params);
        }
        
        $url = base_url($type.EXT);
        
        echo "<pre>"; print_r($url); echo "</pre>"; 
        echo "<pre>"; print_r($post_data); echo "</pre>"; die;

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Set the request as a POST FIELD for curl.
        //curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        // Turn off the server and peer verification (TrustManager Concept).
        if ($this->ssl === FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }


        $response = curl_exec($ch);
        curl_close($ch);

        
        if ($response) {
            $rsp = json_decode($response);
            return $rsp;
        } else {
            return false;
        }
    }
    
    

}

?>