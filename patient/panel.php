<?php
   include '../resources/core/config.php';
   session_start();
   $patient_data = $_SESSION["patient_data"];
   $name = $patient_data["name"];
   $lmp = $patient_data['lmp'];
   $date1 = date('Y-m-d', strtotime("$lmp + 84 day"));
   $date2 = date('Y-m-d', strtotime("$lmp + 126 day"));
   $date3 = date('Y-m-d', strtotime("$lmp + 168 day"));
   $date4 = date('Y-m-d', strtotime("$lmp + 238 day"));
   $aasha = $patient_data["aasha"];
   ?>
<?php
   include '../resources/sections/head.php';
   ?>
<title>Patient Panel | Kilkari Abhiyan</title>
<meta name="description" content= in page for ANM and pati
<meta property="og:title" content="Patient Panel | Kilkari Abhiyan">
<meta property="og:description" content="View your scheduled check up details.">
<meta name="twitter:title" content="Patient Panel | Kilkari Abhiyan">
<meta name="twitter:description" content="View your scheduled check up details.">
<meta property="og:url" content="https://kilkarirewa.in/patient">
<link rel="canonical" href="https://kilkarirewa.in/patient/">
<?php
   include '../resources/sections/header.php';
   ?>
<div class="title">
   <div class="container">
      <div class="row">
         <h2 class="text-center">Patient पैनल</h2>
      </div>
   </div>
</div>
<?php
   include '../resources/sections/patient_menu.php';
   ?>
<section>
   <div class="container">
      <h3 class="text-center">Checkup Schedule</h3>
      <hr>
      <div class="row">
         <div class="col-sm-6">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">First Checkup</h5>
                  <p class="card-text">Within 12 Weeks - <?= $lmp ?> to <?= $date1 ?></p>
                  <a href="#" class="btn btn-success">SMS Alert Done</a> <a href="#" class="btn btn-success">Checkup Visit Done</a>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Second Checkup</h5>
                  <p class="card-text">Between 18 to 24 Weeks - <?= $date2 ?> to <?= $date3 ?></p>
                  <a href="#" class="btn btn-danger">SMS Alert Pending</a> <a href="#" class="btn btn-danger">Checkup Visit Pending</a>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Third Checkup</h5>
                  <p class="card-text">Between 24 to 34 Weeks - <?= $date3 ?> to <?= $date4 ?></p>
                  <a href="#" class="btn btn-danger">SMS Alert Pending</a> <a href="#" class="btn btn-danger">Checkup Visit Pending</a>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Fourth Checkup</h5>
                  <p class="card-text">Between 34 to Delivery Date - <?= $date4 ?> to Delivery Date</p>
                  <a href="#" class="btn btn-danger">SMS Alert Pending</a> <a href="#" class="btn btn-danger">Checkup Visit Pending</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php
   include '../resources/sections/footer.php';
   ?>