<?php
require("dbConfig.php");

$fetch_server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
	$server_data = mysqli_fetch_assoc($fetch_server);
	
if(isset($_GET['v_code']))
{
  $v_code = mysqli_real_escape_string($con, $_GET['v_code']);
  
  $query = "SELECT * FROM `panel` WHERE `verification_code`='$v_code'";
  $result = mysqli_query($con, $query);
  
  if(mysqli_num_rows($result) == 1)
  {
    $result_fetch = mysqli_fetch_assoc($result);
    
    if($result_fetch['is_verified'] == 0)
    {
      $email = $result_fetch['email'];
      $update = "UPDATE `panel` SET `is_verified`=1, `_v_status`='verified' WHERE `verification_code`='$v_code'";
      
      if(mysqli_query($con, $update))
      {
        $_SESSION['inc']= '<span style="color:#71dd37;" >Verify Success <br>Thank You User For Verify Your Account</span>';
      }
      else
      {
        $_SESSION['inc']= '<span style="color:#ff3e1d;" >Faild Verification</span>';
      }
    }
    else
    {
      $_SESSION['inc']= '<span style="color:#ff3e1d;" >Verify Faild <br>Email Already Verified</span>';
    }
  }
  else
  {
    $_SESSION['inc']= '<span style="color:#ff3e1d;" >Faild Verification</span>';
  }
}


?> 
 

<?php if (isset($_GET['v_code'])) { ?>
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

    <title>Verification | <?php echo ''.$server_data['server_name'].'';?></title>

    <meta name="description" content="" />

    <?php include('./css.php'); ?>
    

  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
        
          <!-- Login -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4 mt-2">
                
                  <span class="app-brand-text demo text-body fw-bold ms-1">Email Verification</span>
                
              </div>
              <!-- /Logo -->

              <form class="dt_adv_search" method="POST">
                <div class="mb-3">
                  <h3><?php if (!empty($_SESSION['inc'])) { ?>
        <?php echo $_SESSION['inc'];
        unset($_SESSION['inc']);?>
        <?php } ?></h3>
                </div>
                <br>
                <div class="mb-3">
                  <a href="login.php" class="btn btn-primary d-grid w-100" type="submit">Login</a>
               
              </form>
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

<?php } ?>