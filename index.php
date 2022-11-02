<?php
require('resources/functions/config.php');
session_start();
$wrong_password = false;
$wrong_username = false;

if (isset($_SESSION['login'])) {

   if ($_SESSION['type'] == 'anm') {
      header('Location:anm/panel.php');
      exit;
   } else if ($_SESSION['type'] == 'admin') {
      header('Location:admin/panel.php');
      exit;
   }
    else if ($_SESSION['type'] == 'patient') {
      header('Location:patient/panel.php');
      exit;
   }
}
if (isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   if ($_POST['login_type'] == 'anm') {
      $login_q = "SELECT * FROM anm WHERE email='$username' ";
      $lq = mysqli_query($conn, $login_q);
      $login_data = mysqli_fetch_assoc($lq);
      if (!$login_data) {
         $wrong_username = true;
      } else {
         if ($login_data['password'] == $password) {
               $_SESSION['login'] = '1';
               $_SESSION['type'] = 'anm';
               $_SESSION['anm_data'] = $login_data;

               header("Location:anm/panel.php");
         } else {
               $wrong_password = true;
         }
      }
   }
   if ($_POST['login_type'] == 'admin') {
      $login_q = "SELECT * FROM admin WHERE username='$username'  lIMIT 1";
      $lq = mysqli_query($conn, $login_q);
      $login_data = mysqli_fetch_assoc($lq);
      if (!$login_data)
         $wrong_username = true;

      else {
         if ($login_data['password'] == $password) {
            $_SESSION['login'] = '1';
            $_SESSION['type'] = 'admin';
            $_SESSION['admin_data'] = $login_data;

            header("Location:admin/panel.php");
         } else {
            $wrong_password = true;
         }
      }
   } else if ($_POST['login_type'] == 'patient') {

      $login_q = "SELECT * FROM patient WHERE aadhar='$username' ";
      $lq = mysqli_query($conn, $login_q);
      $login_data = mysqli_fetch_assoc($lq);
      if (!$login_data)
         $wrong_username = true;

      else {
         if ($login_data['mobile'] == $password) {
            $_SESSION['login'] = '1';
            $_SESSION['type'] = 'patient';
            $_SESSION['patient_data'] = $login_data;

            header("Location:patient/panel.php");
         } else {
            $wrong_password = true;
         }
      }
   }
}
?>
<?php
include 'resources/sections/head.php';
?>
<title>Login | Kilkari Abhiyan</title>
<meta name="description" content=in page for ANM and pati <meta property="og:title" content="Login | Kilkari Abhiyan">
<meta property="og:description" content="Sign in page for ANM and patients.">
<meta name="twitter:title" content="Login | Rewa Covid Beds">
<meta name="twitter:description" content="Sign in page for ANM and patients.">
<meta property="og:url" content="https://kilkarirewa.in/login">
<link rel="canonical" href="https://kilkarirewa.in/login/">
<?php
include 'resources/sections/header.php';
?>

<body>
   <div class="title">
      <div class="container">
         <div class="row">
            <h2 class="text-center">लॉगिन</h2>
         </div>
      </div>
   </div>
   <div class="login-area">
      <div class="login-form">
         <div class="container">
            <div class="row">
               <form action="" method="post">
                  <?php
                  if ($wrong_username)
                     echo '<div class="alert alert-danger" role="alert"><h6 class="text-danger text-center">उपयोगकर्ता नहीं मिला</h6></div>';
                  if ($wrong_password)
                     echo '<div class="alert alert-danger" role="alert"><h6 class="text-danger text-center">गलत पासवर्ड</h6></div>';
                  ?>
                  <div class="form-group">
                     <select name="login_type" id="login_type" class="form-control" required>
                        <option value="" disabled selected>यूजर का प्रकार चुने</option>
                        <option value="admin">Admin</option>
                        <option value="patient">Patient</option>
                        <option value="anm">ANM</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <input type="text" id="uname" name="username" class="form-control" placeholder="यूजरनेम" required="required">
                  </div>
                  <div class="form-group">
                     <input type="password" id="pass" name="password" class="form-control" placeholder="पॉसवर्ड" required="required">
                  </div>
                  <div class="form-group text-center">
                     <button type="submit" name="login" class="btn btn-secondary btn-block">लॉगिन करें</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <?php
   include 'resources/sections/footer.php';
   ?>