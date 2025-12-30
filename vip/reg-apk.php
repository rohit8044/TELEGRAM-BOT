<?php
include 'init.php';
$crypter = Crypter::init();
$privatekey = readFileData("Keys/PrivateKey.prk");

date_default_timezone_set('Asia/Dhaka');

function tokenResponse($data){
    global $crypter, $privatekey;
    $data = toJson($data);
    $datahash = sha256($data);
    $acktoken = array(
        "Data" => profileEncrypt($data, $datahash),
        "Sign" => toBase64($crypter->signByPrivate($privatekey, $data)),
        "Hash" => $datahash
    );
    return toBase64(toJson($acktoken));
}

//token data
$token = fromBase64($_POST['token']);
$tokarr = fromJson($token, true);

//Data section decrypter
$encdata = $tokarr['Data'];
$decdata = trim($crypter->decryptByPrivate($privatekey, fromBase64($encdata)));
$data = fromJson($decdata);

//Hash Validator
$tokhash = $tokarr['Hash'];
$newhash = sha256($encdata);

if (strcmp($tokhash, $newhash) == 0) {
    PlainDie();
}

$server = mysqli_query($con, "SELECT * FROM server WHERE srv_id = '1'");
$server_data = mysqli_fetch_assoc($server);
        
if($server_data['server_h_status'] == 'main'){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Mod Maintenance!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}
        
if($server_data['server_h_status'] == 'offline'){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Mod Offline!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

//Username Validator
$uname = $data["uname"];
if($uname == null || preg_match("([a-zA-Z0-9]+)", $uname) === 0){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Invalid Username Format",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

//Password Validator
$pass = $data["pass"];
if($pass == null || !preg_match("([a-zA-Z0-9]+)", $pass) === 0){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Invalid Password Format",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}


$check_if_exists = mysqli_num_rows(mysqli_query($con, "SELECT * FROM panel WHERE _username = '$uname'"));
		if ($check_if_exists > 0) {
	    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Already Exist",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}




$query = $con->query("SELECT * FROM `panel` WHERE `_username` = '".$uname."' AND `_password` = '".$pass."'");
if($query->num_rows < 1){

date_default_timezone_set('Asia/Dhaka');
$token = bin2hex(random_bytes(5));
$verify = 'verified';
$status = 'active';
$reg_date = date("Y/m/d G:i");
$exp_date = Date('Y-m-d G:i', strtotime('+1 day'));
$curr_time = date("Y/m/d G:i"); 
$user_role = 'member';
$money = '0';
$registrar = 'BT4';
$version = 'injector';
$p_status = 'paid';
$resets = '0';
$is_verified = '1';
$verifycode = bin2hex(random_bytes(32));

	$insert = mysqli_query($con, "INSERT INTO `panel` (`_username`, `_password`, `_token`, `_v_status`, `_status`, `_reg_date`, `_exp_date`, `_curr_time`, `_uid`, `_user_type`, `_registrar`, `_version`, `_p_status`, `_credits`, `_resets`, `_r_resets`, `verification_code`, `is_verified`, `paid`, `by`) VALUES ('$uname', '$pass', '$token', '$verify', 'active', '$reg_date', '$exp_date', '$reg_date', NULL, '$user_role', '$registrar', '$version', 'paid', '$money', '0', '$resets', '$verifycode', '$is_verified', 'no', 'apk');");

}



$mod ="select * from `mod` WHERE `check` = 'old'";
$modd = mysqli_query($con, $mod);
$mdnm = mysqli_fetch_assoc($modd);

$mod1 ="select * from `safe_or_not` WHERE `server_name` = 'panel'";
$modd1 = mysqli_query($con, $mod1);
$mdnm1 = mysqli_fetch_assoc($modd1);

$fun = mysqli_query($con, "SELECT * FROM function WHERE id = '1'");
$function = mysqli_fetch_assoc($fun);



$ackdata = array(
    "Status" => "Success",
    "MessageString" => "",
    "SubscriptionLeft" => $res["_exp_date"],
    "Validade" => $res["_exp_date"],
    "Title" => $title,
   "icon" => $icon,
   "isactive" => $isactive,
  "Username" => $res["_username"],
   "Vendedor" => $res["_registrar"],
    "RegisterDate" => $res["_reg_date"],
    "ModName" => $mdnm["name"],
    "SafeorNot" => $mdnm1["safe_or_not"],
    "FloatingText" => $mdnm1["text"],
    "MainText" => $tatus["main_text"],
    "OffText" => $tatus["off_text"],
    "DRAG" => $function["darg"],
    "BODY" => $function["body"],
    "MAGIC" => $function["magic"],
    "Maintenance" => "Maintenance",
    "Offline" => "Offline",
    $database = date_create($res["_exp_date"]),
$datadehoje = date_create(),
$resultado = date_diff($database, $datadehoje),
$dias = date_interval_format($resultado, '%a'),
"Dias" => "$dias Days Remaining"
);

echo tokenResponse($ackdata);
