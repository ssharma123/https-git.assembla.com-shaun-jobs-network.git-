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
    $r = $c->add(array(
        'meta' => array(
            'title' => 'test document '.rand(1, 10),
            'lat' => '50.2345',
            'lng'  => '97.4567',
            'test' => 'zzzz'
        ),
    ));
    echo "<hr>";
    echo "Document details";
    echo "<hr>";
    echo "<pre>"; print_r($r); echo "</pre>";
    echo "<hr>";

//    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo "There was an error adding the document.", $e->getMessage(), PHP_EOL;
}

 