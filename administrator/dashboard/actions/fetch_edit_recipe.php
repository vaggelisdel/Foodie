<?php
  
  require_once '../../../connection.php';
  	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
  
	if ($_SESSION['admin_authorised'] == 1){
  // begin << materials to recipe >>
  
	if ($_POST["action"] == "Load")
	{
		$recipeid = $_POST['recipeid'];
		
		echo "<table class='table table-striped recipe_materials'>
                  <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Note</th>
                    <th width='10%'>Action</th>
                  </tr>";

				$query = $connect->query("SELECT * FROM quantity WHERE `RecipeID` ='$recipeid' ORDER BY QuantityID ASC");

				while($row = $query->fetch_assoc()) 
				{

				echo "<tr>
                    <td>".$row['Name']."</td>
                    <td>".$row['Quantity']."</td>
                    <td>".$row['Note']."</td>
                    <td><center><button type='button' value='".$row['QuantityID']."' class='btn btn-block btn-outline-primary btn-sm delete'>Delete</button></center></td>
                  </tr>";
				
				} 
				echo "</table>";
	}
  

	if ($_POST["action"] == "Insert")
	{
		  $recipeid = $_POST['recipeid'];
		  $material = $connect->escape_string($_POST['material']);
		  $quantity = $connect->escape_string($_POST['quantity']);
		  $note = $connect->escape_string($_POST['note']);

		  $result = $connect->query("SELECT * FROM quantity WHERE `RecipeID`='$recipeid' AND `Name` = '$material'");
		  if ( $result->num_rows == 0 ) {
			  $query="INSERT INTO quantity (RecipeID, Name, Quantity, Note) VALUES ('$recipeid', '$material', '$quantity', '$note') ";
			  $output=mysqli_query($connect,$query);
			  
			  $query="SELECT TotalMaterials FROM recipes WHERE RecipeID = '$recipeid' ";
			  $output1=mysqli_query($connect,$query);
			  $select = mysqli_fetch_array($output1);
			  $totalmaterials = $select["TotalMaterials"];
			  
			  $query="UPDATE recipes SET TotalMaterials = '$totalmaterials'+1 WHERE RecipeID = '$recipeid'";
			  $output2=mysqli_query($connect,$query);
		  }
	}	
	
	
	if ($_POST["action"] == "Delete")
	{
		  $quantityid = $_POST['quantityid'];

		  $query="SELECT * FROM quantity WHERE QuantityID = '$quantityid' ";
		  $output1=mysqli_query($connect,$query);
		  $select = mysqli_fetch_array($output1);
		  $recipeid = $select["RecipeID"];
		  
		  $query1="SELECT * FROM recipes WHERE RecipeID = '$recipeid' ";
		  $output2=mysqli_query($connect,$query1);
		  $select1 = mysqli_fetch_array($output2);
		  $totalmaterials = $select1["TotalMaterials"];
		  
		  $query2="UPDATE recipes SET TotalMaterials = '$totalmaterials'-1 WHERE RecipeID = '$recipeid'";
		  $output3=mysqli_query($connect,$query2);
		  
		  $query3="DELETE FROM quantity WHERE QuantityID = '$quantityid'";
		  $output4=mysqli_query($connect,$query3);

	}	

	
	
	if ($_POST["action"] == "Remove_thumbnail")
	{
		  $current_thumbnail = $_POST['current_thumbnail'];
		  
		  $query="UPDATE recipes SET Thumbnail = 'images/dishes/emptydish.jpg' WHERE Thumbnail = '$current_thumbnail'";
		  $output=mysqli_query($connect,$query);
		  
		  if ($current_thumbnail != "images/dishes/emptydish.jpg"){
			  $prev_thumbnail = '../../../'.$current_thumbnail;
			  unlink ($prev_thumbnail);
		  }

	}	

	// end << materials to recipe >>
	
	}else{
		header("Location: ../index.php");
	}

?>