<?php
session_start();
include '../dbConfig.php';
if (empty($_SESSION['is_logged_in'])){
header("Location: ../login.php");
}
$login_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM panel WHERE _username = '".$_SESSION['is_logged_in']."'"));
$notif = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM nt WHERE n = 'all'" ));
if ($login_data['_user_type'] != "admin" && $login_data['_user_type'] != "member" && $login_data['_user_type'] != "reseller") {
	header("Location: ../login.php");
	exit();
}
$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
$online = 'online';
if (isset($_POST['value_2'])){
$old_pass = $_POST['value_1'];
$new_pass = $_POST['value_2'];
$cn_pass = $_POST['value_3'];
if (empty($new_pass)){
$_SESSION['inc'] = "<script>swal('Error', 'New Password Field Is Empty', 'error');</script>";
} else if (empty($cn_pass)){
$_SESSION['inc'] = "<script>swal('Error', 'Confirm New Password Field Is Empty', 'error');</script>";
} else {
if ($new_pass == $old_pass){
$_SESSION['inc']= '<div class="alert alert-danger" role="alert">New Password Should Not Be Equal To Your Old Password</div>';
} else if ($new_pass == $cn_pass){
$update_query = mysqli_query($con, "UPDATE panel SET _password = '$cn_pass' WHERE _username = '".$_SESSION['is_logged_in']."'");
if ($update_query){
$_SESSION['inc']= '<div class="alert alert-success" role="alert">Your Password Has Been Changed Successfully</div>';
} else {
$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Failed To Change Your Password</div>';
}
} else {
$_SESSION['inc']= '<div class="alert alert-danger" role="alert">New Password Should Be Equal To Confirm Password</div>';
}
}
}
if (isset($_POST['reset'])){
if ($login_data['_uid'] != NULL){
if ($login_data['_r_resets'] < $login_data['_resets']){
$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Your Reset Limit Has Been Exceeded</div>';
}
if ($login_data['_r_resets'] == $login_data['_resets']){
$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Your Reset Limit Has Been Exceeded</div>';
} else {
$reset_query = mysqli_query($con, "UPDATE panel SET _uid = NULL WHERE _username = '".$_SESSION['is_logged_in']."'");
if ($reset_query){
$inc_resets = $login_data['_resets'] + 1;
$reset_query = mysqli_query($con, "UPDATE panel SET _resets = '$inc_resets' WHERE _username = '".$_SESSION['is_logged_in']."'");
$_SESSION['inc']= '<div class="alert alert-success" role="alert">Your Account Has Been Reseted Successfully</div>';
} else {
$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Failed To Reset Your Account</div>';
}
}
} else {
$_SESSION['inc']= '<div class="alert alert-danger" role="alert">Your Account Is Not Connected To Any Device</div>';
}
}


if (isset($_POST['change'])){
$output_dir = "../assets/img/avatars/";

  if(isset($_FILES["profile"]))
  {
      $ret = array();
      $error =$_FILES["profile"]["error"];
      if(!is_array($_FILES["profile"]["name"]))
      {   
          $apkName = $_FILES["profile"]["name"];
          $apkExtension = pathinfo($apkName, PATHINFO_EXTENSION);
          $allowedExtensions = ['png'];
          $apkPath = $output_dir.$apkName ;
          if(!in_array($apkExtension, $allowedExtensions)) {
$_SESSION['inc']= '<div class="alert alert-warning" role="alert">Only Png Uploads Here !</div>';
        }
          $uploaded = move_uploaded_file($_FILES["profile"]["tmp_name"],$apkPath);
          if(!$uploaded){
              echo 'Error! Failed to Upload the png ';exit;
          }
          $query = "UPDATE panel SET profile = '{$apkPath}' WHERE _username = '".$_SESSION['is_logged_in']."'";
          $result = mysqli_query($con, $query);
          if(!$result) {
              echo 'Error! Failed to insert the png'. "<pre>" . mysqli_error($con) . "</pre>";exit;
          } else {

              $_SESSION['inc']= '<div class="alert alert-success" role="alert">Profile Photo Change Successfully</div>';
              header("Refresh:0; url=profile.php");
            exit();
          }
      }
      else
      {
          $apkCount = count($_FILES["profile"]["name"]);
          for($i=0; $i < $apkCount; $i++)
          { 
            $apkName = $_FILES["profile"]["name"][$i];
            $apkPath = $output_dir.$apkName ;
            move_uploaded_file($_FILES["profile"]["tmp_name"][$i],$output_dir.$apkName);
            $ret[]= $apkName;
          $query = "UPDATE panel SET profile = '{$apkPath}' WHERE _username = '".$_SESSION['is_logged_in']."'";
            $result = mysqli_query($con, $query);
            if(!$result) {
                echo 'Error! Failed to insert the png'. "<pre>" . mysqli_error($con) . "</pre>";exit;
            }
        }

    }
    $_SESSION['inc']= '<div class="alert alert-success" role="alert">Profile Photo Change Successfully</div>';
    header("Refresh:1; url=profile.php");
            exit();
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

    <title>Profile | <?php echo ''.$server_data['server_name'].'';?></title>

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

              <!-- Header -->
              <div class="row">
                <div class="col-12">
                  <div class="card mb-4">
                    <div class="user-profile-header-banner">
                      <img src="../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                      <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img
                          src="<?php echo ''.$login_data['profile'].'';?>"
                          alt="user image"
                          class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                      </div>
                      <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                          class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                          <div class="user-profile-info">
                            <h4><?php echo ''.$_SESSION['is_logged_in'].'';?></h4>
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Header -->

              <!-- User Profile Content -->
              <div class="row">
                <div class="col-12">
                  <!-- About User -->
                  <div class="card mb-4">
                  <h5 style="margin-bottom: -30px; margin-top: -10px;" class="card-header">About</h5>
                      <hr>
                    <div style="margin-top: -30px;" class="card-body">
                      
                      <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-user text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Username :</span> <span><?php echo ''.$_SESSION['is_logged_in'].'';?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-key text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Key/Token :</span> <span><?php echo ''.$login_data['_token'].'';?></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-crown text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Role :</span> <span>Member</span>
                        </li>
                        <?php if ($login_data['_version'] == "free") { ?> 
                        <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-crown text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Device :</span> <span>Unlimited</span>
                        </li>
                        <?php } ?>
                    <?php if ($login_data['_version'] == "injector") { ?>
                    <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-crown text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Device :</span> <span><?php 
										if($login_data['_uid'] == NULL){
											echo "0/1"; 
										}else{
											echo "1/1";
										}
										?></span>
                        </li>
                    <?php } ?>
                    <?php if ($login_data['_p_status'] == "unpaid") { ?>
                    <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-crown text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Email :</span> <span><?php echo ''.$login_data['email'].'';?></span>
                        </li>
                    <?php } ?>
                    
                    <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-crown text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Registered :</span> <span><?php echo ''.$login_data['_reg_date'].'';?></span>
                        </li>
                        
                    <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-crown text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Expired :</span> <span><?php echo ''.$login_data['_exp_date'].'';?></span>
                        </li>
                        
                        
                    <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-crown text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Resets :</span> <span><?php echo ''.$login_data['_resets'].'/'.$login_data['_r_resets'].'';?></span>
                        </li>
                    
                        
                        
                        <li class="d-flex align-items-center mb-3">
                          <i class="ti ti-user text-heading"></i
                          ><span class="fw-medium mx-2 text-heading">Provider :</span> <span><?php echo ''.$login_data['_registrar'].'';?></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <!--/ About User -->
                  
                  
                  <div class="col-md-12">
                  <div class="card mb-4">
                  
                  <form action="" method="POST" enctype="multipart/form-data">
                    <h5 style="margin-bottom: -30px; margin-top: -10px;" class="card-header">Change Profile Picture</h5>
                      <hr>
                    <div style="margin-top: -20px; " class="card-body demo-vertical-spacing demo-only-element">
                    
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Choose a picture</label>
                      <label class="col-sm-12 col-md-2 col-form-label" data-hs-file-attach-options='{
                 "textTarget": "[for=\"customFile\"]"
                }'></label>

                <input type="file" class="form-control-file form-control height-auto" name="profile"  required />
                    </div>
                    
                    
                    <hr>
                    	<div align="right">
	<button type="submit" name="change" class="btn btn-outline-primary"><i class="dw dw-upload"></i> Submit</button>
	</div>
</form>

                  </div>
                  </div>
                </div>
                
                
                
                
                <?php if ($login_data['_version'] == "injector") { ?>
<div class="col-md-12">
                  <div class="card mb-4">
                  
                  <form class="dt_adv_search" method="POST">
                    <h5 style="margin-bottom: -30px; margin-top: -10px;" class="card-header">Reset Your Device</h5>
                      <hr>
                    <div style="margin-top: -20px; " class="card-body demo-vertical-spacing demo-only-element">
                    
                   
                  
                    	<button type="submit" name="reset" class="btn btn-outline-primary w-100"><i class="dw dw-settings1"></i> Reset </button>
</form>

                  </div>
                  </div>
                </div>
                <?php } ?>
                
                
                  
                  <?php if ($login_data['_version'] == "injector") { ?>
                  <!-- Change Password -->
                 <div class="col-12">
                  <div class="card mb-4">
                    <h5 style="margin-bottom: -30px; margin-top: -10px;" class="card-header">Change Password</h5>
                      <hr>
                    <div class="card-body">
                      
                  <form class="dt_adv_search" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-12 form-password-toggle">
                            <label class="form-label" for="currentPassword">Current Password</label>
                            <div class="input-group input-group-merge">
                              <input
                                class="form-control"
                                type="password"
                                name="value_1"
                                id="currentPassword"
                                readonly
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                value="<?php echo $login_data['_password'];?>" />
                              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-12 form-password-toggle">
                            <label class="form-label" for="newPassword">New Password</label>
                            <div class="input-group input-group-merge">
                              <input
                                class="form-control"
                                type="password"
                                id="newPassword"
                                name="value_2"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-12 form-password-toggle">
                            <label class="form-label" for="confirmPassword">Confirm New Password</label>
                            <div class="input-group input-group-merge">
                              <input
                                class="form-control"
                                type="password"
                                name="value_3"
                                id="confirmPassword"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                          </div>
                          </div>
                        <hr>
                          <div align="right">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                  <!--/ Change Password -->
                  <?php } ?>
                  
                </div>
              </div>
              <!--/ User Profile Content -->
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
