<?php
  
  require_once '../../../connection.php';
  	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	if ($_SESSION['admin_authorised'] == 1){
  
  	if($_POST["action"] == "Select")
	{
		$feedbackid = $_POST["feedbackid"];
		
		$query = $connect->query("SELECT users.*, recipes.*, feedback.* FROM users, recipes, feedback WHERE users.UserID = feedback.UserID AND recipes.RecipeID = feedback.RecipeID AND feedback.FeedBackID = '$feedbackid'");
		$feedback = $query->fetch_assoc();
		
		  $values = array('FeedBackID' => $feedback["FeedBackID"], 'Score' => $feedback["Score"], 'Difficulty' => $feedback["Difficulty"], 'Review' => $feedback["Review"], 'Date' => $feedback["Date"], 'Recipe' => $feedback["Title"], 'User' => $feedback["Name"], 'Surname' => $feedback["Surname"]);
		  echo json_encode($values);  
	}
	
	}else{
		header("Location: ../index.php");
	}
?>