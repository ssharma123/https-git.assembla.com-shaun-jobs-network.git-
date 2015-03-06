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

$q = isset($_GET['q']) ? $_GET['q']: "" ;

try {
    
    
    $result = $c->search(array(
        
        "filters"=>array(
            array("~title" => "developer"),
        ),
        "scales" =>array(
            array(
                'meta'=>'',
                'center'=>'',
                'radius'=>'',
                'start'=>'',
                'end'=>'',
                
            )
        ),
        'maxresults' => 40,
    ));
    $rsp['status'] = "ok";
    $rsp['result'] = $result;
    
    echo "<pre>"; print_r($rsp); echo "</pre>"; die;

    
} catch (EngineException $e) {
    $rsp['status'] = "error";
    $rsp['result'] = "There was an error running the search." .$e->getMessage();
    echo json_encode($rsp); die;
}