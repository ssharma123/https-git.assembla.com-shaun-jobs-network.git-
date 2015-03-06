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
        $rsp = $this->sajari->sajari_request( $file , $params);
        return $rsp;
    }
}

 

?>
