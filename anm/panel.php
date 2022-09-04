<?php
session_start();
$successful = false;
$failed = false;
$editSuccessful=false;
$editFailed=false;
require('../resources/functions/helpers.php');
$anm_name = $_SESSION['anm_data']['name'];
$SHC = $_SESSION['anm_data']['SHC'];
$block_name = $_SESSION['anm_data']['block'];
$city_name = $_SESSION['anm_data']['city'];
$village_list = getVillages($SHC);
if (isset($_POST['add_patient'])) {
   $name = $_POST['name'];
   $husband_name = $_POST['husband_name'];
   $aadhar = $_POST['aadhar'];
   $mobile = $_POST['mobile'];
   $address = $_POST['address'];
   $village = $_POST['village'];
   $block = $block_name;
   $SHC = $SHC;
   $city = $city_name;
   $aasha = $_POST['aasha'];
   $lmp = $_POST['lmp'];
   isset($_POST['APH']) ? $APH = $_POST['APH'] : $APH = 0;
   isset($_POST['eclampsia']) ? $eclampsia = $_POST['eclampsia'] : $eclampsia = 0;
   isset($_POST['PIH']) ? $PIH = $_POST['PIH'] : $PIH = 0;
   isset($_POST['anaemia']) ? $anaemia = $_POST['anaemia'] : $anaemia = 0;
   isset($_POST['obstructed_labor']) ? $obstructed_labor = $_POST['obstructed_labor'] : $obstructed_labor = 0;
   isset($_POST['PPH']) ? $PPH = $_POST['PPH'] : $PPH = 0;
   isset($_POST['LSCS']) ? $LSCS = $_POST['LSCS'] : $LSCS = 0;
   isset($_POST['congenital_anamaly']) ? $congenital_anamaly = $_POST['congenital_anamaly'] : $congenital_anamaly = 0;
   isset($_POST['abortion']) ? $abortion = $_POST['abortion'] : $abortion = 0;
   isset($_POST['others_1']) ? $others_1 = $_POST['others_1'] : $others_1 = 0;
   isset($_POST['tuberculosis']) ? $tuberculosis = $_POST['tuberculosis'] : $tuberculosis = 0;
   isset($_POST['hypertension']) ? $hypertension = $_POST['hypertension'] : $hypertension = 0;
   isset($_POST['heart_disease']) ? $heart_disease = $_POST['heart_disease'] : $heart_disease = 0;
   isset($_POST['diabetes']) ? $diabetes = $_POST['diabetes'] : $diabetes = 0;
   isset($_POST['asthma']) ? $asthma = $_POST['asthma'] : $asthma = 0;
   isset($_POST['other_2']) ? $other_2 = $_POST['other_2'] : $other_2 = 0;


   if (addPatient(
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
   ))
      $successful = true;
   else $failed = true;
   if ($successful) {
      sendSMSOnRegistration($aadhar);
   }
}
if (isset($_POST['edit_patient'])) {
   $uid = $_POST['uid'];
   $name = $_POST['e-name'];
   $husband_name = $_POST['e-husband_name'];
   $aadhar = $_POST['e-aadhar'];
   $mobile = $_POST['e-mobile'];
   $address = $_POST['e-address'];
   $village = $_POST['e-village'];
   $block = $block_name;
   $SHC = $SHC;
   $city = $city_name;
   $aasha = $_POST['e-aasha'];
   $lmp = $_POST['e-lmp'];
   isset($_POST['e-APH']) ? $APH = $_POST['e-APH'] : $APH = 0;
   isset($_POST['e-eclampsia']) ? $eclampsia = $_POST['e-eclampsia'] : $eclampsia = 0;
   isset($_POST['e-PIH']) ? $PIH = $_POST['e-PIH'] : $PIH = 0;
   isset($_POST['e-anaemia']) ? $anaemia = $_POST['e-anaemia'] : $anaemia = 0;
   isset($_POST['e-obstructed_labor']) ? $obstructed_labor = $_POST['e-obstructed_labor'] : $obstructed_labor = 0;
   isset($_POST['e-PPH']) ? $PPH = $_POST['e-PPH'] : $PPH = 0;
   isset($_POST['e-LSCS']) ? $LSCS = $_POST['e-LSCS'] : $LSCS = 0;
   isset($_POST['e-congenital_anamaly']) ? $congenital_anamaly = $_POST['e-congenital_anamaly'] : $congenital_anamaly = 0;
   isset($_POST['e-abortion']) ? $abortion = $_POST['e-abortion'] : $abortion = 0;
   isset($_POST['e-others_1']) ? $others_1 = $_POST['e-others_1'] : $others_1 = 0;
   isset($_POST['e-tuberculosis']) ? $tuberculosis = $_POST['e-tuberculosis'] : $tuberculosis = 0;
   isset($_POST['e-hypertension']) ? $hypertension = $_POST['e-hypertension'] : $hypertension = 0;
   isset($_POST['e-heart_disease']) ? $heart_disease = $_POST['e-heart_disease'] : $heart_disease = 0;
   isset($_POST['e-diabetes']) ? $diabetes = $_POST['e-diabetes'] : $diabetes = 0;
   isset($_POST['e-asthma']) ? $asthma = $_POST['e-asthma'] : $asthma = 0;
   isset($_POST['e-other_2']) ? $other_2 = $_POST['e-other_2'] : $other_2 = 0;


   

   if (editPatient(
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
   ))
      $editSuccessful = true;
   else $editFailed = true;
}


$all_patients_data = getAllPatients($SHC);
?>
<?php
include '../resources/sections/head.php';
?>
<title>Patient Panel | Kilkari Abhiyan</title>
<meta name="description" content=in page for ANM and pati <meta property="og:title" content="Patient Panel | Kilkari Abhiyan">
<meta property="og:description" content="View your scheduled check up details.">
<meta name="twitter:title" content="Patient Panel | Kilkari Abhiyan">
<meta name="twitter:description" content="View your scheduled check up details.">
<meta property="og:url" content="https://kilkarirewa.in/patient">
<link rel="canonical" href="https://kilkarirewa.in/patient/">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<style>
   table td:nth-child(2)  {
  position: sticky;
  left: 0;
  background-color: white;
}
.checkbox,.edit-btn,.view-single-btn {
   cursor:pointer;
}

</style>
<?php
include '../resources/sections/header.php';
?>
<div class="title">
   <div class="container">
      <div class="row">
         <h2 class="text-center">ANM पैनल</h2>
      </div>
   </div>
</div>
<?php
include '../resources/sections/anm_menu.php';
?>
<div class="container">
      <div class="row">
         <div class="col-3">
            <label for="from" class="form-label">From</label>
            <input type="date" name="from" id="from" class="form-control">
         </div>
         <div class="col-3">
            <label for="to" class="form-label">To</label>
            <input type="date" id="to" name="to" class="form-control">
         </div>
         <div class="row">
            <label id="export_error" style="display:none;color:red" for="">Please Select Dates</label>
         <button type="button" id="export_data" class="btn btn-dark btn-primary" style="user-select: auto;">Export</button></div>
      </div>
</div>
<section>
   <div class="container">
      <?php
      if ($successful)
         echo '<div class="alert alert-success" role="alert"><h6 class="text-success text-center">नया Patient जोड़ा गया</h6></div>';
      if ($failed)
         echo '<div class="alert alert-danger" role="alert"><h6 class="text-danger text-center">Patient जोड़ने में असमर्थ</h6></div>';
      
      if ($editSuccessful)
         echo '<div class="alert alert-success" role="alert"><h6 class="text-success text-center">Patient Details Updated Successfully</h6></div>';
      if ($editFailed)
         echo '<div class="alert alert-danger" role="alert"><h6 class="text-danger text-center">Failed to Update</h6></div>';
      
      
      ?>
      <h3 class="text-center"><?= $block_name ?> Patients List</h3>
      <div class="table-responsive tscroll" >
      <table id="view_patient_table" class="table table-hover border" style="overflow: auto;">
         <thead>
            <tr>
               <th scope="col">S.No.</th>
               <th class="freeze"style="background-color:white;position:sticky;left:0;z-index:2;" scope="col">Patient Name</th>
               <th scope="col">Mobile</th>
               <th scope="col">Aasha</th>
               <th scope="col">LMP</th>
               <th scope="col">CheckUp 1</th>
               <th scope="col">CheckUp 2</th>
               <th scope="col">CheckUp 3</th>
               <th scope="col">CheckUp 4</th>
               <th scope="col">Delivery</th>
               <th scope="col">Edit</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $i = 1;
            foreach ($all_patients_data as $patient) {
               $ac1_checked =  $patient['ac1'] == 1 ? 'checked' : '';
               $ac2_checked =  $patient['ac2'] == 1 ? 'checked' : '';
               $ac3_checked =  $patient['ac3'] == 1 ? 'checked' : '';
               $delivery_checked =  $patient['delivery'] == 1 ? 'checked' : '';


               echo "
               <tr>
               <th scope='row'>$i</th>
               <td>" . $patient['name'] . "</td>
               <td>" . $patient['mobile'] . "</td>
               <td>" . $patient['aasha'] . "</td>
               <td>" . $patient['lmp'] . "</td>
               <td><input type='checkbox' class='checkup' name='ac0_".$i."' value='1' disabled checked data-id=".$patient['id']." data-field='ac0'/></td>
               <td><input type='checkbox' class='checkup' name='ac1_".$i."' value='1' $ac1_checked data-id=".$patient['id']." data-field='ac1'/></td>
               <td><input type='checkbox' class='checkup' name='ac2_".$i."' value='1' $ac2_checked data-id=".$patient['id']." data-field='ac2' /></td>
               <td><input type='checkbox' class='checkup' name='ac3_".$i."' value='1' $ac3_checked data-id=".$patient['id']." data-field='ac3' /></td>
               <td><input type='checkbox' class='checkup' name='delivery".$i."' value='1' $delivery_checked data-id=".$patient['id']." value='1'  data-field='delivery' /></td>
               <td class='view-single-btn bi bi-pencil-square'><svg xmlns='http://www.w3.org/2000/svg' class='view-single-btn bi bi-pencil-square' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'  data-id='".$patient['id']."' viewBox='0 0 24 24' data-bs-toggle='modal' data-bs-target='#viewSinglePatient' aria-current='page'>
               <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
               <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
             </svg></td>
               
               </tr>";
               $i++;
            } ?>
      </tbody>
      </table>
      </div>
      <!-- Model for Add Patients -->
      <div class="modal fade" id="addPatient" tabindex="-1" aria-labelledby="addPatientLabel" aria-hidden="true">
         <div class="modal-dialog">
            <form method="POST" action="#" >
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="addPatientLabel">Add Patient Data</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="mb-3">
                        <label for="name" id="name-label" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                     </div>
                     <div class="mb-3">
                        <label for="husband_name" id="husband_name-label" class="form-label">Husband Name</label>
                        <input type="text" class="form-control" name="husband_name" id="husband_name" required>
                     </div>
                     <div class="mb-3">
                        <label for="aadhar" id="aadhar-label" class="form-label">Aadhar Number</label>
                        <input type="number" class="form-control" name="aadhar" id="aadhar" required>
                        <small id="aadharError" style="display: none" class="form-text text-danger">Please Enter 12 Digit valid aadhar number.</small>

                     </div>
                     <div class="mb-3">
                        <label for="mobile" id="mobile-label" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" name="mobile" id="mobile" required>
                        <small id="mobileError" style="display: none" class="form-text text-danger">Please Enter 10 Digit valid mobile number.</small>
                     </div>
                     <div class=" mb-3">
                        <label for="address" id="address-label" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" required>
                     </div>
                     <div class="mb-3">
                        <label for="village" id="village-label" class="form-label">Village Name</label>
                        <select class="form-control form-select" name="village" id="village" required>
                           <option value="-1" selected disabled>Choose village</option>
                           <?php for ($i = 0; $i < count($village_list); $i++) {
                              echo "<option value=\"$village_list[$i]\">$village_list[$i]</option>";
                           }
                           ?>
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="SCH" id="block-label" class="form-label">SHC Name</label>
                        <input type="text" disabled value="<?= $SHC ?>" class="form-control" name="SHC" id="SHC" required>
                     </div>
                     <div class="mb-3">
                        <label for="block" id="block-label" class="form-label">Block Name</label>
                        <input type="text" disabled value="<?= $block_name ?>" class="form-control" name="block" id="block" required>
                     </div>
                     <div class="mb-3">
                        <label for="city" id="city-label" class="form-label">City</label>
                        <input type="text" disabled value="<?= $city_name; ?>" class="form-control" name="city" id="city" required>
                     </div>
                     <div class="mb-3">
                        <label for="aasha" id="aasha-label" class="form-label">Aasha</label>
                        <input type="text" readonly class="form-control" name="aasha" id="aasha">
                     </div>
                     <div class="mb-3">
                        <label for="lmp" id="lmp-label" class="form-label">LMP</label>
                        <input type="date" class="form-control" id="lmp" name="lmp" required>
                     </div>
                     <div class="mb-3">
                       <b> <label for="reasons" class="form-label">Complication in Previous Pregnancy</label></b><hr>
                        <input class="form-check-input" type="checkbox" value="1" name="APH" id="aph">
                        <label class="form-check-label" for="aph">
                           a) APH
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="eclampsia" id="Eclampsia">
                        <label class="form-check-label" for="Eclampsia">
                           b) Eclampsia
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="PIH" id="PIH">
                        <label class="form-check-label" for="PIH">
                           c) PIH
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="anaemia" id="Anaemia">
                        <label class="form-check-label" for="Anaemia">
                           d) Anaemia
                        </label><br>
                        <input class="form-check-input" type="checkbox" value="1" name="obstructed_labor" id="Obstructed_Labor">
                        <label class="form-check-label" for="Obstructed_Labor">
                           e) Obstructed Labor
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="PPH" id="PPH">
                        <label class="form-check-label" for="PPH">
                           f) PPH
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="LSCS" id="LSCS">
                        <label class="form-check-label" for="LSCS">
                           g) LSCS
                        </label><br>
                        <input class="form-check-input" type="checkbox" value="1" name="congenital_anamaly" id="Congenital_Anamaly">
                        <label class="form-check-label" for="Congenital_Anamaly">
                           h) Congenital Anamaly
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="abortion" id="Abortion">
                        <label class="form-check-label" for="Abortion">
                           i) Abortion
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="others_1" id="Others">
                        <label class="form-check-label" for="Others">
                           j) Others
                        </label>
                        <br>
                        <b><label class="form-label mt-2">Past History</label></b><hr>
                        <input class="form-check-input" type="checkbox" value="1" name="tuberculosis" id="Tuberculosis">
                        <label class="form-check-label" for="Tuberculosis">
                           a) Tuberculosis
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="hypertension" id="Hypertension">
                        <label class="form-check-label" for="Hypertension">
                           b) Hypertension
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="heart_disease" id="Heart_Disease">
                        <label class="form-check-label" for="Heart_Disease">
                           c) Heart Disease
                        </label><br>
                        <input class="form-check-input" type="checkbox" value="1" name="diabetes" id="Diabetes">
                        <label class="form-check-label" for="Diabetes">
                           d) Diabetes
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="asthma" id="Asthma">
                        <label class="form-check-label" for="Asthma">
                           e) Asthma
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="other_2" id="Other">
                        <label class="form-check-label" for="Other">
                           f) Other
                        </label>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" name="add_patient" id="add_patient" class=" btn btn-primary">Add Patient</button>
                  </div>
            </form>
         </div>
      </div>
   </div>

   <!--start  Model for edit Patient -->
   <div class="modal fade" id="editPatient" tabindex="-1" aria-labelledby="editPatientLabel" aria-hidden="true">
         <div class="modal-dialog">
            <form method="POST" action="#" >
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="editPatientLabel">Edit Patient Data</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="mb-3">
                        <label for="name" id="name-label" class="form-label">Name</label>
                        <input type="text" class="form-control" name="e-name" id="e-name" required>
                        <input type="hidden" class="form-control" name="uid" id="uid" required>
                     </div>
                     <div class="mb-3">
                        <label for="husband_name" id="husband_name-label" class="form-label">Husband Name</label>
                        <input type="text" class="form-control" name="e-husband_name" id="e-husband_name" required>
                     </div>
                     <div class="mb-3">
                        <label for="aadhar" id="aadhar-label" class="form-label">Aadhar Number</label>
                        <input type="number" class="form-control" name="e-aadhar" id="e-aadhar" required>
                        <small id="e-aadharError" class="form-text text-danger">Please Enter 12 Digit valid aadhar number.</small>
                     </div>
                     <div class="mb-3">
                        <label for="mobile" id="mobile-label" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" name="e-mobile" id="e-mobile" required>
                        <small id="e-mobileError" class="form-text text-danger">Please Enter 10 Digit valid mobile number.</small>
                     </div>
                     <div class=" mb-3">
                        <label for="address" id="address-label" class="form-label">Address</label>
                        <input type="text" class="form-control" name="e-address" id="e-address" required>
                     </div>
                     <div class="mb-3">
                        <label for="village" id="village-label" class="form-label">Village Name</label>
                        <select class="form-control form-select" name="e-village" id="e-village" required>
                           <option value="-1" selected disabled>Choose village</option>
                           <?php for ($i = 0; $i < count($village_list); $i++) {
                              echo "<option value=\"$village_list[$i]\">$village_list[$i]</option>";
                           }
                           ?>
                        </select>
                     </div>
                     <div class="mb-3">
                        <label for="SCH" id="block-label" class="form-label">SHC Name</label>
                        <input type="text" disabled value="<?= $SHC ?>" class="form-control" name="e-SHC" id="e-SHC" required>
                     </div>
                     <div class="mb-3">
                        <label for="block" id="block-label" class="form-label">Block Name</label>
                        <input type="text" disabled value="<?= $block_name ?>" class="form-control" name="e-block" id="e-block" required>
                     </div>
                     <div class="mb-3">
                        <label for="city" id="city-label" class="form-label">City</label>
                        <input type="text" disabled value="<?= $city_name; ?>" class="form-control" name="e-city" id="e-city" required>
                     </div>
                     <div class="mb-3">
                        <label for="aasha" id="aasha-label" class="form-label">Aasha</label>
                        <input type="text" readonly class="form-control"  name="e-aasha" id="e-aasha">
                     </div>
                     <div class="mb-3">
                        <label for="lmp" id="lmp-label" class="form-label">LMP</label>
                        <input type="date" class="form-control" id="e-lmp" name="e-lmp" required>
                     </div>
                     <div class="mb-3"><b>
                        <label for="reasons" class="form-label">Complication in Previous Pregnancy</label></b><hr>
                        <input class="form-check-input" type="checkbox" value="1" name="e-APH" id="e-aph">
                        <label class="form-check-label" for="e-aph">
                           a) APH
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-eclampsia" id="e-Eclampsia">
                        <label class="form-check-label" for="e-Eclampsia">
                           b) Eclampsia
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-PIH" id="e-PIH">
                        <label class="form-check-label" for="e-PIH">
                           c) PIH
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-anaemia" id="e-Anaemia">
                        <label class="form-check-label" for="e-Anaemia">
                           d) Anaemia
                        </label><br>
                        <input class="form-check-input" type="checkbox" value="1" name="e-obstructed_labor" id="e-Obstructed_Labor">
                        <label class="form-check-label" for="e-Obstructed_Labor">
                           e) Obstructed Labor
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-PPH" id="e-PPH">
                        <label class="form-check-label" for="e-PPH">
                           f) PPH
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-LSCS" id="e-LSCS">
                        <label class="form-check-label" for="e-LSCS">
                           g) LSCS
                        </label><br>
                        <input class="form-check-input" type="checkbox" value="1" name="e-congenital_anamaly" id="e-Congenital_Anamaly">
                        <label class="form-check-label" for="e-Congenital_Anamaly">
                           h) Congenital Anamaly
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-abortion" id="e-Abortion">
                        <label class="form-check-label" for="e-Abortion">
                           i) Abortion
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-others_1" id="e-Others">
                        <label class="form-check-label" for="e-Others">
                           j) Others
                        </label>
                        <br>
                        <b><label class="form-label">Past History</label></b><hr>
                        <input class="form-check-input" type="checkbox" value="1" name="e-tuberculosis" id="e-Tuberculosis">
                        <label class="form-check-label" for="e-Tuberculosis">
                           a) Tuberculosis
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-hypertension" id="e-Hypertension">
                        <label class="form-check-label" for="e-Hypertension">
                           b) Hypertension
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-heart_disease" id="e-Heart_Disease">
                        <label class="form-check-label" for="e-Heart_Disease">
                           c) Heart Disease
                        </label><br>
                        <input class="form-check-input" type="checkbox" value="1" name="e-diabetes" id="e-Diabetes">
                        <label class="form-check-label" for="e-Diabetes">
                           d) Diabetes
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-asthma" id="e-Asthma">
                        <label class="form-check-label" for="e-Asthma">
                           e) Asthma
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="e-other_2" id="e-Other">
                        <label class="form-check-label" for="e-Other">
                           f) Other
                        </label>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" name="edit_patient" id="edit_patient" class=" btn btn-primary">Edit Patient</button>
                  </div>
            </form>
         </div>
      </div>
   <!-- end Model for edit Patient -->

</div>

  <!--start  Model for view Single Patient -->
<div class="modal fade" id="viewSinglePatient" tabindex="-1" aria-labelledby="viewSinglePatientLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="viewSinglePatientLabel">View Patient Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="name" class="form-label">Name</label>
                     <input type="text" readonly class="form-control" name="v-name" id="v-name" required>
                  </div>
                  <div class="mb-3">
                     <label for="husband_name"  class="form-label">Husband Name</label>
                     <input type="text" readonly class="form-control" name="v-husband_name" id="v-husband_name" required>
                  </div>
                  <div class="mb-3">
                     <label for="aadhar" class="form-label">Aadhar Number</label>
                     <input type="number" readonly class="form-control" name="v-aadhar" id="v-aadhar" required>
                  </div>
                  <div class="mb-3">
                     <label for="mobile" class="form-label">Mobile Number</label>
                     <input type="number" readonly class="form-control" name="v-mobile" id="v-mobile" required>
                  </div>
                  <div class=" mb-3">
                     <label for="address"  class="form-label">Address</label>
                     <input type="text" readonly class="form-control" name="v-address" id="v-address" required>
                  </div>
                  <div class="mb-3">
                     <label for="village" class="form-label">Village Name</label>
                     <select disabled class="form-control" name="v-village" id="v-village" required>
                        <option value="-1" selected disabled>Choose village</option>
                        <?php for ($i = 0; $i < count($village_list); $i++) {
                           echo "<option value=\"$village_list[$i]\">$village_list[$i]</option>";
                        }
                        ?>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="SCH" class="form-label">SHC Name</label>
                     <input type="text" disabled value="<?= $SHC ?>" class="form-control" name="v-SHC" id="e-SHC" required>
                  </div>
                  <div class="mb-3">
                     <label for="block" class="form-label">Block Name</label>
                     <input type="text" disabled value="<?= $block_name ?>" class="form-control" name="e-block" id="v-block" required>
                  </div>
                  <div class="mb-3">
                     <label for="city" class="form-label">City</label>
                     <input type="text" disabled value="<?= $city_name; ?>" class="form-control" name="v-city" id="v-city" required>
                  </div>
                  <div class="mb-3">
                     <label for="aasha" class="form-label">Aasha</label>
                     <input type="text" readonly class="form-control"  name="v-aasha" id="v-aasha">
                  </div>
                  <div class="mb-3">
                     <label for="lmp" class="form-label">LMP</label>
                     <input type="date" readonly class="form-control" id="v-lmp" name="v-lmp" required>
                  </div>
                  <div class="mb-3"><b>
                     <label for="reasons" class="form-label">Complication in Previous Pregnancy</label></b><hr>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-APH" id="v-aph">
                     <label class="form-check-label" for="v-aph">
                        a) APH
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-eclampsia" id="v-Eclampsia">
                     <label class="form-check-label"  for="v-Eclampsia">
                        b) Eclampsia
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-PIH" id="v-PIH">
                     <label class="form-check-label" for="v-PIH">
                        c) PIH
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-anaemia" id="v-Anaemia">
                     <label class="form-check-label" for="v-Anaemia">
                        d) Anaemia
                     </label><br>
                     <input class="form-check-input"  disabled type="checkbox" value="1" name="v-obstructed_labor" id="v-Obstructed_Labor">
                     <label class="form-check-label" for="v-Obstructed_Labor">
                        e) Obstructed Labor
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-PPH" id="v-PPH">
                     <label class="form-check-label" for="v-PPH">
                        f) PPH
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-LSCS" id="v-LSCS">
                     <label class="form-check-label" for="v-LSCS">
                        g) LSCS
                     </label><br>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-congenital_anamaly" id="v-Congenital_Anamaly">
                     <label class="form-check-label" for="v-Congenital_Anamaly">
                        h) Congenital Anamaly
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-abortion" id="v-Abortion">
                     <label class="form-check-label" for="v-Abortion">
                        i) Abortion
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-others_1" id="v-Others">
                     <label class="form-check-label" for="v-Others">
                        j) Others
                     </label>
                     <br>
                     <b><label class="form-label">Past History</label></b><hr>
                     <input class="form-check-input"  disabled type="checkbox" value="1" name="v-tuberculosis" id="v-Tuberculosis">
                     <label class="form-check-label" for="v-Tuberculosis">
                        a) Tuberculosis
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-hypertension" id="v-Hypertension">
                     <label class="form-check-label" for="v-Hypertension">
                        b) Hypertension
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-heart_disease" id="v-Heart_Disease">
                     <label class="form-check-label" for="v-Heart_Disease">
                        c) Heart Disease
                     </label><br>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-diabetes" id="v-Diabetes">
                     <label class="form-check-label" for="v-Diabetes">
                        d) Diabetes
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-asthma" id="v-Asthma">
                     <label class="form-check-label" for="v-Asthma">
                        e) Asthma
                     </label>
                     <input class="form-check-input" disabled type="checkbox" value="1" name="v-other_2" id="v-Other">
                     <label class="form-check-label" for="v-Other">
                        f) Other
                     </label>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button id="editPatientBtn" class='btn btn-primary edit-btn' data-id='' data-bs-toggle='modal' data-bs-target='#editPatient' aria-current='page'>Edit Patient</button>
               </div>
      </div>
   <!-- end Model for View Single Patient -->
   </div>
   
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<script>
   $(document).ready( function () {
      $.noConflict();
    $('#view_patient_table').dataTable();
   });
   
   const apiUrl="<?=$apiUrl?>";
   $('#village').on('change', async () => {
      const village = $('#village').find(":selected").text();
      const resp = await fetch(`${apiUrl}?village=${village}`);
      const resp_json = await resp.json();
      console.log(resp_json);
      if (resp_json.status === 200) {
         $('#aasha').val(resp_json.name);
      } else {
         $('#aasha').val('');
      }
   });
   $('#e-aadhar').on('input',  () => {
      if($('#e-aadhar').val().length !== 12){
         $('#e-aadharError').show();
         $('#edit_patient').prop('disabled', true);
      }
      else{
         $('#e-aadharError').hide();
         $('#edit_patient').prop('disabled', false);
      }
   });
   
   $('#e-mobile').on('input',  () => {
      if($('#e-mobile').val().length !== 10){
         $('#e-mobileError').show();
         $('#edit_patient').prop('disabled', true);
      }
      else{
         $('#e-mobileError').hide();
         $('#edit_patient').prop('disabled', false);
      }
   });
   $('#aadhar').on('input',  () => {
      if($('#aadhar').val().length !== 12){
         $('#aadharError').show();
         $('#add_patient').prop('disabled', true);
      }
      else{
         $('#aadharError').hide();
         $('#add_patient').prop('disabled', false);
      }
   });
   
   $('#mobile').on('input',  () => {
      if($('#mobile').val().length !== 10){
         $('#mobileError').show();
         $('#add_patient').prop('disabled', true);
      }
      else{
         $('#mobileError').hide();
         $('#add_patient').prop('disabled', false);
      }
   });

   $('#e-village').on('change', async () => {
      const village = $('#e-village').find(":selected").text();
      const resp = await fetch(`${apiUrl}?village=${village}`);
      const resp_json = await resp.json();
      console.log(resp_json);
      if (resp_json.status === 200) {
         $('#e-aasha').val(resp_json.name);
      } else {
         $('#e-aasha').val('');
      }
   });
   
   $( "body" ).on( "click", ".edit-btn", function() {
      let id=$('#editPatientBtn').attr('data-id');
      console.log(id);
      $.ajax({ 
         url:apiUrl+`?id=${id}`,
         type: "GET",
         success : function(res){
            const data=JSON.parse(res).data;
            console.log(data);
            $('#e-name').val(data.name);
            $('#e-husband_name').val(data.husband_name);
            $('#e-aadhar').val(data.aadhar);
            $('#e-mobile').val(data.mobile);
            $('#e-address').val(data.address);
            $('#e-village').val(data.village);
            $('#e-lmp').val(data.lmp);
            $('#uid').val(data.id);
            $('#e-aasha').val(data.aasha);
            
            data.APH == 1 ? $('#e-aph').attr('checked', 'checked') :  $('#e-APH').prop('checked', false);
            data.eclampsia == 1 ? $('#e-Eclampsia').attr('checked', 'checked') :  $('#e-Eclampsia').prop('checked', false);
            data.PIH == 1 ? $('#e-PIH').attr('checked', 'checked') :  $('#e-PIH').prop('checked', false);
            data.anaemia == 1 ? $('#e-Anaemia').attr('checked', 'checked') :  $('#e-Anaemia').prop('checked', false);
            data.obstructed_labor == 1 ? $('#e-Obstructed_Labor').attr('checked', 'checked') :  $('#e-Obstructed_Labor').prop('checked', false);
            data.PPH == 1 ? $('#e-PPH').attr('checked', 'checked') :  $('#e-PPH').prop('checked', false);
            data.LSCS == 1 ? $('#e-LSCS').attr('checked', 'checked') :  $('#e-LSCS').prop('checked', false);
            data.congenital_anamaly == 1 ? $('#e-Congenital_Anamaly').attr('checked', 'checked') :  $('#e-Congenital_Anamaly').prop('checked', false);
            data.abortion == 1 ? $('#e-Abortion').attr('checked', 'checked') :  $('#e-Abortion').prop('checked', false);
            data.others_1 == 1 ? $('#e-Others').attr('checked', 'checked') :  $('#e-Others').prop('checked', false);
            data.tuberculosis == 1 ? $('#e-Tuberculosis').attr('checked', 'checked') :  $('#e-Tuberculosis').prop('checked', false);
            data.hypertension == 1 ? $('#e-Hypertension').attr('checked', 'checked') :  $('#e-Hypertension').prop('checked', false);
            data.heart_disease == 1 ? $('#e-Heart_Disease').attr('checked', 'checked') :  $('#e-Heart_Disease').prop('checked', false);
            data.diabetes == 1 ? $('#e-Diabetes').attr('checked', 'checked') :  $('#e-Diabetes').prop('checked', false);
            data.asthma == 1 ? $('#e-Asthma').attr('checked', 'checked') :  $('#e-Asthma').prop('checked', false);
            data.other_2 == 1 ? $('#e-Other').attr('checked', 'checked') :  $('#e-Other').prop('checked', false);


         }
      });

   });
   $( "body" ).on( "click", ".view-single-btn", function() {
      const id=$(this).attr('data-id');
      $('#editPatientBtn').attr('data-id',id); 

      $.ajax({ 
         url:apiUrl+`?id=${id}`,
         type: "GET",
         success : function(res){
            const data=JSON.parse(res).data;
            $('#v-name').val(data.name);
            $('#v-husband_name').val(data.husband_name);
            $('#v-aadhar').val(data.aadhar);
            $('#v-mobile').val(data.mobile);
            $('#v-address').val(data.address);
            $('#v-village').val(data.village);
            $('#v-lmp').val(data.lmp);
            $('#v-aasha').val(data.aasha);
            
      
            data.APH == 1 ? $('#v-aph').attr('checked', 'checked') :  $('#v-APH').prop('checked', false);
            data.eclampsia == 1 ? $('#v-Eclampsia').attr('checked', 'checked') :  $('#v-Eclampsia').prop('checked', false);
            data.PIH == 1 ? $('#v-PIH').attr('checked', 'checked') :  $('#v-PIH').prop('checked', false);
            data.anaemia == 1 ? $('#v-Anaemia').attr('checked', 'checked') :  $('#v-Anaemia').prop('checked', false);
            data.obstructed_labor == 1 ? $('#v-Obstructed_Labor').attr('checked', 'checked') :  $('#v-Obstructed_Labor').prop('checked', false);
            data.PPH == 1 ? $('#v-PPH').attr('checked', 'checked') :  $('#v-PPH').prop('checked', false);
            data.LSCS == 1 ? $('#v-LSCS').attr('checked', 'checked') :  $('#v-LSCS').prop('checked', false);
            data.congenital_anamaly == 1 ? $('#v-Congenital_Anamaly').attr('checked', 'checked') :  $('#v-Congenital_Anamaly').prop('checked', false);
            data.abortion == 1 ? $('#v-Abortion').attr('checked', 'checked') :  $('#v-Abortion').prop('checked', false);
            data.others_1 == 1 ? $('#v-Others').attr('checked', 'checked') :  $('#v-Others').prop('checked', false);
            data.tuberculosis == 1 ? $('#v-Tuberculosis').attr('checked', 'checked') :  $('#v-Tuberculosis').prop('checked', false);
            data.hypertension == 1 ? $('#v-Hypertension').attr('checked', 'checked') :  $('#v-Hypertension').prop('checked', false);
            data.heart_disease == 1 ? $('#v-Heart_Disease').attr('checked', 'checked') :  $('#v-Heart_Disease').prop('checked', false);
            data.diabetes == 1 ? $('#v-Diabetes').attr('checked', 'checked') :  $('#v-Diabetes').prop('checked', false);
            data.asthma == 1 ? $('#v-Asthma').attr('checked', 'checked') :  $('#v-Asthma').prop('checked', false);
            data.other_2 == 1 ? $('#v-Other').attr('checked', 'checked') :  $('#v-Other').prop('checked', false);



         }
      });

   });
   $( "body" ).on( "click", "#export_data", function() {
      var from=$('#from').val();
      var to=$('#to').val();
      if(!to || !from){
         $('#export_error').show();
         setTimeout(5000,()=>{
            $('#export_error').hide();
         });
         return false;
      }
      else{
         window.open(`export.php?from=${from}&to=${to}`,'_blank');
      }
   });
   $( "body" ).on( "click", ".checkup", function() {
      const id = $(this).attr('data-id'); 
      const field = $(this).attr('data-field');
      const value=$(this).is(":checked") ? 1 :0;
      console.log(id,field,value);
      const formData ={id,field,value};
      $.ajax({ 
         url:apiUrl,
         type: "POST",
         data:formData,
         success : function(res){
            console.log(res);
         }
      });
   });

   // for preventing relsubmissions of from
   if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
include '../resources/sections/footer.php';
?>