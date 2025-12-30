<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ("PHPMailer/PHPMailer.php");
require ("PHPMailer/SMTP.php");
require ("PHPMailer/Exception.php");
include 'dbConfig.php';
$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
	$online = 'online';
 	unset($_SESSION['is_logged_in']);
if (isset($_POST['value_1'])) {
	$value_1 = $_POST['value_1'];
	$value_2 = $_POST['value_2'];
	$value_3 = $_POST['value_3'];
    $value_4 = $_POST['token'];
    $value_0 = $_POST['value_0'];
 //post
 //functions
	   
	   if(empty($value_1)){
	   $_SESSION['inc'] = "<script>swal('Error', 'Username Is Empty', 'warning');</script>";
	   }else if(empty($value_2)){
	   $_SESSION['inc'] = "<script>swal('Error', 'Password Is Empty', 'warning');</script>";
	   }else if(empty($value_3)){
	   $_SESSION['inc'] = "<script>swal('Error', 'Confirm Password Is Empty', 'warning');</script>";
	   }else if(empty($value_4)){
	   $_SESSION['inc'] = "<script>swal('Error', 'Token Is Empty', 'warning');</script>";
	   }else if(empty($value_0)){
	   $_SESSION['inc'] = "<script>swal('Error', 'Email Is Empty', 'warning');</script>";
	   }else{
	   //function
	   if ($value_2 == $value_3){
	   $value_pass = $value_3;
	   $check_email_ = mysqli_query($con, "SELECT * FROM panel WHERE email = '".$value_0."'");
	$check_email = mysqli_num_rows($check_email_);
	      $check_token_ = mysqli_query($con, "SELECT * FROM panel WHERE _token = '".$value_4."'");
	$check_username = mysqli_num_rows($check_token_);
	$check_username_ = mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$value_1."'");
	$check_username = mysqli_num_rows($check_username_);
	if ($check_token == 0) {
	if ($check_email == 0) {
	if ($check_username == 0) {
	date_default_timezone_set('Asia/Dhaka');
	$curr_date = date("Y/m/d h:i:s");
	$value_exp = date('Y-m-d h:i:s', strtotime('+7 day'));
	$verified = 'verified';
	$active = 'active';
	$member = 'member';
	$free = 'free';
	$unpaid = 'unpaid';
	$zero = '0';
	$five = '5';
	$NULL = NULL;
	$verifycode = bin2hex(random_bytes(32));
	   $fetch = mysqli_query($con, "INSERT INTO `panel` (`_username`, `_password`, `_token`, `_v_status`, `_status`, `_reg_date`, `_exp_date`, `_curr_time`, `_uid`, `_user_type`, `_registrar`, `_version`, `_p_status`, `_credits`, `_resets`, `_r_resets`, `email`, `verification_code`, `is_verified`, `paid`, `by`) VALUES ('$value_1', '$value_2', '$value_4', 'verified', 'active', '$curr_date', '$value_exp', '$curr_date', NULL, 'member', 'BlueTriple4', 'injector', 'unpaid', '0', '0', '5', '$value_0', '$verifycode', '0', 'free', 'web');");
	   try {
		$mail = new PHPMailer(true);

		// SMTP configuration
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'bluetriple4.ultra@gmail.com'; // Enter your Gmail address
		$mail->Password = 'tbqsfuhowgpqqtva'; // Enter your Gmail password
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		// Sender and recipient settings
		$mail->setFrom('bluetriple4.ultra@gmail.com', 'Blue Triple 4'); // Enter your name and email address
		$mail->addAddress($value_0, $value_1); // Send the email to
		// Email content
		$mail->isHTML(true);
		$mail->Subject = 'Email Verification';
		$mail->Body = 'Thank you for registering! Please click the following link to verify your email address:<br><br><a href="http://localhost:8004/Server%20Reedit/verify.php?v_code=' . $verifycode . '">Verify Email</a>';

		$mail->send();

		 $_SESSION['inc']= '<div class="alert alert-success" role="alert">Registration Success, Please Verify Your Email</div>';
       header("refresh:3;url=login.php");
		} catch (Exception $e) {
		// Display error message
		$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Registration Failed</div>';
	  }
	   } else {
	   $_SESSION['inc']= '<div class="alert alert-danger" role="alert">Username Already Exists</div>';
	   }
	   } else {
	   $_SESSION['inc']= '<div class="alert alert-danger" role="alert">Email Already Exists</div>';
	   }
	      } else {
	   $_SESSION['inc']= '<div class="alert alert-danger" role="alert">Token Already Exists</div>';
	   }
	   } else {
	   $_SESSION['inc']= '<div class="alert alert-danger" role="alert">Password Mismatch</div>';
	 

	 
	   }
       //function end	   
	   }
}	     


?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register | <?php echo ''.$server_data['server_name'].'';?></title>

    <meta name="description" content="" />

    <?php include('./css-in-2.php'); ?>
    

  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
        
        <?php if (!empty($_SESSION['inc'])) { ?>
        <?php echo $_SESSION['inc'];
        unset($_SESSION['inc']);?>
        <?php } ?>
          <!-- Login -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4 mt-2">

                  <span class="app-brand-text demo text-body fw-bold ms-1"><?php echo ''.$server_data['server_name'].'';?></span>
               
              </div>
              <!-- /Logo -->

              <form class="dt_adv_search" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="value_1"
                    placeholder="Enter A Username"
                    autofocus required />
                </div>
                <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Token</label>
                      <div class="input-group">
                      
                        <input
                          id="token" 
                          name="token" 
                          type="text"
                          class="form-control"
                          placeholder="Generate A Token"
                          aria-label="Generate A Token"
                          aria-describedby="button-addon2" required />
                        <button class="btn btn-outline-primary" onclick="getToken()" type="button" id="button-addon2">Generate</button>
                      </div>
                    </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    name="value_0" 
                    id="email"
                    placeholder="Enter A Email"
                    autofocus required />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      name="value_2"
                      class="form-control"
                      name="password"
                      placeholder="Enter A Password"
                      aria-describedby="password" required />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Confirm Password</label>
                    
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="value_3"
                      placeholder="Enter Confirm Password"
                      aria-describedby="password" required />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> I accept Terms And condition. </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit" name="Submit">Register</button>
                </div>
              </form>

              <p class="text-center">
                <span>Already a member?</span>
                <a href="login.php">
                  <span>Login</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <?php include('./js.php'); ?>
  </body>
</html>
