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




try {
    $result = $c->add(array(
        'meta' => array(
            'title' => 'Game Developer',
            'lat' => '50.2345',
            'lng'  => '97.4567',
            'heading' => 'Game Developer',
            "specialty" => "1",
            "subspecialty" => "5"
        ),
        "body" => "this is a game develpoer job, we require developer interested in game development for android , unity"
    ));
    
    $rsp['status'] = "ok";
    $rsp['result'] = $result;
    echo json_encode($rsp); die;

//    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    $rsp['status'] = "error";
    $rsp['result'] = "There was an error adding the document." .$e->getMessage();
    echo json_encode($rsp); die;
}

 