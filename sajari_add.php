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
            'title' => 'PHP Developer',
            'lat' => '50.2345',
            'lng'  => '97.4567',
            'heading' => 'PHP Developer',
            "specialty" => "1",
            "subspecialty" => "2"
        ),
    ));
    $r = $c->add(array(
        'meta' => array(
            'title' => 'IOS Developer',
            'lat' => '50.2345',
            'lng'  => '98.4567',
            'heading' => 'IOS Developer',
            "specialty" => "1",
            "subspecialty" => "3"
        ),
    ));
    $r = $c->add(array(
        'meta' => array(
            'title' => 'Android Developer',
            'lat' => '50.2345',
            'lng'  => '99.4567',
            'heading' => 'Android Developer',
            "specialty" => "1",
            "subspecialty" => "4"
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

 