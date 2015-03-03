<?php

$data = file_get_contents("php://input");

$file = fopen("post_data.txt", "w");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);

?>