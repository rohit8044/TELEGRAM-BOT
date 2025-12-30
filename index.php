<?php
session_start();
include 'dbConfig.php';
if (!empty($_SESSION['is_logged_in'])){
$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));
} else 
if (!empty($_COOKIE['is_logged_in'])){

$login = $_COOKIE['is_logged_in'];

$_SESSION['is_logged_in'] = $login;

$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));

}
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

    <title>Dashboard | <?php echo ''.$server_data['server_name'].'';?></title>

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
                   <?php
					$query_nt = mysqli_query($con,"SELECT * FROM product");
					while ($row = mysqli_fetch_assoc($query_nt)) {
				?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-3 col-lg-4 col-6">
                  <div class="card h-100">
                    <img class="card-img-top" src="<?php echo $row['product_path'];?>" alt="Card image cap" />
      <div style="padding: 0.7rem;" >
        <h class="card-title"><?php echo $row['product_name_show'];?></h>
        <hr>
	
        <a href="product.php?id=<?php echo $row['product_token'];?>" class="btn btn-outline-primary w-100">View More</a>
      
                  </div>
                </div>
               </div>
                <?php } ?>
                
              
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
