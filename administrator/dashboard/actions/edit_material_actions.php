<?php
require '../../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["edit_material_btn"])){
	
	$material_name = $connect->escape_string($_POST["material_name"]);
	$material_id = $_POST["material_id"];
	
		$sql = "UPDATE `materials` SET `Name` = '$material_name' WHERE `MaterialID` = '$material_id';";
		$connect->query($sql);
		$_SESSION['return_msg'] = "Material updated!";
		header("Location: ../all_materials.php");

		
}else if (isset($_POST["action"])) {
	
	$material_name = $connect->escape_string($_POST["material_name"]);
	$material_id = $_POST["material_id"];
	
		$sql = "DELETE FROM `materials` WHERE `Name` = '$material_name' AND `MaterialID` = '$material_id';";
		$connect->query($sql);
		$_SESSION['return_msg'] = "Material deleted!";
		header("Location: ../all_materials.php");
}else{
	header("Location: ../index.php");
}