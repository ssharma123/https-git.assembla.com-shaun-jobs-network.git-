<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$data = @file_get_contents("php://input");

$file = fopen("uploads/data_1.txt", "a");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);

$data = $_POST;

$file = fopen("uploads/data_2.txt", "a");
fwrite($file, $data);
fwrite($file, "\n");
fclose($file);


$username = 'root';
$password = 'Purelogics@123';
$database = 'medmatch';
$host = "localhost";

$con = mysqli_connect($host, $username, $password);
$db_select = mysqli_select_db($con, $database);



// saving information
$query = "INSERT INTO webhook_logs (data ) VALUES ('$data') ";
mysqli_query($con,$query);
$result = mysqli_query($con, $query);
    
?>

