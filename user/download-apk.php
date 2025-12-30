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
date_default_timezone_set('Asia/Dhaka');
$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
$online = 'online';

if(isset($_GET['file_name'])) { // Check if a file name has been provided
    $apk_name = mysqli_real_escape_string($con, $_GET['file_name']);
    $sql = "SELECT * FROM `apks` WHERE `apk_name`='$apk_name'";
    $result = mysqli_query($con, $sql);
    $file = mysqli_fetch_assoc($result);
    $file_path = "../apks/" . $_GET['file_name']; // Set the path to the file using the file name
    $file_name = $_GET['file_name']; // Set the name of the file that will be downloaded

    // Check if the file exists
    if (file_exists($file_path)) {
      $file_name = str_replace(" ","",$file_name);
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . $file_name);
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file_path));

      // Read and output the file contents
      readfile($file_path);
      $newCount = $file['apk_downloads'] + 1;
      $updateQuery = "UPDATE `apks` SET `apk_downloads`=$newCount WHERE `apk_name`='$apk_name'";
      mysqli_query($con, $updateQuery);

  } else {
        // File does not exist, display an error message
        $_SESSION['inc']= '<div class="alert alert-danger" role="alert">File not found.</div>';
    }
}



if(isset($_GET['files_name'])) {
    $fileName = str_replace("..", ".", $_GET['files_name']); //required. if somebody is trying parent folder files
    $filePath = "../apks/" . $fileName;

    // DELETE The File Record from database
    $result = $con->query("DELETE from apks WHERE apk_path = '$filePath' ");
    if(!$result) {
        echo $con->error;
    } else {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $_SESSION['inc']= '<div class="alert alert-success" role="alert">Deleted File '.$fileName.'</div>';
    }
}


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

    <title>Download Apk | <?php echo ''.$server_data['server_name'].'';?></title>

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
            <?php if (!empty($_SESSION['inc'])) { ?>
        <?php echo $_SESSION['inc'];
        unset($_SESSION['inc']);?>
        <?php } ?>

              <!-- Select -->
              <div class="card">
                <h5 style="margin-bottom: -30px; margin-top: -10px;" class="card-header">Download Apk</h5>
                <hr>
                <div style="padding-left: 0px; padding-right: 0px;" class="card-datatable dataTable_select text-nowrap">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered display nowrap" style="width:100%">
                    <thead>
							<tr>
									<th>Apk Name</th>
									<th>Apk Version</th>
									<th>Apk Status</th>
									<th>Apk Size</th>
									<th>Downloads</th>
									<th>Upload Date</th>
									<th>Download</th>
								</tr>
						</thead>
						<tbody>
							<?php
									$query_apks = mysqli_query($con,"SELECT * FROM apks ORDER BY id ASC");
							     	while ($row = mysqli_fetch_assoc($query_apks)) {
									?> <tr>
                  <td class="table-plus"><?php echo $row['apk_name_show']; ?></td>
                  <td><?php echo $row['apk_version']; ?></td>
                  	<th><?php 
										if($row['apk_status'] == "online"){
											echo "<span class='badge border border-success text-success mt-1'><i class='fas fa-circle-check '></i> Online</span>"; 
										}else if($row['apk_status'] == "maintain"){
											echo "<span class='badge border border-warning text-warning mt-1'><i class='fas fa-triangle-exclamation '></i> Maintenance</span>";
										}else{
											echo "<span class='badge border border-danger text-danger mt-1'><i class='fas fa-circle-xmark '></i> Offline</span>";
										}
										?></td>
                  <td><?php echo $row['apk_size'] / (1024 * 1024), 2; ?> Mb</td>
                  <td><?php echo $row['apk_downloads']; ?></td>
                  <td><?php echo $row['created_at']; ?></td>
                                      <td><a href="?file_name=<?php echo $row['apk_name']; ?>" download="?file_name=<?php echo $row['apk_name']; ?>"><button type="button" class="btn btn-primary">Download</button></a></td>
                </tr> <?php } ?>
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
    
    
    <?php include('../js-2.php'); ?>
  </body>
</html>
