<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'application/libraries/Sajari/sajari.php';
        


$sajari = new Sajari();

$params['meta']['specialty'] = '136';
$params['meta']['sub_specialty'] = '137';

$params['meta']['lat'] = '50.2345';
$params['meta']['lng'] = '98.4567';

//$params['scales'] = 'lat,50.2345,100,1,1|lng,98.4567,100,1,1';


$params['maxresults'] = 20;

$rsp = $sajari->sajari_search($params);

echo "<pre>"; print_r($rsp); echo "</pre>"; die;
