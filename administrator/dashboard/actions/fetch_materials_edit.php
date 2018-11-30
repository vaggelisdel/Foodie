<?php
  
  require_once '../../../connection.php';
  	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	
	if ($_SESSION['admin_authorised'] == 1){

  
  	if($_POST["action"] == "Select")
	{
		$matid = $_POST["matid"];
		
		$query = $connect->query("SELECT * FROM materials WHERE MaterialID = '".$matid."';");
		$material = $query->fetch_assoc();
		
		  $values = array('MaterialID' => $material["MaterialID"], 'MaterialName' => $material["Name"]);

		  echo json_encode($values);  
	}
	
	}else{
		header("Location: ../index.php");
	}
?>