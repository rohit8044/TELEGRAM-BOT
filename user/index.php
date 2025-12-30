<?php
session_start();
include '../dbConfig.php';
if (empty($_SESSION['is_logged_in'])){

if (empty($_COOKIE['is_logged_in'])){
header("Location: ../login.php");
} else {

$login = $_COOKIE['is_logged_in'];

$_SESSION['is_logged_in'] = $login;

}
}
$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));
$notif = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM nt WHERE n = 'all'" ));
if ($login_data['_user_type'] != "member") {
	header("Location: ../login.php");
	exit();
}
$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
$online = 'online';
$offline = 'offline';
$online1 = 'Online';
date_default_timezone_set('Asia/Dhaka');
$time = date("Y/m/d h:i"); 
$m = 'main';
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard | <?php echo ''.$server_data['server_name'].'';?></title>

    <meta name="description" content="" />
    
    <?php include('../css-2.php'); ?>

  </head>
  <body>
      <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
      
      <?php include('header.php'); ?>
      
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- View sales -->
                <div class="col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-7">
                        <div class="card-body text-nowrap">
                          <h5 class="card-title mb-0">Welcome <?php echo ''.$_SESSION['is_logged_in'].'';?>! 🎉</h5>
                          <p class="mb-2">This is the server of Blue Triple 4</p>
                          <h4 class="text-primary mb-1"><?php echo ''.$server_data['total_sessions'].'';?></h4>
                          <h >Total Views</h>
                        </div>
                      </div>
                      <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- View sales -->

                <!-- Statistics -->
                <div class="col-xl-8 mb-4 col-lg-7 col-12">
                  <div class="card h-100">
                    <div class="card-header">
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Products</h5>
                       
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row gy-3">
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                              <i class="ti ti-sitemap ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php $fetch_t = mysqli_query($con, "SELECT * FROM product");
	$count = mysqli_num_rows($fetch_t);
	echo $count; ?></h5>
                              <small>Products</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                              <i class="ti ti-brand-android ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php $fetch_t = mysqli_query($con, "SELECT * FROM apks");
	$count = mysqli_num_rows($fetch_t);
	echo $count; ?></h5>
                              <small>Apks</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                              <i class="ti ti-file-code ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php $fetch_t = mysqli_query($con, "SELECT * FROM script");
	$count = mysqli_num_rows($fetch_t);
	echo $count; ?></h5>
                              <small>Scripts</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                              <i class="ti ti-file ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php $fetch_t = mysqli_query($con, "SELECT * FROM lib");
	$count = mysqli_num_rows($fetch_t);
	echo $count; ?></h5>
                              <small>Libs</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Statistics -->
                
               
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0">Member</h4>
                          <small>Your Role</small>
                        </div>
                        <span class="badge bg-label-primary rounded-circle p-2">
                          <i class="ti ti-user ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if ($server_data['server_h_status'] == $online) { ?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0">Online</h4>
                          <small>Mod Status</small>
                        </div>
                        <span class="badge bg-label-danger rounded-circle p-2">
                          <i class="ti ti-brand-android ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
            <?php if ($server_data['server_h_status'] == $m) { ?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0">Maintenance</h4>
                          <small>Mod Status</small>
                        </div>
                        <span class="badge bg-label-danger rounded-circle p-2">
                          <i class="ti ti-brand-android ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
            <?php if ($server_data['server_h_status'] == $offline) { ?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0">Offline</h4>
                          <small>Mod Status</small>
                        </div>
                        <span class="badge bg-label-danger rounded-circle p-2">
                          <i class="ti ti-brand-android ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
            <?php if ($server_data['server_status'] == $online) { ?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0">Online</h4>
                          <small>Server Status</small>
                        </div>
                        <span class="badge bg-label-info rounded-circle p-2">
                          <i class="ti ti-settings ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <?php if ($server_data['server_status'] == $m) { ?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0">Maintenance</h4>
                          <small>Server Status</small>
                        </div>
                        <span class="badge bg-label-info rounded-circle p-2">
                          <i class="ti ti-settings ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
            <?php if ($server_data['server_status'] == $offline) { ?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0">Offline</h4>
                          <small>Server Status</small>
                        </div>
                        <span class="badge bg-label-info rounded-circle p-2">
                          <i class="ti ti-settings ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="col-sm-6 col-xl-3 col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="content-left">
                          <h4 class="mb-0"><?php echo ''.$login_data['_registrar'].''; ?></h4>
                          <small>Provider</small>
                        </div>
                        <span class="badge bg-label-primary rounded-circle p-2">
                          <i class="ti ti-user ti-md"></i>
                        </span>
                      </div>
                    </div>
                  </div>
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
    
   <?php include('../js-2.php'); ?>
  </body>
</html>
