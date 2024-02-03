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
$api_key= $customer_id = $land_name = $temp = $humd=$moist=$pump=$fan=$temp_max=$temp_min=$temp_avg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["api_key"]) && isset($_POST["customer_id"]) && isset($_POST["land_name"])&& isset($_POST["temp"]) && isset($_POST["humd"]) && isset($_POST["moist"])&& isset($_POST["pump"]) && isset($_POST["fan"])){
    
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        
        $customer_id = test_input($_POST["customer_id"]);
        $land_name = test_input($_POST["land_name"]);
        $temp = test_input($_POST["temp"]);
        $humd = test_input($_POST["humd"]);
        $moist = test_input($_POST["moist"]);
        $pump = test_input($_POST["pump"]);
        $fan = test_input($_POST["fan"]);
        echo $customer_id." ".$land_name." ".$temp;
     
        
        // Create connection
        //$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        
        
        //$sql = "UPDATE `gh_daily_info`(`customer_id`,`land_name`, `temp`,`humd`) 
       //VALUES ('$customer_id','$land_name','$temp','$humd')";
        $sql="UPDATE gh_daily_info SET temp='$temp', humd='$humd',moist='$moist', pump='$pump',fan='$fan' WHERE land_name='$land_name' AND customer_id='$customer_id'";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else {
        echo "Wrong API Key provided.";
    }
}

    if(isset($_POST["api_key"]) && isset($_POST["customer_id"]) && isset($_POST["land_name"])&&isset($_POST["temp_min"]) && isset($_POST["temp_avg"]) && isset($_POST["temp_max"])){
             $api_key = test_input($_POST["api_key"]);
            if($api_key == $api_key_value) {
            $customer_id = test_input($_POST["customer_id"]);
            $land_name = test_input($_POST["land_name"]);
            $temp_min = test_input($_POST["temp_min"]);
            $temp_avg = test_input($_POST["temp_avg"]);
            $temp_max = test_input($_POST["temp_max"]);
            $sql = "INSERT INTO `gh_temprature_report`(`customer_id`,`land_name`, `temp_min`,`temp_avg`,`temp_max`) 
            VALUES ('$customer_id','$land_name','$temp_min','$temp_avg','$temp_max')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }    
        }
        
        
        if(isset($_POST["api_key"]) && isset($_POST["customer_id"]) && isset($_POST["land_name"])&&isset($_POST["humid_min"]) && isset($_POST["humid_avg"]) && isset($_POST["humid_max"])){
             $api_key = test_input($_POST["api_key"]);
            if($api_key == $api_key_value) {
            $customer_id = test_input($_POST["customer_id"]);
            $land_name = test_input($_POST["land_name"]);
            $humid_min = test_input($_POST["humid_min"]);
            $humid_avg = test_input($_POST["humid_avg"]);
            $humid_max = test_input($_POST["humid_max"]);
            $sql = "INSERT INTO `gh_humidity_report`(`customer_id`,`land_name`, `humid_min`,`humid_avg`,`humid_max`) 
            VALUES ('$customer_id','$land_name','$humid_min','$humid_avg','$humid_max')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }    
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