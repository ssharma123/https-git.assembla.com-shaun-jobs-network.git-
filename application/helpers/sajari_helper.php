<?php

if (!function_exists('sajari_api')) {
    /*
        $file = "sajari_search"
        $file = "sajari_add"
        $file = "sajari_get"
     */
    function sajari_api($file = "sajari_search", $params) {
        $that =& get_instance();
        $that->load->library('Sajari/sajari');
        $file_data = array();
        if(key_exists("inputfile", $params)){
            

            $file_data = array(
                'tmp_name' => $params["inputfile"]['tmp_name'],
                'name' => $params["inputfile"]['name']
            );
        }
        
        $rsp = $that->sajari->sajari_request( $file , $params , $file_data);
        return $rsp;
    }
}

 

?>
