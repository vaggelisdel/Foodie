<?php
  
  require_once 'connection.php';

  	$query="SELECT COUNT(QuantityID) AS count_materials, RecipeID FROM quantity GROUP BY RecipeID";
		$output = mysqli_query($connect, $query);
		while($row = mysqli_fetch_array($output))  
		{
			$recipeid = $row["RecipeID"];
			$count_materials = $row["count_materials"];
			$query="UPDATE `recipes` SET `TotalMaterials`= '$count_materials' WHERE `RecipeID` = '$recipeid'";
			$update = mysqli_query($connect, $query);
		}
	
	
	$query="SELECT (COUNT(quantity.RecipeID)/recipes.TotalMaterials)*100 AS percent, quantity.RecipeID, recipes.*, COUNT(quantity.RecipeID) AS xaxa
			FROM quantity
			INNER JOIN recipes ON quantity.RecipeID = recipes.RecipeID
			WHERE quantity.Name = '' ";

	
	if(!empty($_POST['check_list'])){
	// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list'] as $selected){
			$query .="OR quantity.Name = '$selected' ";	
		}
	}
	
	$query .= "GROUP BY quantity.RecipeID ";
	
	$output1 = mysqli_query($connect, $query);
	
	  
  if (isset($_POST["fetchval"])){
	if ($_POST["fetchval"] == "percent_mat_asc"){
		$query .="ORDER BY percent ASC "; 
	}
	else if ($_POST["fetchval"] == "percent_mat_desc"){
		$query .="ORDER BY percent DESC ";    
	}  
	else if ($_POST["fetchval"] == "time_asc"){
		$query .="ORDER BY Time ASC ";    
	}  
	else if ($_POST["fetchval"] == "time_desc"){
		$query .="ORDER BY Time DESC ";    
	} 
	else if ($_POST["fetchval"] == "cost_asc"){
		$query .="ORDER BY Cost ASC ";    
	}   
	else if ($_POST["fetchval"] == "cost_desc"){
		$query .="ORDER BY Cost DESC ";    
	} 
	else if ($_POST["fetchval"] == "added_recently"){
		$query .="ORDER BY CreatedDate DESC ";    
	}   
	else if ($_POST["fetchval"] == "alphabetical_sort"){
		$query .="ORDER BY Title ASC ";    
	}   
	else{
	  $query .="ORDER BY percent DESC ";
	}
  }

  $output=mysqli_query($connect,$query);
  
			if ($output->num_rows == 0){
				echo '<center><span>No recipes found</span></center>';
			}
		  while($row = mysqli_fetch_assoc($output))
		  {
			  
		      echo '<div class="row">
						<div class="recipe">
							<aside class="recipe_image">
								<img class="item_image" src="'.$row["Thumbnail"].'"/>
							</aside>
							<div class="recipe_dish">
								<header>
								<h3 class="recipe-title">'.$row["Title"].'</h3>
							</header>
							<section>
								<p class="recipe-description">'.$row["Description"].'</p>
							</section>
							<footer class="recipe_footer">
								<div class="recipe_time">
									<i class="fa fa-clock-o"></i><span> '.$row["Time"].'</span>
								</div>
								<div class="recipe_cost">
									<i class="fa fa-money"></i><span> '.ltrim($row["Cost"], 0).'&euro;</span>
								</div>
								<div class="recipe_percent">
									<i class="fa fa-shopping-basket"></i><span> '.round($row["percent"],0).'%</span>
								</div>
							</footer>
							</div>
						</div>
					</div>';
		  }
 ?>