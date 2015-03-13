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

$file = isset($_FILES['file']) ? $_FILES['file']: FALSE ;

try {
    
    $filepath = NULL;
    if($meta){
        $search_param["meta"] = $meta;
    }
    if($file){
        $filepath = $_FILES['file']['tmp_name'];
    }
    echo "<pre>"; print_r($search_param); echo "</pre>"; 
    echo "<pre>"; print_r($filepath); echo "</pre>"; 
    die;

    $result = $c->add($search_param, $filepath);
    
    $rsp['status'] = "ok";
    $rsp['result'] = $result;
    echo json_encode($rsp); die;

//    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    $rsp['status'] = "error";
    $rsp['result'] = "There was an error adding the document." .$e->getMessage();
    echo json_encode($rsp); die;
}

 