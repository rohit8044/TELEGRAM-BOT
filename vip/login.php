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
        "Title" => "Maintenance",
        "Msg" => $server_data["main_text"],
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}
        
if($server_data['server_h_status'] == 'offline'){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Mod Offline!",
        "Title" => "Offline",
        "Msg" => $server_data["off_text"],
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

//Username Validator
$uname = $data["uname"];
if($uname == null || preg_match("([a-zA-Z0-9]+)", $uname) === 0){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "1",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

//Password Validator
$pass = $data["pass"];
if($pass == null || !preg_match("([a-zA-Z0-9]+)", $pass) === 0){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "2",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}


$query = $con->query("SELECT * FROM `update` WHERE `_username` = '".$uname."' AND `_password` = '".$pass."'");
$res = $query->fetch_assoc();

$https = "https://";
$server = $https.$_SERVER['SERVER_NAME'];
$path = $server.$res["_path"];

if($query->num_rows < 1){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Update",
        "Title" => $res["_title"],
        "Name" => $res["_name"],
        "Msg" => $res["_msg"],
        "Link" => $path,
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

$ackdata = array(
    "Status" => "BT4Team",
    "MessageString" => "",
);

echo tokenResponse($ackdata);
