<?php
session_start();
include './dbConfig.php';
if (empty($_SESSION['is_logged_in'])){

if (empty($_COOKIE['is_logged_in'])){
header("Location: ./login.php");
} else {

$login = $_COOKIE['is_logged_in'];

$_SESSION['is_logged_in'] = $login;

}
}
$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));
$notif = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM nt WHERE n = 'all'" ));


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

    <title>My Orders | <?php echo ''.$server_data['server_name'].'';?></title>

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

              <!-- Select -->
              <div class="card">
                <h5 style="margin-bottom: -30px; margin-top: -10px;" class="card-header">My Orders</h5>
                <hr>
                <div style="padding-left: 0px; padding-right: 0px;" class="card-datatable dataTable_select text-nowrap">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                    <thead>
							<tr>
                  <th>Name</th>
                  <th>Transaction</th>
                  <th>Price</th>
                  <th>Type</th>                 
                  <th>Pyment_Type</th>
                  <th>Status</th>
								</tr>
						</thead>
						<tbody>
						 <?php
									$query_products = mysqli_query($con,"SELECT * FROM transaction WHERE `username` = '".$_SESSION['is_logged_in']."'");
							     	while ($row = mysqli_fetch_assoc($query_products)) {
									?> <tr>
                  <td class="table-plus"><?php echo $row['name']; ?></td>
                  <td><?php echo $row['transaction']; ?></td>
                  <td><?php echo $row['price']; ?></td>
                  <td><?php echo $row['pd_type']; ?></td>
                  <td><?php echo $row['type']; ?></td>
                  <td><?php echo $row['status']; ?></td>
								</tr>
								<?php } ?>
						</tbody>
                  </table>
                </div>
              </div>
              <!--/ Select -->
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
    
    
    <?php include('./js.php'); ?>
  </body>
</html>
