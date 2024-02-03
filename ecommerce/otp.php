<?php
 
define("SERVER", "https://sms.yegara.com/api");
define("TOKEN", "e450a5d-5622ce9-3-50d4ba-da83468-3c-8f43");

function sendSMS($to, $message, $template_id)
{

    $postData = array('to' => $to, 'message' => $message,  'template_id' =>$template_id,  'token' => TOKEN);
    
    $url = SERVER . "/send";    
    $content = json_encode($postData);
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    //return $json_response; 
}
