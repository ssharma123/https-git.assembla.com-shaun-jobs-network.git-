<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$data = @file_get_contents("php://input");

$file = fopen("uploads/data_1.txt", "a");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);


$username = 'root';
$password = 'Purelogics@123';
$database = 'medmatch';
$host = "localhost";

$con = mysqli_connect($host, $username, $password);
$db_select = mysqli_select_db($con, $database);


//$data_array = json_decode($data,TRUE);
//$data_save = ($data_array);
$data = (string) $data;
// saving information
$query = "INSERT INTO webhook_logs (data ) VALUES ('$data') ";
mysqli_query($con,$query);
$result = mysqli_query($con, $query);
    
?>

<!--
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
{"sEvent":"interviewautomatedvideo.updated","bTest":false,"iInterview":"90138"}
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
{"sEvent":"interviewautomatedvideo.updated","bTest":false,"iInterview":"90138"}
{"sEvent":"interviewautomatedvideo.updated","bTest":false,"iInterview":"90138"}
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
-->
