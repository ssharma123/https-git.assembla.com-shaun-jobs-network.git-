<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'application/libraries/Sajari/sajari.php';
        


$sajari = new Sajari();

$params['meta']['specialty'] = '136';
$params['meta']['sub_specialty'] = '137';

//$params['meta']['lat'] = '42.7175688';
//$params['meta']['lng'] = '-77.0435795';

$params['scales'] = 'lat,42.7175688,100,5,0|lng,-77.0435795,100,5,0';
$params['maxresults'] = 40;

$rsp = $sajari->sajari_search($params);

echo "<pre>"; print_r($rsp); echo "</pre>"; die;
