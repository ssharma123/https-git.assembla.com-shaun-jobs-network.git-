<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$data = @file_get_contents("php://input");

$file = fopen("uploads/recent_webhook.txt", "a");
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
//$data = (string) $data;
// saving information

    
if($data){
    
        $data_array = json_decode($data,TRUE);
        if( isset($data_array['sEvent']) &&  isset($data_array['iInterview']) ){
            
            if($data_array['sEvent'] == "interviewautomatedvideo.updated" && $data_array['iInterview'] != ""){
    
                $post_data = array();
                if (is_array($data_array)) {
                    $post_data = http_build_query($data_array);
                }
                
                
                $query = "INSERT INTO webhook_logs (data ) VALUES ('$post_data') ";
                mysqli_query($con,$query);
                $result = mysqli_query($con, $query);
                
                
                
                
                $url = "http://medmatchjobs.com/job_seeker_dashboard/offer_interview_webhook";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                // Set the request as a POST FIELD for curl.
                // Turn off the server and peer verification (TrustManager Concept).
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_exec($ch);
                curl_close($ch);
            
            }
            
        }
    
}



?>

<!--
SAMPLE DATA
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
{"sEvent":"interviewautomatedvideo.updated","bTest":false,"iInterview":"90138"}
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
{"sEvent":"interviewautomatedvideo.updated","bTest":false,"iInterview":"90138"}
{"sEvent":"interviewautomatedvideo.updated","bTest":false,"iInterview":"90138"}
{"sEvent":"application.updated","bTest":false,"iApplication":"294061"}
-->
