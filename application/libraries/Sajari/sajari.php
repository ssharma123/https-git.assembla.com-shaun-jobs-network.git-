<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Sajari {
    var $ssl = FALSE;
    
    public function __construct() {
    }
    
    /*
     * @params = array('address'=>'');
     */
    public function sajari_request($type ,$params , $file_data = array() ) {
        
        
        
        $post_data = array();
        
        if (is_array($params)) {
            $post_data = http_build_query($params);
        }
        
        if( count($file_data) > 0 ){
//            $file_data = array(
//                'file' =>
//                    '@'. $file_data['tmp_name']
//                    .';filename='.$file_data['name']
//            );
//            echo "<pre>"; print_r($file_data); echo "</pre>"; die;

        }
        $url = base_url($type.EXT);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        
        if( count($file_data) > 0 ){
//            $args['file'] = new CurlFile($file_data['name'], $file_data['type'], $file_data['tmp_name']);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        }

        // Set the request as a POST FIELD for curl.
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
    
    public function sajari_search(array $params , $file_data = array() ) {
        
        $url = "https://www.sajari.com/api/search";
        
        $post_data = array();
        
        if (is_array($params)) {
            $post_data = http_build_query($params);
        }
         
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "5SHyDCxwMCi0HXTt:AVHRfLskQEUjEfdw"); // Your credentials goes here
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//      curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        
        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);


        $response = curl_exec($ch);
        
        echo ($response);
        die;
        
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