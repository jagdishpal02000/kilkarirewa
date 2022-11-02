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
    $query = "SELECT * FROM patient WHERE SHC='$SHC' ORDER BY id DESC";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row;
        $i++;
    }
    return $result;
}

function getAllPatientsDataAdmin($block,$shc,$village, $start_date, $end_date){

    global $conn;
    $query = "SELECT p.id as id,p.name as name,	p.husband_name as husband_name,	p.aadhar as aadhar,	p.village as village,	p.mobile as mobile,	p.block	as block,p.SHC	as SHC,p.city	as city,a.name as anm_name,a.mobile as anm_mobile,a.email	as anm_email,p.aasha	as aasha,p.lmp as lmp,p.ac1 as ac1	,p.ac2 as ac2	,p.ac3 as ac3	,p.delivery as delivery,p.address as address	,p.APH as APH,p.eclampsia as eclampsia,	p.PIH	 as PIH,p.anaemia as anaemia,	p.obstructed_labor as obstructed_labor, 	p.PPH	 as PPH,p.LSCS	 as LSCS,p.congenital_anamaly as congenital_anamaly,	p.abortion	 as abortion,p.others_1 as others_1, 	p.tuberculosis as tuberculosis,	p.hypertension as hypertension,	p.heart_disease as heart_disease,	p.diabetes	 as diabetes,p.asthma	     as asthma,p.other_2	     as other_2 FROM patient p INNER JOIN anm a ON a.SHC = p.SHC WHERE p.block='$block' and p.SHC='$shc' and p.village='$village'  and p.lmp >='$start_date' and p.lmp <= '$end_date' ORDER BY p.id DESC";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row;
        $i++;
    }
    return $result;
}

function getAllDefaultPatient()
{
    global $conn;
    $query = "SELECT p.id as id,p.name as name,	p.husband_name as husband_name,	p.aadhar as aadhar,	p.village as village,	p.mobile as mobile,	p.block	as block,p.SHC	as SHC,p.city	as city,a.name as anm_name,a.mobile as anm_mobile,a.email	as anm_email,p.aasha	as aasha,p.lmp as lmp,p.ac1 as ac1	,p.ac2 as ac2	,p.ac3 as ac3	,p.delivery as delivery,p.address as address	,p.APH as APH,p.eclampsia as eclampsia,	p.PIH	 as PIH,p.anaemia as anaemia,	p.obstructed_labor as obstructed_labor, 	p.PPH	 as PPH,p.LSCS	 as LSCS,p.congenital_anamaly as congenital_anamaly,	p.abortion	 as abortion,p.others_1 as others_1, 	p.tuberculosis as tuberculosis,	p.hypertension as hypertension,	p.heart_disease as heart_disease,	p.diabetes	 as diabetes,p.asthma	     as asthma,p.other_2	     as other_2 FROM patient p INNER JOIN anm a ON a.SHC = p.SHC ORDER BY `p`.`LMP` DESC LIMIT 100  ";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row;
        $i++;
    }
    return $result;
}

function exportAllData()
{
    global $conn;
    $query = "SELECT p.id as id,p.name as name,	p.husband_name as husband_name,	p.aadhar as aadhar,	p.village as village,	p.mobile as mobile,	p.block	as block,p.SHC	as SHC,p.city	as city,a.name as anm_name,a.mobile as anm_mobile,a.email	as anm_email,p.aasha	as aasha,p.lmp as lmp,p.ac1 as ac1	,p.ac2 as ac2	,p.ac3 as ac3	,p.delivery as delivery,p.address as address	,p.APH as APH,p.eclampsia as eclampsia,	p.PIH	 as PIH,p.anaemia as anaemia,	p.obstructed_labor as obstructed_labor, 	p.PPH	 as PPH,p.LSCS	 as LSCS,p.congenital_anamaly as congenital_anamaly,	p.abortion	 as abortion,p.others_1 as others_1, 	p.tuberculosis as tuberculosis,	p.hypertension as hypertension,	p.heart_disease as heart_disease,	p.diabetes	 as diabetes,p.asthma	     as asthma,p.other_2	     as other_2 FROM patient p INNER JOIN anm a ON a.SHC = p.SHC ORDER BY `p`.`LMP` DESC;";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    if(!$temp_result){
        print_r(mysqli_error($conn));
        die();
    }
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row;
        $i++;
    }
    return $result;
}



function getAllBlocks($city="rewa")
{
    global $conn;
    $query = "SELECT block FROM blocks where city='$city' GROUP BY block ORDER BY block ASC";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row['block'];
        $i++;
    }
    return $result;
}

function getAllSHC($block)
{
    global $conn;
    $query = "SELECT SHC FROM blocks where block='$block' GROUP BY SHC ORDER BY SHC ASC";
    $temp_result = mysqli_query($conn, $query);
    $result = array();
    $i = 0;
    while ($row = mysqli_fetch_array($temp_result)) {
        $result[$i] = $row['SHC'];
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