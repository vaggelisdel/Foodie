<?php
require '../../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["action"])) {
	
	$feedbackID = $_POST["feedbackID"];
	
		$sql = "DELETE FROM `feedback` WHERE `FeedBackID` = '$feedbackID';";
		$connect->query($sql);
		header("Location: ../all_feedbacks.php");
}else{
	header("Location: ../index.php");
}