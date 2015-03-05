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

$query = isset($_POST['q']) ? $_POST['q']: FALSE ;
$meta = isset($_POST['meta']) ? $_POST['meta']: FALSE ;
$filters = isset($_POST['filters']) ? $_POST['filters']: FALSE ;
$max_result = isset($_POST['max_result']) ? $_POST['max_result']: 20 ;

try {
    
    $search_param = array(
        'maxresults' => $max_result,
    );
    if($query){
        $search_param["q"] = $query;
    }
    if($meta){
        $search_param["meta"] = $meta;
    }
    if($filters){
        $search_param["filters"] = $filters;
    }
    
    $result = $c->search($search_param);
    $rsp['status'] = "ok";
    $rsp['result'] = $result;
    echo json_encode($rsp); die;
    
} catch (EngineException $e) {
    $rsp['status'] = "error";
    $rsp['result'] = "There was an error running the search." .$e->getMessage();
    echo json_encode($rsp); die;
}
 
