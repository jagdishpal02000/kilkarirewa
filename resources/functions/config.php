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
$authKey = "328354Acn8F597TT5R62dba023P1";
$senderId = "CMHORW";
$route = "4";
$url="https://sms.velvish.com/api/sendhttp.php";


// message template ids :

// Registration message.
$UserRegistrationTempId="1207165727144689120";

// Periodic Reminder Message.(ac reminders)
$CheckupReminderTempId="1207165727126705494";
$AdminReminderTempId="1207165727088426363";

//Delivery Reminder Message
$DeliveryReminderTempId="1207165727120144494";
$AdminDeliveryTempId="1207165727138387049";


$apiUrl="http://localhost/kilkarirewa/resources/functions/api.php";
$adminApiUrl="http://localhost/kilkarirewa/resources/functions/admin-api.php";

