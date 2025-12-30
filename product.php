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

    <title>Product | <?php echo ''.$server_data['server_name'].'';?></title>

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
                <div class="col-sm-12 col-xl-3 col-xl-4 mb-3 col-lg-4 col-12">
                  <div class="card h-100">
                    <img class="card-img-top" src="<?php echo $dados['product_path'];?>" alt="Card image cap" />
      <div class="card-body" >
        <h class="card-title">Name : <?php echo $dados['product_name_show']; ?></h>
        <hr>
        <h class="card-title">Price : <?php echo $dados['product_version']; ?></h>
        <hr>
        <h class="card-title">Details</h>
        <br>
        <h class="card-title"><?php echo $dados['product_status']; ?></h>
        <hr>
        <a href="payment-method.php?id=<?php echo $dados['product_token'];?>" class="btn btn-outline-primary">Buy Now</a>
        
                  </div>
                </div>
               </div>
                
                
              
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="fw-medium">Pixinvent</a>
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                      >License</a
                    >
                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4"
                      >More Themes</a
                    >

                    <a
                      href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >

                    <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                      >Support</a
                    >
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

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
