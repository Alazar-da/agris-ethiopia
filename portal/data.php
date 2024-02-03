<?php

/*
  Rui Santos
  Complete project details at https://RandomNerdTutorials.com/esp32-esp8266-mysql-database-php/
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files.
  
  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.
*/

//$servername = "localhost";

// REPLACE with your Database name
//$dbname = "REPLACE_WITH_YOUR_DATABASE_NAME";
// REPLACE with Database user
//$username = "REPLACE_WITH_YOUR_USERNAME";
// REPLACE with Database user password
//$password = "REPLACE_WITH_YOUR_PASSWORD";
include 'data/conn.php';

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $customer_id = $land_name = $temp_min = $temp_avg = $temp_max =$humd_min = $humd_avg = $humd_max = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $customer_id = test_input($_POST["customer_id"]);
        $land_name = test_input($_POST["land_name"]);
        $temp_min = test_input($_POST["temp_min"]);
        $temp_avg = test_input($_POST["temp_avg"]);
        $temp_max = test_input($_POST["temp_max"]);
        $humd_min = test_input($_POST["humd_min"]);
        $humd_avg = test_input($_POST["humd_avg"]);
        $humd_max = test_input($_POST["humd_max"]);
        
        // Create connection
        //$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO `gh_data`(`customer_id`,`land_name`, `temp_min`, `temp_avg`, `temp_max`, `humd_min`, `humd_avg`, `humd_max`) 
        VALUES ('$customer_id','$land_name','$temp_min','$temp_avg','$temp_max','$humd_min','$humd_avg','$humd_max')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}