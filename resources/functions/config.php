<?php
date_default_timezone_set("Asia/Kolkata");

//CONSTENTS FOR DB.
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'velviqrk_kilkari';

// CONNECTION TO DB.
$conn = mysqli_connect($server, $user, $pass, $db) or die("Database connection failed :(");


// CONSTENTS FOR THE SMS API.
$authKey = "YourAuthKey";
$senderId = "102234";
$route = "default";
$url="http://sms.velvish.com/api/sendhttp.php";

$apiUrl="http://localhost/kilkarirewa/resources/functions/api.php";
