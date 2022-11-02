<?php
session_start();
if(!isset($_SESSION['type']) || $_SESSION['type'] !='admin') header('location:../index.php');
require('../resources/functions/helpers.php');
$all_patients_data = getAllDefaultPatient();
$all_blocks = getAllBlocks();
$_SESSION['all_searched_patients']=$all_patients_data;
$data_message="";




if (isset($_POST['block']) && isset($_POST['shc']) && isset($_POST['village']) && isset($_POST['from']) && isset($_POST['to']) ){
   $block = strtolower($_POST['block']);
   $shc = strtolower($_POST['shc']);
   $village = strtolower($_POST['village']);
   $start_date = strtolower($_POST['from']);
   $end_date = strtolower($_POST['to']);
   $data_message="Showing Data for Block: <b>$block</b>,SHC : <b>$shc</b>,Village :<b> $village </b> from <b>($start_date,$end_date)</b>";
   $all_patients_data = getAllPatientsDataAdmin($block,$shc,$village, $start_date, $end_date);
   $_SESSION['all_searched_patients'] = $all_patients_data;

}


?>
<?php
include '../resources/sections/head.php';
?>
<title>Admin Panel | Kilkari Abhiyan</title>
<meta name="description" content="page for ANM and patient"> <meta property="og:title" content="Patient Panel | Kilkari Abhiyan">
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
         <h2 class="text-center">Admin पैनल</h2>
      </div>
   </div>
</div>
<?php
include '../resources/sections/admin_menu.php';
?>
<div class="container">
   <form method="POST" id="search_data_form">
      <div class="row">
            <div class="col">
               <label for="to" class="form-label">Block</label>
               <select name="block" class="form-select" id="select_block">
                  <option value="-1" selected disabled>Select Block</option>
                  <?php 
                     for($i=0;$i<count($all_blocks);$i++){
                        echo "<option value=\"$all_blocks[$i] \">$all_blocks[$i] </option>";
                     }
                  ?>
               </select>
            </div>
            <div class="col">
               <label for="to" class="form-label">SHC</label>
               <select name="shc" class="form-select" id="select_SHC">
                  <option value="-1" selected disabled>Select SHC</option>
               </select>
            </div>
            <div class="col">
               <label for="to" class="form-label">Village</label>
               <select name="village" class="form-select" id="select_village">
                  <option value="-1" selected disabled>Select Village</option>
               </select>
            </div>
            <div class="col">
            <label for="from" class="form-label">From</label>
            <input type="date" name="from" id="from" class="form-control">
         </div>
         <div class="col">
            <label for="to" class="form-label">To</label>
            <input type="date" id="to" name="to" class="form-control">
         </div>
      </div>
      <div class="text-center"> 
         <label id="errorMessage" style="font-weight:bold;display:none;color:red;margin:15px" class="text-center" for=""><b>Please Select Dates</b></label>

      </div>
      <div class="text-center">
          <button type="button" name="search_data" id="search_data" class="btn btn-success btn-primary" style="user-select: auto;">Search</button>
            <a href="export_all.php" target="_blank"><button type="button" id="export_all_data" class="btn btn-primary btn-primary" style="user-select: auto;">Export All Data</button></a>
      </div>
      </div>
   </form>
</div>
<section>
   <div class="container">
      <h3 class="text-center">Patients List</h3><hr>
      <p class="text-center" style="font-size:18px;"><?php echo $data_message?></p><hr>
      <div class="text-end">
         <a href="export.php" target="_blank"><button type="button" class="btn btn-dark btn-primary" style="user-select: auto;">Export</button></a>
      </div>
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

               $lmp = date('d-m-Y', strtotime($patient['lmp']));
               $date1 = date('d-m-Y', strtotime("$lmp + 126 day"));
               $date2 = date('d-m-Y', strtotime("$lmp + 168 day"));
               $date3 = date('d-m-Y', strtotime("$lmp + 238 day"));
               //25 days before EDD.
               $date4 = date('d-m-Y', strtotime("$lmp + 9 month"));
               
               echo "
               <tr>
               <th scope='row'>$i</th>
               <td>" . $patient['name'] . "</td>
               <td>" . $patient['mobile'] . "</td>
               <td>" . $patient['aasha'] . "</td>
               <td>" . $lmp . "</td>
               <td><input type='checkbox' class='checkup' name='ac0_".$i."' value='1' disabled checked data-id=".$patient['id']." data-field='ac0'/>
               <label>$lmp</label>
               </td>
               <td><input type='checkbox' class='checkup' name='ac1_".$i."' value='1' disabled $ac1_checked data-id=".$patient['id']." data-field='ac1'/>
               <label>$date1</label>
               </td>
               <td><input type='checkbox' class='checkup' name='ac2_".$i."' value='1' disabled $ac2_checked data-id=".$patient['id']." data-field='ac2' />
               <label>$date2</label>
               </td>
               <td><input type='checkbox' class='checkup' name='ac3_".$i."' value='1' disabled $ac3_checked data-id=".$patient['id']." data-field='ac3' />
               <label>$date3</label>
               </td>
               <td><input type='checkbox' class='checkup' name='delivery".$i."' value='1' disabled $delivery_checked data-id=".$patient['id']." value='1'  data-field='delivery' />
               <label>$date4</label>
               </td>
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
   </div>


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
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="SCH" class="form-label">SHC Name</label>
                     <input type="text" disabled class="form-control" name="v-SHC" id="v-SHC" required>
                  </div>
                  <div class="mb-3">
                     <label for="block" class="form-label">Block Name</label>
                     <input type="text" disabled  class="form-control" name="V-block" id="v-block" required>
                  </div>
                  <div class="mb-3">
                     <label for="city" class="form-label">City</label>
                     <input type="text" disabled class="form-control" name="v-city" id="v-city" required>
                  </div>
                  <div class="mb-3">
                     <label for="v-aasha" class="form-label">Aasha</label>
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
               </div>
      </div>
   <!-- end Model for View Single Patient -->
   </div>
   
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>const adminApiUrl = "<?=$adminApiUrl?>";</script>
<script>const apiUrl = "<?=$apiUrl?>";</script>

<style>
   option {
         text-transform: uppercase !important;
      }
   </style>
<script src="../resources/scripts/admin_panel.js">
   </script>

<?php
include '../resources/sections/footer.php';
?>