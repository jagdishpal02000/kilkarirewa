<?php
session_start();
if (!isset($_SESSION['type']) || ($_SESSION['type'] != 'anm' && $_SESSION['type'] != 'admin')) {
    $res =  array();
    $res['status'] = 400; 
    $res['error'] = "Authentication failed";
    echo json_encode($res);
    exit;
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
require('config.php');

if (isset($_REQUEST['village'])) {
    $village = strtolower($_REQUEST['village']);
    //find aasha allocated for that village.
    $res =  array();
    $res['status'] = 400;
    $res['name'] = array();
    $query = "SELECT * from aasha WHERE lower(village) = '$village'";

    $qr = mysqli_query($conn, $query);

    if (mysqli_num_rows($qr) > 0) {
        while ($row = mysqli_fetch_assoc($qr)) {
            array_push($res['name'], $row['name']);
        }
        $res['status'] = 200;
        echo json_encode($res);
        exit;
    } else {
        echo json_encode($res);
        exit;
    }
}

if (isset($_REQUEST['id']) && isset($_REQUEST['value']) && isset($_REQUEST['field'])) {

    $id = $_REQUEST['id'];
    $value = strtolower($_REQUEST['value']);
    $field = strtolower($_REQUEST['field']);

    $res =  array();
    $res['status'] = 400;
    $res['status'] = 'failed';
    $query = "UPDATE patient SET $field='$value' WHERE id = '$id'";


    if (!mysqli_query($conn, $query)) {
        echo json_encode($res);
        exit;
    } else {
        $res['status'] = 200;
        $res['status'] = "success";
        echo json_encode($res);
        exit;
    }
}

if (isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];
    $res =  array();
    $res['status'] = 400;
    $res['name'] = NULL;
    $query = "SELECT * from patient WHERE id = '$id'";

    $qr = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($qr);
    if (!$data) {
        echo json_encode($res);
        exit;
    } else {
        $res['status'] = 200;
        $res['data'] = $data;
        echo json_encode($res);
        exit;
    }
}
