<?php
include('config.php');

function sendSMSOnRegistration($aadhar)
{
    global $conn;
    global $UserRegistrationTempId;

    $query = "SELECT * FROM patient WHERE aadhar='$aadhar' ";
    $temp_result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($temp_result);
    $mobileNumber = $row['mobile'];
    $name = $row['name'];
    $message = "श्रीमति $name, आपकी गर्भावस्था जांच के साथ किलकारी पोर्टल में पंजीयन हो गया है। Kilkari (CMHO, Rewa) - Velvish";
    return sendSMS($mobileNumber, $message,$UserRegistrationTempId);
}

function sendSMS($mobile,$message,$TEMPLATE_ID){
    global $authKey;
    global $senderId;
    global $route;
    global $url;
    
    $message = urlencode($message);
    $mobileNumber='91'.$mobile;
    $request_url="$url?authkey=$authKey&mobiles=$mobileNumber&message=$message&sender=$senderId&route=$route&country=0&unicode=1&DLT_TE_ID=$TEMPLATE_ID";
	$curl = curl_init($request_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
	  'Content-Type: application/json'
	]);

	$output = curl_exec($curl);
	$result = json_decode($output, true);

	return $result;

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



function getAllDataFromDate($from,$to,$SHC){
    
    global $conn;

    $query = "SELECT p.name,p.husband_name,p.aadhar,p.village,p.mobile,p.block,p.SHC,p.city,p.aasha,p.lmp,p.APH,p.eclampsia,p.PIH,p.anaemia,p.obstructed_labor,p.PPH,p.LSCS,p.congenital_anamaly,p.abortion,p.others_1,p.tuberculosis,p.hypertension,p.heart_disease,p.diabetes,p.asthma,p.other_2,p.address,p.ac1,p.ac2,p.ac3,p.delivery,anm.name as anm_name FROM patient p INNER JOIN anm ON anm.SHC=p.SHC WHERE p.lmp>='$from' and p.lmp<='$to' and p.SHC='$SHC'";
    $temp_result = mysqli_query($conn, $query);

    $resp_data=array(); 
    while($row = mysqli_fetch_assoc($temp_result)){
            array_push($resp_data, $row);

    }
   return $resp_data;
}