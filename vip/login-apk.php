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



$query = $con->query("SELECT * FROM `panel` WHERE `_username` = '".$uname."' AND `_password` = '".$pass."'");
if($query->num_rows < 1){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Username Or Password Is Incorrect",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

$res = $query->fetch_assoc();

if($res["_reg_date"] == 'NULL'){
    $query = $con->query("UPDATE `panel` SET `_reg_date` = CURRENT_TIMESTAMP WHERE `_username` = '$uname'");
}

if($res["_exp_date"] == 'NULL'){
    
    $query = $con->query("UPDATE `panel` SET `_exp_date` = '$add_days' WHERE `_username` = '$uname'");
}

$uidup = $data["cs"];

if($res["_uid"] == NULL){
    $query = $con->query("UPDATE `panel` SET `_uid` = '$uidup' WHERE `_username` = '".$uname."' AND `_password` = '".$pass."'");
}

else if($res["_uid"] != $uidup) {
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Invalid Device Detected!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

if($res["expired"] < $res["registered"]){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "login expired!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

if($res["_status"] == "banned"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Username Banned!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}


if($res["paid"] == "free"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Accout is free",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

if($res["_user_type"] == "admin"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "User Not Available!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

if($res["_user_type"] == "reseller"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "User Not Available!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

if($res["_user_type"] == "owner"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "User Not Available!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

if($res["_user_type"] == "server"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "User Not Available!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

$uidup = $data["cs"];

if($res["_version"] == "free"){
    $query = $con->query("UPDATE `panel` SET `_uid` = '$NULL'  WHERE `_username` = '".$uname."' AND `_password` = '".$pass."'");
}



if($res["_v_status"] == "not-verified"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Not Verified",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}


if($res["paid"] == "no"){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Not Verified",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}


if(strtotime(date("Y/m/d G:i")) > strtotime($res['_exp_date'])){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Login expired!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}


$mod ="select * from `mod` WHERE `check` = 'old'";
$modd = mysqli_query($con, $mod);
$mdnm = mysqli_fetch_assoc($modd);

$mod1 ="select * from `safe_or_not` WHERE `server_name` = 'panel'";
$modd1 = mysqli_query($con, $mod1);
$mdnm1 = mysqli_fetch_assoc($modd1);

$fun1 = mysqli_query($con, "SELECT * FROM function WHERE id = '1'");
$function1 = mysqli_fetch_assoc($fun1);

$fun2 = mysqli_query($con, "SELECT * FROM function WHERE id = '2'");
$function2 = mysqli_fetch_assoc($fun2);

$fun3 = mysqli_query($con, "SELECT * FROM function WHERE id = '3'");
$function3 = mysqli_fetch_assoc($fun3);

$fun4 = mysqli_query($con, "SELECT * FROM function WHERE id = '4'");
$function = mysqli_fetch_assoc($fun4);

$fun5 = mysqli_query($con, "SELECT * FROM function WHERE id = '5'");
$function = mysqli_fetch_assoc($fun5);



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

    "op-1-name" => $function1["name"],
    "op-1-status" => $function1["status"],
    
    "op-2-name" => $function2["name"],
    "op-2-status" => $function2["status"],
    
    "op-3-name" => $function3["name"],
    "op-3-status" => $function3["status"],  
    
    "op-4-name" => $function4["name"],
    "op-4-status" => $function4["status"],
    
    "op-5-name" => $function5["name"],
    "op-5-status" => $function5["status"],

    $database = date_create($res["_exp_date"]),
$datadehoje = date_create(),
$resultado = date_diff($database, $datadehoje),
$dias = date_interval_format($resultado, '%a'),
"Dias" => "$dias Days Remaining"
);

echo tokenResponse($ackdata);
