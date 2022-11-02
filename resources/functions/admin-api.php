<?php
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
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
require('helpers.php');



if (isset($_REQUEST['block']) && isset($_REQUEST['shc']) && isset($_REQUEST['village']) && isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) ){

    $block = strtolower($_REQUEST['block']);
    $shc = strtolower($_REQUEST['shc']);
    $village = strtolower($_REQUEST['village']);
    $start_date = strtolower($_REQUEST['start_date']);
    $end_date = strtolower($_REQUEST['end_date']);

    $res =  array();
    $res['data'] = getAllPatientsDataAdmin($block,$shc,$village, $start_date, $end_date);
    $res['status'] = 200;
    echo json_encode($res);
    exit;
    
}









if (isset($_REQUEST['block'])) {
    $block = strtolower($_REQUEST['block']);
    //find aasha allocated for that village.
    $res =  array();
    $res['status'] = 400;
    $res['blocks'] = array();
    
    if($block){
        $res['blocks'] = getAllSHC($block);
        $res['status'] = 200;
        echo json_encode($res);
        exit;
    } else {
        echo json_encode($res);
        exit;
    }
}

if (isset($_REQUEST['shc'])) {
    $shc = strtolower($_REQUEST['shc']);
    //find aasha allocated for that village.
    $res =  array();
    $res['status'] = 400;
    $res['blocks'] = array();
    
    if($shc){
        $res['blocks'] = getVillages($shc);
        $res['status'] = 200;
        echo json_encode($res);
        exit;
    } else {
        echo json_encode($res);
        exit;
    }
}


