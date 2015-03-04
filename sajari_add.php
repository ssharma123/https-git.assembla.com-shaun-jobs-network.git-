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

echo "<pre>"; print_r($c); echo "</pre>"; 

try {
    $r = $c->add(array(
        'q' => implode(' ', array(getenv('FIRST_NAME'), getenv('LAST_NAME'))),
        'meta' => array(
            'first_name' => getenv('FIRST_NAME'),
            'last_name'  => getenv('LAST_NAME'),
        ),
    ));
    echo var_export($r, true), PHP_EOL;
} catch (EngineException $e) {
    echo "There was an error adding the document.", $e->getMessage(), PHP_EOL;
}
