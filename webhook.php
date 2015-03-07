<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$data = @file_get_contents("php://input");

$file = fopen("uploads/data_1.txt", "w");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);

$data = $_POST;

$file = fopen("uploads/data_2.txt", "w");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);


?>

