<?php
require '../../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["create_user_btn"])){
	
	$user_name = $connect->escape_string($_POST["user_name"]);
	$user_surname = $connect->escape_string($_POST["user_surname"]);
	$user_password = $connect->escape_string(password_hash($_POST['user_password'], PASSWORD_BCRYPT));
	$user_email = $connect->escape_string($_POST["user_email"]);
	$user_phone = $connect->escape_string($_POST["user_phone"]);
	$hash = $connect->escape_string( md5( rand(0,1000) ) );
	$user_status = $connect->escape_string($_POST["user_status"]);
	$active = $_POST["active_status"];
	if ($active == "Active"){
		$active_status = "1";
	}else{
		$active_status = "0";
	}
	
	if ($user_status == "Simple User"){
		$sql = "INSERT INTO `users` (`Name`, `Surname`, `Email`, `Password`, `Phone`, `Hash`, `Active`) 
	                     VALUES ('$user_name', '$user_surname', '$user_email', '$user_password', '$user_phone','$hash', '$active_status');";
		$connect->query($sql);
		$_SESSION['return_msg'] = "User created!";
		header("Location: ../all_users.php");
	}else{
		$sql = "INSERT INTO `admins` (`Name`, `Surname`, `Email`, `Password`, `Phone`, `Hash`, `Active`) 
	                     VALUES ('$user_name', '$user_surname', '$user_email', '$user_password', '$user_phone','$hash', '$active_status');";
		$connect->query($sql);
		$_SESSION['return_msg'] = "Admin created!";
		header("Location: ../all_admins.php");
	}
	
}else{
	header("Location: ../index.php");
}