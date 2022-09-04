<?php
include('helpers.php');
    $today=date("Y/m/d");  
    $edd = date('Y-m-d', strtotime("$today - 9 month - 25 day"));
die($edd);
    // patient
   $date1_ac1 = date('Y-m-d', strtotime("$today - 126 day"));
   $date2_ac1 = date('Y-m-d', strtotime("$today - 133 day"));
   $date3_ac1 = date('Y-m-d', strtotime("$today - 140 day"));
   $date1_ac2 = date('Y-m-d', strtotime("$today - 168 day"));
   $date2_ac2 = date('Y-m-d', strtotime("$today - 175 day"));
   $date3_ac2 = date('Y-m-d', strtotime("$today - 182 day"));
   $date1_ac3 = date('Y-m-d', strtotime("$today - 238 day"));
   $date2_ac3 = date('Y-m-d', strtotime("$today - 245 day"));
   $date3_ac3 = date('Y-m-d', strtotime("$today - 252 day"));

   $date1_edd_1 = date('Y-m-d', strtotime("$today - 9 month - 25 day"));
   $date1_edd_2 = date('Y-m-d', strtotime("$today - 9 month - 18 day"));
   $date1_edd_3 = date('Y-m-d', strtotime("$today - 9 month - 11 day"));

//    echo $date1_ac1."  ".$date2_ac1."  ".$date3_ac1."  ".$date1_ac2."  ".$date2_ac2."  ".$date3_ac2."  ".$date1_ac3."  ".$date2_ac3."  ".$date3_ac3."  ";
// 1. patient
// 2. aasha
// 3. anm



$date1_ac1_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date1_ac1' and ac1=0  ";
$date2_ac1_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date2_ac1' and ac1=0  ";
$date3_ac1_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date3_ac1' and ac1=0  ";
$date1_ac2_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date1_ac2' and ac2=0  ";
$date2_ac2_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date2_ac2' and ac2=0  ";
$date3_ac2_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date3_ac2' and ac2=0  ";
$date1_ac3_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date1_ac3' and ac3=0  ";
$date2_ac3_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date2_ac3' and ac3=0  ";
$date3_ac3_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date3_ac3' and ac3=0  ";

$date1_edd_1_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date1_edd_1' and delivery=0  ";
$date1_edd_2_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date1_edd_2' and delivery=0  ";
$date1_edd_3_query = "SELECT p.name as name ,p.mobile as mobile, p.aasha as aasha, p.SHC as SHC, p.lmp as lmp,a.name as anm_name, a.mobile as anm_mobile,a.email as anm_email,aasha.mobile as aasha_mobile,aasha.email as aasha_email, aasha.name as aasha_name FROM patient p INNER JOIN anm a ON a.SHC =p.SHC  INNER JOIN aasha ON p.village = aasha.village where lmp= '$date1_edd_3' and delivery=0  ";


$patiet_data = array();
$date1_edd_1_temp = mysqli_query($conn, $date1_edd_1_query);
$date1_edd_1_res = mysqli_fetch_all($date1_edd_1_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date1_edd_1_res);$i++){
    $date1_edd_1_res[$i]['msg_to']="patient";
    $date1_edd_1_res[$i]['type']="4";
    $date1_edd_1_res[$i]['edd']=date('Y-m-d', strtotime("$date1_edd_1_res[$i]['lmp'] + 9 month"));
    
    array_push($patiet_data,$date1_edd_1_res[$i]);
}
$date1_edd_2_temp = mysqli_query($conn, $date1_edd_2_query);
$date1_edd_2_res = mysqli_fetch_all($date1_edd_2_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date1_edd_2_res);$i++){
    $date1_edd_2_res[$i]['msg_to']="patient";
    $date1_edd_2_res[$i]['type']="4";
    $date1_edd_2_res[$i]['edd']=date('Y-m-d', strtotime("$date1_edd_1_res[$i]['lmp'] + 9 month"));
    array_push($patiet_data,$date1_edd_2_res[$i]);
}
$date1_edd_3_temp = mysqli_query($conn, $date1_edd_3_query);
$date1_edd_3_res = mysqli_fetch_all($date1_edd_3_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date1_edd_3_res);$i++){
    $date1_edd_3_res[$i]['msg_to']="patient";
    $date1_edd_3_res[$i]['type']="4";
    $date1_edd_3_res[$i]['edd']=date('Y-m-d', strtotime("$date1_edd_1_res[$i]['lmp'] + 9 month"));
    array_push($patiet_data,$date1_edd_3_res[$i]);
}

$date1_ac1_temp = mysqli_query($conn, $date1_ac1_query);
$date1_ac1_res = mysqli_fetch_all($date1_ac1_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date1_ac1_res);$i++){
    $date1_ac1_res[$i]['msg_to']="patient";
    $date1_ac1_res[$i]['type']="1";
    array_push($patiet_data,$date1_ac1_res[$i]);
}



$date2_ac1_temp = mysqli_query($conn, $date2_ac1_query);
$date2_ac1_res = mysqli_fetch_all($date2_ac1_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date2_ac1_res);$i++){
    $date2_ac1_res[$i]['type']="1";
    $date2_ac1_res[$i]['msg_to']="aasha";
    array_push($patiet_data,$date2_ac1_res[$i]);
}


$date3_ac1_temp = mysqli_query($conn, $date3_ac1_query);
$date3_ac1_res = mysqli_fetch_all($date3_ac1_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date3_ac1_res);$i++){
    $date3_ac1_res[$i]['type']="1";
    $date3_ac1_res[$i]['msg_to']="anm";
    array_push($patiet_data,$date3_ac1_res[$i]);
}

$date1_ac2_temp = mysqli_query($conn, $date1_ac2_query);
$date1_ac2_res = mysqli_fetch_all($date1_ac2_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date1_ac2_res);$i++){
    $date1_ac2_res[$i]['type']="2";
    $date1_ac2_res[$i]['msg_to']="patient";
    array_push($patiet_data,$date1_ac2_res[$i]);
}
$date2_ac2_temp = mysqli_query($conn, $date2_ac2_query);
$date2_ac2_res = mysqli_fetch_all($date2_ac2_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date2_ac2_res);$i++){
    $date2_ac2_res[$i]['type']="2";
    $date2_ac2_res[$i]['msg_to']="aasha";
    array_push($patiet_data,$date2_ac2_res[$i]);
}
$date3_ac2_temp = mysqli_query($conn, $date3_ac2_query);
$date3_ac2_res = mysqli_fetch_all($date3_ac2_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date3_ac2_res);$i++){
    $date3_ac2_res[$i]['type']="2";
    $date3_ac2_res[$i]['msg_to']="anm";
    array_push($patiet_data,$date3_ac2_res[$i]);
}
$date1_ac3_temp = mysqli_query($conn, $date1_ac3_query);
$date1_ac3_res = mysqli_fetch_all($date1_ac3_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date1_ac3_res);$i++){
    $date1_ac3_res[$i]['type']="3";
    $date1_ac3_res[$i]['msg_to']="patient";
    array_push($patiet_data,$date1_ac3_res[$i]);
}
$date2_ac3_temp = mysqli_query($conn, $date2_ac3_query);
$date2_ac3_res = mysqli_fetch_all($date2_ac3_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date2_ac3_res);$i++){
    $date2_ac3_res[$i]['type']="3";
    $date2_ac3_res[$i]['msg_to']="aasha";
    array_push($patiet_data,$date2_ac3_res[$i]);
}
$date3_ac3_temp = mysqli_query($conn, $date3_ac3_query);
$date3_ac3_res = mysqli_fetch_all($date3_ac3_temp, MYSQLI_ASSOC);
for($i=0;$i<count($date3_ac3_res);$i++){
    $date3_ac3_res[$i]['type']="3";
    $date3_ac3_res[$i]['msg_to']="anm";
    array_push($patiet_data,$date3_ac3_res[$i]);
}


for($i=0;$i<count($patiet_data);$i++){
$patient_name = $patiet_data[$i]['name'];
$patient_mobile = $patiet_data[$i]['mobile'];
$anm_name = $patiet_data[$i]['anm_name'];
$anm_mobile = $patiet_data[$i]['anm_mobile'];
$aasha_mobile = $patiet_data[$i]['aasha_mobile'];
$aasha_name = $patiet_data[$i]['aasha_name'];
$msg_to=$patiet_data[$i]['msg_to'];
$type=$patiet_data[$i]['type'];


$patient_message_1 = "श्रीमती $patient_name, आप के द्वितीय गर्भावस्था जांच हेतु $anm_name,  ($anm_mobile) से संपर्क कर अथवा नजदीकी स्वास्थ्य केन्द्र में जाकर तत्काल जांच करांवे।";
$anm_message_1 = "आपके गांव की गर्भवती महिला श्रीमति $patient_name की द्वितीय गर्भावस्था जांच का समय पूर्ण है। कृपया तत्काल जांच करांवे।";
$aasha_message_1 = "आपके गांव की गर्भवती महिला श्रीमति $patient_name की द्वितीय गर्भावस्था जांच का समय पूर्ण है। कृपया तत्काल जांच करांवे।";

$patient_message_2 = "श्रीमती $patient_name, आप के तृतीय गर्भावस्था जांच हेतु $anm_name,  ($anm_mobile) से संपर्क कर अथवा नजदीकी स्वास्थ्य केन्द्र में जाकर तत्काल जांच करांवे।";
$anm_message_2 = "आपके गांव की गर्भवती महिला श्रीमति $patient_name की तृतीय गर्भावस्था जांच का समय पूर्ण है। कृपया तत्काल जांच करांवे।";
$aasha_message_2 = "आपके गांव की गर्भवती महिला श्रीमति $patient_name की तृतीय गर्भावस्था जांच का समय पूर्ण है। कृपया तत्काल जांच करांवे।";

$patient_message_3 = "श्रीमती $patient_name, आप के चतुर्थ  गर्भावस्था जांच हेतु $anm_name,  ($anm_mobile) से संपर्क कर अथवा नजदीकी स्वास्थ्य केन्द्र में जाकर तत्काल जांच करांवे।";
$anm_message_3 = "आपके गांव की गर्भवती महिला श्रीमति $patient_name की चतुर्थ  गर्भावस्था जांच का समय पूर्ण है। कृपया तत्काल जांच करांवे।";
$aasha_message_3 = "आपके गांव की गर्भवती महिला श्रीमति $patient_name की चतुर्थ  गर्भावस्था जांच का समय पूर्ण है। कृपया तत्काल जांच करांवे।";


$patient_message_edd_1 = "श्रीमती $patient_name, आपकी प्रसव की अनुमानित तिथि {#EDD#}) है जांच हेतु {#ANMNAME#} ({#ANMMOBILE#}) से संपर्क कर अथवा नजदीकी स्वास्थ्य केन्द्र में जाकर तत्काल जांच करांवे।";
$anm_message_edd_2 = "आपके गांव की गर्भवती महिला श्रीमति {#PNAME#} की प्रसव की अनुमानित तिथि {#EDD#}) है। कृपया तत्काल जांच करांवे।";
$aasha_message_edd_3 = "श्रीमती {#PNAME#}, आपकी प्रसव की अनुमानित तिथि {#EDD#}) है जांच हेतु {#ANMNAME#} ({#ANMMOBILE#}) से संपर्क कर अथवा नजदीकी स्वास्थ्य केन्द्र में जाकर तत्काल जांच करांवे।";


$mobile =""; 
$message = "";

switch ($type){
    case '1' :
        switch ($msg_to){
            case 'patient':
                $mobile =$patient_mobile; 
                $message = $patient_message_1;
                break;
            case 'aasha':
                $mobile =$aasha_mobile; 
                $message = $aasha_message_1;
                break;
            case 'anm':
                $mobile =$anm_mobile; 
                $message = $anm_message_1;
                break;
            default:
            break;
        }
        break;
    case  '2':
        switch ($msg_to){
            case 'patient':
                $mobile =$patient_mobile; 
                $message = $patient_message_2;
                break;
            case 'aasha':
                $mobile =$aasha_mobile; 
                $message = $aasha_message_2;
                break;
            case 'anm':
                $mobile =$anm_mobile; 
                $message = $anm_message_2;
                break;
            default:
            break;
        }
        break;
    case  '3':
        switch ($msg_to){
            case 'patient':
                $mobile =$patient_mobile; 
                $message = $patient_message_3;
                break;
            case 'aasha':
                $mobile =$aasha_mobile; 
                $message = $aasha_message_3;
                break;
            case 'anm':
                $mobile =$anm_mobile; 
                $message = $anm_message_3;
                break;
            default:
            break;
        }
        break;
    case  '4':
        switch ($msg_to){
            case 'patient':
                $mobile =$patient_mobile; 
                $message = $patient_message_edd_1;
                break;
            case 'aasha':
                $mobile =$aasha_mobile; 
                $message = $anm_message_edd_2;
                break;
            case 'anm':
                $mobile =$anm_mobile; 
                $message = $anm_message_edd_3;
                break;
            default:
            break;
        }
        break;
    default:  
    break;
}

print_r($patiet_data[$i]);
echo "<br><br>";
echo $message;

echo "<br><br>";
}

?>