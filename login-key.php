<?php
session_start();
include 'dbConfig.php';
if (!empty($_SESSION['is_logged_in'])){
$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));
if ($login_data['_user_type'] == "member"){
header("Location: user/");
} else if ($login_data['_user_type'] == "reseller"){
header("Location: reseller/");
} else if ($login_data['_user_type'] == "admin"){
header("Location: admin/");
} else if ($login_data['_user_type'] == "owner"){
header("Location: owner/");
}
} else 

if (!empty($_COOKIE['is_logged_in'])){

$login = $_COOKIE['is_logged_in'];

$_SESSION['is_logged_in'] = $login;

$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_COOKIE['is_logged_in']."'"));
if ($login_data['_user_type'] == "member"){
header("Location: user/");
} else if ($login_data['_user_type'] == "reseller"){
header("Location: reseller/");
} else if ($login_data['_user_type'] == "admin"){
header("Location: admin/");
} else if ($login_data['_user_type'] == "owner"){
header("Location: owner/");
}

} else {
$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
	$online = 'online';
 	unset($_SESSION['is_logged_in']);
if (isset($_POST['value_1'])) {
	$value_1 = $_POST['value_1'];
	   if(empty($value_1)){
	   $_SESSION['inc'] = "<script>swal('Error', 'Key Is Empty', 'warning');</script>";
	   }else{
	 $fetch = mysqli_query($con, "SELECT * FROM panel WHERE _token = '".$value_1."'");
	$check = mysqli_num_rows($fetch);
	if ($check == 1) {
	$data = mysqli_fetch_assoc($fetch);
	if ($data['is_verified'] == 1 ){
	if ($data['_v_status'] == "verified"){
	if ($data['_status'] == "active"){
	$username = $data['_username'];
	$_SESSION['is_logged_in'] = $username;
	setCookie('is_logged_in',$username,time()+(60*60*24));
		$update_ts = $server_data['total_sessions'] + 1;
	$update_query = mysqli_query($con, "UPDATE server SET total_sessions = $update_ts ");
		if ($data['_user_type'] == "reseller"){
			 $_SESSION['inc']= '<div class="alert alert-success" role="alert">Login Success. Please Wait</div>';
       header("refresh:3;url=reseller/index.php");
	  
		} else if ($data['_user_type'] == "admin"){
			 $_SESSION['inc']= '<div class="alert alert-success" role="alert">Login Success. Please Wait</div>';
       header("refresh:3;url=admin/index.php");
       
	        } else if ($data['_user_type'] == "member"){
			 $_SESSION['inc']= '<div class="alert alert-success" role="alert">Login Success. Please Wait</div>';
       header("refresh:3;url=user/index.php");
		} else if ($data['_user_type'] == "owner"){
			 $_SESSION['inc']= '<div class="alert alert-success" role="alert">Login Success. Please Wait</div>';
       header("refresh:3;url=owner/index.php");
	  
		} else {
			$_SESSION['acao'] = "You don't have permission to access this site";
			session_destroy();
		}
		} else {
  $_SESSION['inc']= '<div class="alert alert-warning" role="alert">Your Account Is Banned</div>';
    }
  }else{
  $_SESSION['inc']= '<div class="alert alert-warning" role="alert">Your Account Is not Verified Yet</div>';
  }
  }else{
  $_SESSION['inc']= '<div class="alert alert-warning" role="alert">Your Email Is Not Verified</div>';
  }
	}else{
		$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Entered Key Is Incorrect</div>';
	}
	}
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

    <title>Key Login | <?php echo ''.$server_data['server_name'].'';?></title>

    <meta name="description" content="" />

    <?php include('./css.php'); ?>
    

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
                  <label for="email" class="form-label">Key/Token</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="value_1"
                    placeholder="Enter Your Key/Token"
                    autofocus />
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>

              <p class="text-center">
                <span>Login Normally</span>
                <a href="login.php">
                  <span>Login</span>
                </a>
              </p>
              <p class="text-center">
                <span>Not yet a member?</span>
                <a href="register.php">
                  <span>Create an account</span>
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
