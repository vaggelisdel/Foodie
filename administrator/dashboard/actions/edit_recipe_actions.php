<?php
require '../../../connection.php';
session_name("session3");
session_start();

if (isset($_POST["save_recipe_changes_btn"])){
	$recipeid = $_POST["recipeid"];
	$recipe_name = $connect->escape_string($_POST["recipe_name"]);
	$recipe_time = $connect->escape_string($_POST["recipe_time"]);
	$recipe_dishes = $connect->escape_string($_POST["recipe_dishes"]);
	
	$cost = $connect->escape_string($_POST["recipe_cost"]);
	$recipe_cost = substr($cost, 0, 5);
	
	$recipe_description = $connect->escape_string($_POST["recipe_description"]);
	$sql = "UPDATE `recipes` SET Title = '$recipe_name', Time = '$recipe_time', Cost = '$recipe_cost', NoDishes = '$recipe_dishes', Description = '$recipe_description' WHERE `RecipeID` = '$recipeid';";
	$connect->query($sql);
	
	
	$prev_thumbnail = '../../'.$_POST["prev_thumbnail"];
	$file = $_FILES['file'];
	
	if ($file != ""){
		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png');

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 3000000) {
					$fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileDestination = '../../../images/dishes/'.$fileNameNew;
					$filedest = 'images/dishes/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					
					
					function compress_image($source_url, $destination_url, $quality) {
						$info = getimagesize($source_url);
					 
						if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
						elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
						elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
					 
						//save it
						imagejpeg($image, $destination_url, $quality);
					 
						//return destination file url
						return $destination_url;
						}
						 
						$source_photo = $fileDestination;
						 
						$d = compress_image($source_photo, $source_photo, 50);
					
					
					$result = $connect->query("UPDATE recipes SET Thumbnail = '$filedest' WHERE RecipeID = '$recipeid';");
					if ($prev_thumbnail != "../../../images/dishes/emptydish.jpg"){
						unlink ($prev_thumbnail);
					}
				} else {
					$_SESSION["msg"] = "Your file is too big!";
				}
			} else {
				$_SESSION["msg"] = "There was an error uploading your file!";
			}
		} else {
			$_SESSION["msg"] = "You cannot upload files of this type!";
		}
	}

	
	
	
	header("Location: ../all_recipes.php");
	
}else if (isset($_POST["deleteinput"])){
	$recipeid = $_POST["recipeid"];
	$prev_thumbnail = '../../../'.$_POST["prev_thumbnail"];
	
	$sql = "DELETE FROM `quantity` WHERE `RecipeID` = '$recipeid';";
	$connect->query($sql);
	
	if ($prev_thumbnail != "../../../images/dishes/emptydish.jpg"){
		unlink ($prev_thumbnail);
	}
	
	$sql = "DELETE FROM `steps` WHERE `RecipeID` = '$recipeid';";
	$connect->query($sql);
	
	$sql = "DELETE FROM `recipes` WHERE `RecipeID` = '$recipeid';";
	$connect->query($sql);
	
	header("Location: ../all_recipes.php");
	
}else{
	header("Location: ../index.php");
}