<?php
  
  require_once '../../../connection.php';
  	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	
	if ($_SESSION['admin_authorised'] == 1){
  
  // begin << materials to recipe >>
  
	if ($_POST["action"] == "Load")
	{		
				$query = $connect->query("SELECT * FROM todolist ORDER BY CreatedDate DESC LIMIT 7");

				while($row = $query->fetch_assoc()) 
				{

				echo "<li>";
							if ($row['Active'] == 1){
				echo			"<input type='checkbox' class='activebtn' value='".$row['ToDoListID']."' id='".$row['ToDoListID']."' name=''>
								<small class='badge badge-warning'><i class='fa fa-clock-o'></i> ".$row['CreatedDate']."</small>
								<span class='text'>".$row["Description"]."</span>";
							}else{
				echo			"<input type='checkbox' checked class='activebtn' value='".$row['ToDoListID']."' id='".$row['ToDoListID']."' name=''>
								<small class='badge badge-warning'><i class='fa fa-clock-o'></i> ".$row['CreatedDate']."</small>
								<span class='text' style='text-decoration: line-through;'>".$row['Description']."</span>";
							}
				echo		"<div class='tools'>
							<i class='fa fa-trash-o deleteitem' value='".$row['ToDoListID']."'></i>
						</div>
					</li>";
				
				} 
	}
  

	if ($_POST["action"] == "Insert")
	{
		  $description_item = $connect->escape_string($_POST['description_item']);
		  $adminid = $_POST['adminid'];

		  $query="INSERT INTO todolist (AdminID, Description) VALUES ('$adminid', '$description_item')";
		  
		  
		  $output=mysqli_query($connect,$query);
		  

	}	
	
	
	if ($_POST["action"] == "Delete")
	{
		  $todolistid = $_POST['todolistid'];

		  $query="DELETE FROM todolist WHERE ToDoListID = '$todolistid'";
		  
		  
		  $output=mysqli_query($connect,$query);
		  

	}
	
	
	
	if ($_POST["action"] == "Status")
	{
		  $todolistid = $_POST['todolistid'];
		  $status = $_POST['status'];

		  $query="UPDATE todolist SET Active = '$status' WHERE ToDoListID = '$todolistid'";
		  
		  
		  $output=mysqli_query($connect,$query);
		  

	}	

	// end << materials to recipe >>
	
	}else{
		header("Location: ../index.php");
	}

?>