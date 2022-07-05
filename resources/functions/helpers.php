<?php
include('../resources/functions/config.php');

function sendSMSOnRegistration($aadhar){
    global $conn;
    $query = "SELECT * FROM patient WHERE aadhar='$aadhar' ";
    $temp_result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($temp_result);
    $mobileNumber=$row['mobile'];
    $name=$row['name'];
    $message="श्रीमति $name, आपकी गर्भावस्था जांच के साथ किलकारी पोर्टल में पंजीयन हो गया है।";
    return sendSMS($mobileNumber,$message);
}


function sendSMS($mobileNumber,$message){
    global $authKey;
    global $senderId ;
    global $route ;
    global $url;
    $message = urlencode($message);
    $postData = array(
                'authkey' => $authKey,
                'mobiles' => $mobileNumber,
                'message' => $message,
                'sender' => $senderId,
                'route' => $route
                );
    $ch = curl_init();
    curl_setopt_array($ch, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $postData));
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
    // $output = curl_exec($ch);
    // if(curl_errno($ch))
    // {
    //     curl_close($ch);
    //     return 'error:' . curl_error($ch);
    // }
    // curl_close($ch);
    // return $output;
}


function getVillages($SHC)
{
    global $conn;
    $query = "SELECT * FROM blocks WHERE SHC='$SHC' ";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row['village'];
        $i++;
    }
    return $result;
}


function getAllPatients($SHC)
{
    global $conn;
    $query = "SELECT * FROM patient WHERE SHC='$SHC' ";
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
    $SHC,
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
 name, husband_name, aadhar, mobile, address, village, block,SHC, city, aasha, lmp, APH, eclampsia, PIH, anaemia, obstructed_labor, PPH, LSCS, congenital_anamaly, abortion, others_1, tuberculosis, hypertension, heart_disease, diabetes, asthma, other_2) VALUES (
NULL,'$name','$husband_name','$aadhar','$mobile','$address','$village','$block','$SHC','$city','$aasha','$lmp','$APH','$eclampsia','$PIH','$anaemia','$obstructed_labor','$PPH','$LSCS','$congenital_anamaly','$abortion','$others_1','$tuberculosis','$hypertension','$heart_disease','$diabetes','$asthma','$other_2')";

    return mysqli_query($conn, $insert_query);
}

function editPatient(
    $uid,
    $name,
    $husband_name,
    $aadhar,
    $mobile,
    $address,
    $village,
    $block,
    $SHC,
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

    $update_query = "UPDATE  patient SET 
    name = '$name' , 
    husband_name = '$husband_name' ,
    aadhar='$aadhar',
    mobile='$mobile',
    address='$address',
    village='$village',
    block='$block',
    SHC ='$SHC',
    city='$city',
    aasha='$aasha',
    lmp = '$lmp' ,
    APH = '$APH' , 
    eclampsia = '$eclampsia' , 
    PIH =   '$PIH' ,
    anaemia =   '$anaemia' ,
    obstructed_labor =  '$obstructed_labor'  ,
    PPH =   '$PPH' ,
    LSCS =  '$LSCS' , 
    congenital_anamaly =    '$congenital_anamaly' ,
    abortion =  '$abortion' ,
    others_1 =  '$others_1' , 
    tuberculosis =  '$tuberculosis' ,
    hypertension =  '$hypertension' , 
    heart_disease = '$heart_disease' , 
    diabetes =  '$diabetes' , 
    asthma =  '$asthma' , 
    other_2 = '$other_2' WHERE id ='$uid'";
    return mysqli_query($conn, $update_query);
}
