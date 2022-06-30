<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET');

header("Access-Control-Allow-Headers: X-Requested-With");

if (isset($_REQUEST['village'])) {
    $village = strtolower($_REQUEST['village']);
    require('config.php');
    //find aasha allocated for that village.
    $res =  array();
    $res['status'] = 400;
    $res['name'] = NULL;
    $query = "SELECT * from aasha WHERE lower(village) = '$village'";


    $qr = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($qr);
    if (!$data) {
        echo json_encode($res);
        exit;
    } else {

        $res['status'] = 200;
        $res['name'] = $data['name'];
        echo json_encode($res);
        exit;
    }
}