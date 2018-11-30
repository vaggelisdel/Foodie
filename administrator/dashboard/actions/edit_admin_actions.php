<?php
require '../../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["edit_admin_btn"])){
	
	$adminid = $_POST["adminid"];
	$user_name = $connect->escape_string($_POST["user_name"]);
	$user_surname = $connect->escape_string($_POST["user_surname"]);
	$user_password = $connect->escape_string(password_hash($_POST['user_password'], PASSWORD_BCRYPT));
	$user_email = $connect->escape_string($_POST["user_email"]);
	$user_phone = $connect->escape_string($_POST["user_phone"]);
	$hash = $connect->escape_string( md5( rand(0,1000) ) );
	$user_status_prev = $connect->escape_string($_POST["user_status_prev"]);
	$user_status_next = $connect->escape_string($_POST["user_status_next"]);
	$active = $_POST["active_status"];
	if ($active == "Active"){
		$active_status = "1";
	}else{
		$active_status = "0";
	}
	
	if ($user_status_prev == $user_status_next){
		if(!isset($_POST['user_password']) || trim($_POST['user_password'])) {
			$sql = "UPDATE `admins` SET `Name` = '$user_name', `Surname` = '$user_surname', `Email` = '$user_email', `Password` = '$user_password', `Phone` = '$user_phone', `Active` = '$active_status' WHERE `AdminID` = '$adminid';";
			$connect->query($sql);
			$_SESSION['return_msg'] = "Admin updated!";
			header("Location: ../all_admins.php");
		}else{
			$sql = "UPDATE `admins` SET `Name` = '$user_name', `Surname` = '$user_surname', `Email` = '$user_email', `Phone` = '$user_phone', `Active` = '$active_status' WHERE `AdminID` = '$adminid';";
			$connect->query($sql);
			$_SESSION['return_msg'] = "Admin updated!";
			header("Location: ../all_admins.php");
		}
	}else{
		if(!isset($_POST['user_password']) || trim($_POST['user_password'])) {
			$sql = "DELETE FROM `admins` WHERE `AdminID` = '$adminid';";
			$connect->query($sql);
			$sql = "INSERT INTO `users` (`Name`, `Surname`, `Email`, `Password`, `Phone`, `Hash`, `Active`) 
							 VALUES ('$user_name', '$user_surname', '$user_email', '$user_password_old', '$user_phone','$hash', '$active_status');";
			$connect->query($sql);
			$_SESSION['return_msg'] = "Admin transferred to users!";
			header("Location: ../all_users.php");
		}else{
			$user_password_old = $_POST["user_password_old"];
			$sql = "DELETE FROM `admins` WHERE `AdminID` = '$adminid';";
			$connect->query($sql);
			$sql = "INSERT INTO `users` (`Name`, `Surname`, `Email`, `Password`, `Phone`, `Hash`, `Active`) 
							 VALUES ('$user_name', '$user_surname', '$user_email', '$user_password_old', '$user_phone','$hash', '$active_status');";
			$connect->query($sql);
			$_SESSION['return_msg'] = "Admin transferred to users!";
			header("Location: ../all_users.php");
		}
	}
	
		

	
}else if (isset($_POST["action"])){
	$adminid = $_POST["adminid"];
	$sql = "DELETE FROM `admins` WHERE `AdminID` = '$adminid';";
	$connect->query($sql);
	header("Location: ../all_admins.php");
}else{
	header("Location: ../index.php");
}