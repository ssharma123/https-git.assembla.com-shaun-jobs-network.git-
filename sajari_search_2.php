<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'application/libraries/Sajari/sajari.php';
        


$sajari = new Sajari();

$params['meta']['specialty'] = '136';
$params['meta']['sub_specialty'] = '137';

$params['meta']['lat'] = '42.7175688';
$params['meta']['lng'] = '-77.0435795';

$params['meta']['salary_range_max'] = '35000';
$params['meta']['salary_range_min'] = '50000';

$params['meta']['department_size'] = '20-40';

$params['scales'] = 'salary_range_min,35000,26000,1,0|salary_range_max,50000,26000,1,0';


$params['maxresults'] = 20;

$rsp = $sajari->sajari_search($params);

echo "<pre>"; print_r($rsp); echo "</pre>"; die;
