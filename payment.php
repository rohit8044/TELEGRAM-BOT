<?php
session_start();
include 'dbConfig.php';
if (empty($_SESSION['is_logged_in'])){
header("Location: login.php");
}
$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));
$notif = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM nt WHERE n = 'all'" ));
if ($login_data['_user_type'] != "admin" && $login_data['_user_type'] != "member" && $login_data['_user_type'] != "owner" && $login_data['_user_type'] != "reseller") {
	header("Location: login.php");
	exit();
}
$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
	
$ID = trim(isset($_GET['id']) ? $_GET['id'] : '');
$mt = trim(isset($_GET['mt']) ? $_GET['mt'] : '');
$dados = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM product WHERE product_token = '$ID'"));
$check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM product WHERE product_token = '$ID'"));
$bk = "bkash";
$ng = "nagad";
$bi = "binance";
if (isset($_POST['sub'])){
$username = $login_data['_username'];
$price = $dados['product_version'];
$pd_type = $dados['pd_type'];
$tnx = $_POST['tnx'];
$email = $_POST['email'];
$name = $dados['product_name_show'];

$check_if_exists = mysqli_num_rows(mysqli_query($con, "SELECT * FROM transaction WHERE transaction = '$tnx'"));
		if ($check_if_exists > 0) {
		$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Transaction Already Exists</div>';
    } else {
    
if ($mt == $bk) {
	$insert = mysqli_query($con, "INSERT INTO `transaction` (`username`, `transaction`, `email`, `status`, `token`, `type`, `price`, `name`, `pd_type`) VALUES ('$username', '$tnx', '$email', 'painding', '$ID', 'bkash', '$price', '$name', '$pd_type');");
	} else
	if ($mt == $ng) {
	$insert = mysqli_query($con, "INSERT INTO `transaction` (`username`, `transaction`, `email`, `status`, `token`, `type`, `price`, `name`, `pd_type`) VALUES ('$username', '$tnx', '$email', 'painding', '$ID', 'nagad', '$price', '$name', '$pd_type');");
	} else
	if ($mt == $bi) {
	$insert = mysqli_query($con, "INSERT INTO `transaction` (`username`, `transaction`, `email`, `status`, `token`, `type`, `price`, `name`, `pd_type`) VALUES ('$username', '$tnx', '$email', 'painding', '$ID', 'binance', '$price', '$name', '$pd_type');");
	}
		if ($insert){
  $_SESSION['inc']= '<div class="alert alert-success" role="alert">Successful</div>';
       header("refresh:2;url=index.php");
 
	} else {
	$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Failed Exception : 408</div>';
	}
	}
}
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Input groups - Forms | Vuexy - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <?php include('./css.php'); ?>
    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
      
<?php if (empty($_SESSION['is_logged_in'])){ ?>
    
<?php include('header.php'); ?>
<?php } ?>
	<?php if ($login_data['_user_type'] == "member") { ?>
<?php include('header-member.php'); ?>
<?php } ?>
	<?php if ($login_data['_user_type'] == "admin") { ?>
<?php include('header-admin.php'); ?>
<?php } ?>
	<?php if ($login_data['_user_type'] == "owner") { ?>
<?php include('header-owner.php'); ?>
<?php } ?>
	<?php if ($login_data['_user_type'] == "reseller") { ?>
<?php include('header-reseller.php'); ?>
<?php } ?>
      
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                        <?php if (!empty($_SESSION['inc'])) { ?>
        <?php echo $_SESSION['inc'];
        unset($_SESSION['inc']);?>
        <?php } ?>
            
             <!-- <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Input groups</h4> -->
              
              
              
              <!-- Button with dropdowns & addons -->
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                  <form class="dt_adv_search" method="POST">
                    <h5 style="margin-bottom: -30px; margin-top: -10px;" class="card-header">Add </h5>
                      <hr>
                    <div style="margin-top: -20px; " class="card-body demo-vertical-spacing demo-only-element">
                    
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Nmae : <?php echo $dados['product_name_show']; ?></label>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Price : <?php echo $dados['product_version']; ?></label>
                      
            <?php if ($mt == $bk) { ?>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Price : 1$ = 100৳</label>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Number : 01824414308</label>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Copy The Number And Send Money</label>
                      <?php } ?>
                      
<?php if ($mt == $ng) { ?>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Price : 1$ = 100৳</label>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Number : 01824414308</label>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Copy The Number And Send Money</label>
                      <?php } ?>
                      
<?php if ($mt == $bi) { ?>
                      <br>
                      
                      <label class="form-label" for="basic-default-fullname">Binance ID : Sorry We dose not Have</label>
                      <br>
                      <label class="form-label" for="basic-default-fullname">Copy The ID And Send Money</label>
                      <?php } ?>
                      
                    </div>
                    
                    
                    
                    
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Enter the Transaction ID</label>
                        <input class="form-control" id="basic-default-fullname" name="tnx" type="text" placeholder="Enter the Transaction ID" required />
                    </div>
                    
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Enter Your Email</label>
                        <input class="form-control" id="basic-default-fullname" name="email" type="email" placeholder="Enter Your Email" required />
                    </div>

                    <hr>
                    	
	<button type="submit" name="sub" class="btn btn-outline-primary w-100"><i class="dw dw-upload"></i> Submit</button>
	</form>


                  </div>
                </div>

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <?php include('./js.php'); ?>
    
  </body>
</html>
