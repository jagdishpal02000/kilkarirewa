<?php
include('../resources/functions/db.php');

function getVillages($block)
{
    global $conn;
    $query = "SELECT * FROM blocks WHERE block='$block' ";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row['village'];
        $i++;
    }
    return $result;
}


function getAllPatients($block_name)
{
    global $conn;
    $query = "SELECT * FROM patient WHERE block='$block_name' ";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row;
        $i++;
    }
    return $result;
}


function addPatient(
    $name,
    $husband_name,
    $aadhar,
    $mobile,
    $address,
    $village,
    $block,
    $city,
    $aasha,
    $lmp,

    $APH,
    $eclampsia,
    $PIH,
    $anaemia,
    $obstructed_labor,
    $PPH,
    $LSCS,
    $congenital_anamaly,
    $abortion,
    $others_1,
    $tuberculosis,
    $hypertension,
    $heart_disease,
    $diabetes,
    $asthma,
    $other_2

) {

    global $conn;

    $insert_query = "INSERT INTO patient(id,
 name, husband_name, aadhar, mobile, address, village, block, city, aasha, lmp, APH, eclampsia, PIH, anaemia, obstructed_labor, PPH, LSCS, congenital_anamaly, abortion, others_1, tuberculosis, hypertension, heart_disease, diabetes, asthma, other_2) VALUES (
NULL,'$name','$husband_name','$aadhar','$mobile','$address','$village','$block','$city','$aasha','$lmp','$APH','$eclampsia','$PIH','$anaemia','$obstructed_labor','$PPH','$LSCS','$congenital_anamaly','$abortion','$others_1','$tuberculosis','$hypertension','$heart_disease','$diabetes','$asthma','$other_2')";

    return mysqli_query($conn, $insert_query);
}
