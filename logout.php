<?php
session_start();
include 'dbConfig.php';
unset($_SESSION['is_logged_in']);
setCookie('is_logged_in','no',time()-(60*60*24*30));
session_destroy();
header("Location: ".BASE_URL . "login.php");
?>