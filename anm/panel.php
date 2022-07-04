<?php
session_start();
$successful = false;
$failed = false;
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
.checkbox,.edit-btn {
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
<section>
   <div class="container">
      <?php
      if ($successful)
         echo '<div class="alert alert-success" role="alert"><h6 class="text-success text-center">नया Patient जोड़ा गया</h6></div>';
      if ($failed)
         echo '<div class="alert alert-danger" role="alert"><h6 class="text-danger text-center">Patient जोड़ने में असमर्थ</h6></div>';
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
               <td><input type='checkbox' class='checkup' name='ac1_".$i."' value='1' $ac1_checked data-id=".$patient['id']." data-field='ac1'/></td>
               <td><input type='checkbox' class='checkup' name='ac2_".$i."' value='1' $ac2_checked data-id=".$patient['id']." data-field='ac2' /></td>
               <td><input type='checkbox' class='checkup' name='ac3_".$i."' value='1' $ac3_checked data-id=".$patient['id']." data-field='ac3' /></td>
               <td><input type='checkbox' class='checkup' name='delivery".$i."' value='1' $delivery_checked data-id=".$patient['id']." value='1'  data-field='delivery' /></td>
               <td><svg  xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-pencil-square edit-btn' data-id='".$patient['id']."' viewBox='0 0 24 24' data-bs-toggle='modal' data-bs-target='#editPatient' aria-current='page'>
               <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
               <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
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
                     </div>
                     <div class="mb-3">
                        <label for="mobile" id="mobile-label" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" name="mobile" id="mobile" required>
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
                        <label for="reasons" class="form-label">Complication in Previous Pregnancy</label><br>
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
                        </label>
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
                        </label>
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
                        <label class="form-label">Past History</label><br>
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
                        </label>
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
                     <button type="submit" name="add_patient" class=" btn btn-primary">Add Patient</button>
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
                     </div>
                     <div class="mb-3">
                        <label for="husband_name" id="husband_name-label" class="form-label">Husband Name</label>
                        <input type="text" class="form-control" name="e-husband_name" id="e-husband_name" required>
                     </div>
                     <div class="mb-3">
                        <label for="aadhar" id="aadhar-label" class="form-label">Aadhar Number</label>
                        <input type="number" class="form-control" name="e-aadhar" id="e-aadhar" required>
                     </div>
                     <div class="mb-3">
                        <label for="mobile" id="mobile-label" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" name="e-mobile" id="e-mobile" required>
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
                        <input type="text" readonly class="form-control" name="e-aasha" id="e-aasha">
                     </div>
                     <div class="mb-3">
                        <label for="lmp" id="lmp-label" class="form-label">LMP</label>
                        <input type="date" class="form-control" id="e-lmp" name="e-lmp" required>
                     </div>
                     <div class="mb-3">
                        <label for="reasons" class="form-label">Complication in Previous Pregnancy</label><br>
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
                        </label>
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
                        </label>
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
                        <label class="form-label">Past History</label><br>
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
                        </label>
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
                     <button type="submit" name="edit_patient" class=" btn btn-primary">Edit Patient</button>
                  </div>
            </form>
         </div>
      </div>
   <!-- end Model for edit Patient -->

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
   
   $( "body" ).on( "click", ".edit-btn", function() {
      let id=$(this).attr('data-id');
      
      $.ajax({ 
         url:apiUrl+`?id=${id}`,
         type: "GET",
         success : function(res){
            const data=JSON.parse(res).data;
            $('#e-name').val(data.name);
            $('#e-husband_name').val(data.husband_name);
            $('#e-aadhar').val(data.aadhar);
            $('#e-mobile').val(data.mobile);
            $('#e-address').val(data.address);
            $('#e-village').val(data.village);
            $('#e-lmp').val(data.lmp);
            
            data.APH == 1 ? $('#e-APH').prop('checked', true):  $('#e-APH').prop('checked', false);



         }
      });

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