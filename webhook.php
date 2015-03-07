<?php

$data = @file_get_contents("php://input");

$file = fopen("data_1.txt", "w");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);

$data = $_POST;

$file = fopen("data_2.txt", "w");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);




