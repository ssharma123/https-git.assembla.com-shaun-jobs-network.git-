<?php

class paypal {

    var $api_user;
    var $api_pass;
    var $api_sig;
    var $api_end = "https://api-3t.paypal.com/nvp";
    var $env = "sandbox";
    var $version;
    var $nvpString;
    var $response;
    var $isdebug;
    var $debug;
    var $returnData;

    function paypal($api_user, $api_pass, $api_sig, $env = "sandbox", $debug = false) {

        $this->api_user = $api_user;
        $this->api_pass = $api_pass;
        $this->api_sig = $api_sig;
        $this->env = $env;
        $this->debug = $debug;
        $this->version = urlencode('51.0');
        if ($this->env == "live") {
            $this->api_end = "https://api-3t.paypal.com/nvp";
        } else {
            $this->api_end = "https://api-3t." . $this->env . ".paypal.com/nvp";
        }
    }

    function setOption($name, $value) {
        $this->nvpString .= "&$name=" . urlencode($value);
    }

    function debug($arr, $out = false, $exit = false) {
        if (!$this->isdebug)
            return false;
        $this->debug[] = $arr;
        if ($out) {
            echo "<pre>";
            print_r($this->debug);
            echo "</pre>";
        }
        if ($exit)
            exit;
    }

    function startTransection() {

        if (empty($this->nvpString))
            return false;
        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_end);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set the API operation, version, and API signature in the request.
        $nvpreq = "VERSION=" . $this->version . "&PWD=" . $this->api_pass . "&USER=" . $this->api_user . "&SIGNATURE=" . $this->api_sig . "&PAYMENTACTION=" . urlencode('Sale') . "$this->nvpString";

        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

        // Get response from the server.

        $this->response = curl_exec($ch);

//        $this->debug($this->response);
//        $this->debug(curl_getinfo($ch));
//
//        if (!$this->response) {
//            $this->debug($this->response);
//            $this->debug(curl_getinfo($ch));
//        }
//        if (!$this->response)
//            $this->debug(array(), true, true);

        curl_close($ch);
        $httpResponseAr = explode("&", $this->response);
        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if (sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = urldecode($tmpAr[1]);
            }
        }

        if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            if($this->debug){
                exit("Invalid HTTP Response for POST request($nvpreq) to ".$this->api_end.".");
            }
        }
        $this->returnData = $httpParsedResponseAr;
        return $httpParsedResponseAr;
    }

}

?>