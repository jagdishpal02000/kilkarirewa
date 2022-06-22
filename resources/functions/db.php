<?php
date_default_timezone_set("Asia/Kolkata");

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'velviqrk_kilkari';

$conn = mysqli_connect($server, $user, $pass, $db) or die("Database connection failed :(");
