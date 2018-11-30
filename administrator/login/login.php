<?php
require '../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["signin_btn"])){
	$email = $connect->escape_string($_POST["email"]);
	$result = $connect->query("SELECT * FROM admins WHERE `Email`='$email'");

	if ( $result->num_rows == 0 ){ // User doesn't exist
		$_SESSION['message'] = "Admin with that email doesn't exist!";
		header("Location: index.php");
	}else{
		$admin = $result->fetch_assoc();
		
		if ( password_verify($_POST['password'], $admin['Password'])) {
			$adminid = $admin['AdminID'];
			
			$_SESSION['adminid'] = $adminid;
			$_SESSION['active'] = $admin['Active'];
			
			if ($_SESSION['active'] == 0){
				$_SESSION['message'] = "You are not authorised yet!";
				header("location: index.php");
			}else{				
				$_SESSION['admin_authorised'] = 1;
				header("location: ../dashboard");
			}
			
		}else{
			$_SESSION['message'] = "You have entered wrong password, try again!";
			header("Location: index.php");
		}
	}
}else{
	header("Location: index.php");
}