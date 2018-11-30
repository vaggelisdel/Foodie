<?php
  
  require_once '../../../connection.php';
  	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
  
	if ($_SESSION['admin_authorised'] == 1){
	
	// begin << steps to recipe >>
	
	if ($_POST["step_action"] == "Load")
	{
		$recipeid = $_POST['recipeid'];
		
				$query = $connect->query("SELECT * FROM steps WHERE `RecipeID` ='$recipeid' ORDER BY StepID ASC");

				while($row = $query->fetch_assoc()) 
				{

				echo "<li>
					<div class='tools'>
                      <i class='fa fa-edit editbtn' value='".$row['StepID']."'></i>
                      <i class='fa fa-trash-o trashbtn' value='".$row['StepID']."'></i>
                    </div>
                    <small class='badge badge-danger'>".$row['CurrentStep']."</small>
					<small id='perf' class='badge badge-success'>".$row['Performance']."</small>
                    <span class='text'>".$row['Description']."</span>
                  </li>";
				
				} 
	}
	
	
	if ($_POST["step_action"] == "Insert")
	{
		$recipeid = $_POST['recipeid'];
		$stepname = $connect->escape_string($_POST['stepname']);
		$performance = $connect->escape_string($_POST['performance']);
		$description_step = $connect->escape_string($_POST['description_step']);
		
		$query="INSERT INTO steps (RecipeID, CurrentStep, Description, Performance) VALUES ('$recipeid', '$stepname', '$description_step', '$performance') ";
		  
		  
		$output=mysqli_query($connect,$query);
	}
	
	
	
	if ($_POST["step_action"] == "Delete")
	{
		  $stepid = $_POST['stepid'];

		  $query="DELETE FROM steps WHERE StepID = '$stepid'";
		  
		  
		  $output=mysqli_query($connect,$query);
		  

	}	
	
	
	
	if ($_POST["step_action"] == "Select")
	{
		  $stepid = $_POST['stepid'];

		  $query = $connect->query("SELECT * FROM steps WHERE StepID = '$stepid'");
		  $step = $query->fetch_assoc();
		
		  $values = array('StepID' => $step["StepID"], 'CurrentStep' => $step["CurrentStep"], 'Description' => $step["Description"], 'Performance' => $step["Performance"]);

		  echo json_encode($values);  
		  

	}
	
	
	
	if ($_POST["step_action"] == "Update")
	{
		  $stepid = $_POST['stepid'];
		  $stepname = $connect->escape_string($_POST['stepname']);
		  $performance = $connect->escape_string($_POST['performance']);
		  $description_step = $connect->escape_string($_POST['description_step']);

		  $query="UPDATE steps SET CurrentStep = '$stepname', Description = '$description_step', Performance = '$performance' WHERE StepID = '$stepid'";
		  
		  
		  $output=mysqli_query($connect,$query);  
		  

	}
	
	// end << steps to recipe >>
	
	}else{
		header("Location: ../index.php");
	}

?>