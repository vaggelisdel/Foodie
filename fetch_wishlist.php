<?php
  
  require_once 'connection.php';
  	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
  	
	
	if ($_POST["action"] == "Check")
	{
		$recipeid = $_POST['recipeid'];
		$userid = $_POST['userid'];
		
				$query = $connect->query("SELECT * FROM wishlist WHERE `RecipeID` ='$recipeid' AND `UserID` = '$userid'");

				if ( $query->num_rows > 0 ) {
					$sql = "DELETE FROM wishlist WHERE RecipeID = '$recipeid' AND UserID = '$userid'";
					$connect->query($sql);
					echo '1'; //do it black heart
				}else{
					$sql = "INSERT INTO `wishlist` (`UserID`, `RecipeID`) 
							VALUES ('$userid', '$recipeid');";
					$connect->query($sql);
					echo '2'; //do it red heart
				}
	}
?>