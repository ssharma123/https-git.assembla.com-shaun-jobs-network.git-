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
    $results = $c->search(array(
        'q'          => "",
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
 
