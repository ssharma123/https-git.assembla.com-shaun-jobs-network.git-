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
    $results = $c->search(array(
        'meta' => array(
            'title' => 'PHP Developer',
            'lat' => '50.2345',
            'lng'  => '97.4567',
            'heading' => 'PHP Developer',
            "specialty" => "1",
            "subspecialty" => "4"
        ),
        'maxresults' => 10,
    ));
//    echo var_export($results, true), PHP_EOL;
    echo "<hr>";
    echo "Result";
    echo "<hr>";
    echo "<pre>"; print_r($results); echo "</pre>";
    echo "<hr>";
} catch (EngineException $e) {
    echo "There was an error running the search. ", $e->getMessage(), PHP_EOL;
}
 
