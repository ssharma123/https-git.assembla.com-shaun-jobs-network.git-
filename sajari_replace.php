<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'sajari/vendor/autoload.php';

use Sajari\Engine\EngineClient;
use Sajari\Engine\Exception\EngineException;

$c = new EngineClient(new Guzzle\Http\Client(), array(
    'access_key' => "5SHyDCxwMCi0HXTt",
    'secret_key' => "AVHRfLskQEUjEfdw",
    'company'    => 'medmatch',
    'collection' => "medmatchjobs"
));

 
$meta = isset($_POST['meta']) ? $_POST['meta']: FALSE ;
$doc_id = isset( $_POST["id"] ) ? $_POST["id"] : FALSE ;

try {
    
    
    if($meta){
        $params["meta"] = $meta;
    } 
    if($doc_id){
        $params['id'] = $doc_id;
    }
    $result = $c->replace($params);
    
    $rsp['status'] = "ok";
    $rsp['result'] = $result;
    echo json_encode($rsp); die;

//    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    $rsp['status'] = "error";
    $rsp['result'] = "There was an error adding the document." .$e->getMessage();
    echo json_encode($rsp); die;
}

 