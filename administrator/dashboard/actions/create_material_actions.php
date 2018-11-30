<?php
require '../../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["create_material_btn"])){
	
	$material_name = $connect->escape_string($_POST["material_name"]);
	
		$sql = "INSERT INTO `materials` (`Name`) 
	                     VALUES ('$material_name');";
		$connect->query($sql);
		$_SESSION['return_msg'] = "Material created!";
		header("Location: ../all_materials.php");

}else{
	header("Location: ../index.php");
}