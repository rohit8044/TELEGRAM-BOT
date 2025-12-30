<?php
session_start();
include 'dbConfig.php';

if (empty($_SESSION['is_logged_in'])){

if (empty($_COOKIE['is_logged_in'])){
//header("Location: ../login.php");
} else {

$login = $_COOKIE['is_logged_in'];

$_SESSION['is_logged_in'] = $login;

}
}

$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));

$ID = trim(isset($_GET['id']) ? $_GET['id'] : '');
$dados = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM product WHERE product_token = '$ID'"));
$check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM product WHERE product_token = '$ID'"));
$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
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

    <title>Payment Methods | <?php echo ''.$server_data['server_name'].'';?></title>

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
              <div class="row">
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-3 col-lg-4 col-6">
                  <div class="card h-100">
                    <a href="payment.php?mt=binance&id=<?php echo $dados['product_token'];?>"><img class="card-img-top" src="./logo/binance.png" alt="Card image cap" />
      <div style="padding: 0.7rem;" >
        <h class="card-title">Binance</h>
        </a>
      
                  </div>
                </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-3 col-lg-4 col-6">
                  <div class="card h-100">
                    <a href="payment.php?mt=bkash&id=<?php echo $dados['product_token'];?>"><img style="padding: 1.5rem;" class="card-img-top" src="./logo/bkash.png" alt="Card image cap" />
      <div style="padding: 1rem;" >
        <h class="card-title">bKash</h>
        </a>
      
                  </div>
                </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-3 col-lg-4 col-6">
                  <div class="card h-100">
                    <a href="payment.php?mt=nagad&id=<?php echo $dados['product_token'];?>"><img class="card-img-top" src="./logo/nagad.png" alt="Card image cap" />
      <div style="padding: 0.7rem;" >
        <h class="card-title">Nagad</h>
        </a>
      
                  </div>
                </div>
               </div>
                
                
              
            </div>
            <!-- / Content -->



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
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    
   <?php include('./js.php'); ?>
  </body>
</html>
