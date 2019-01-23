<?php
require '../../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["answer_click_btn"])) {
	
	$userid = $_POST["userid"];
	$ownerid = $_POST["ownerid"];
	$recipeid = $_POST["recipeid"];
    $answer_review = $_POST["answer_review"];

		$sql = "";
		$connect->query($sql);

		header("Location: ../feedback.php");
}else{
	header("Location: ../index.php");
}