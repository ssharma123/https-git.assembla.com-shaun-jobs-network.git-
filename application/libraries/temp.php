<?php

// reading in secret info via environment variables so I don't accidentally share it with anyone

$username = $_ENV['TGC_USER'];

$password = $_ENV['TGC_PASS'];

$apikey = $_ENV['TGC_API_KEY'];

// create a session

$session = post('session', array(
    'username' => $username,
    'password' => $password,
    'api_key_id' => $apikey,
        ));

$session_id = $session->{'result'}->{'id'};

// fetch info about the user

$user = get('user/' . $session->{'result'}->{'user_id'}, array(
    'session_id' => $session_id,
        ));

// upload a file to the filesystem

$file = post('file', array(
    'session_id' => $session_id,
    'file' => '@/Users/jt/Desktop/jt.jpg', // note the @ symbol at the start of the file path
    'name' => 'jt.jpg',
    'folder_id' => $user->{'result'}->{'root_folder_id'},
        ));

// dump what we know about the file

var_dump($file);

// execute a POST operation to TGC's web services and return an object

function post($url, $params) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.thegamecrafter.com/api/' . $url);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {  //catch if curl error exists and show it
        echo 'Curl error: ' . curl_error($ch);

        curl_close($ch);
    } else {

        curl_close($ch);

        return json_decode($result);
    }
}

// execute a GET operation to TGC's web services and return an object

function get($url, $params) {

    $query = '?';

    if ($params) {
        foreach ($params as $key => $value) {
            $query .= $key . '=' . $value . '&';
        }
    }

    $query = trim($query, '&');
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, 'https://www.thegamecrafter.com/api/' . $url . $query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {  //catch if curl error exists and show it
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
    } else {
        curl_close($ch);
        return json_decode($result);
    }
}
