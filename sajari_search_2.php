<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'application/libraries/Sajari/sajari.php';
        


$sajari = new Sajari();

$params['meta']['specialty'] = '136';
$params['meta']['sub_specialty'] = '137';

$rsp = $sajari->sajari_search($params);

echo "<pre>"; print_r($rsp); echo "</pre>"; die;
