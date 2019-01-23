<?php

	require 'connection.php';
	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1) {
    $userid = $_SESSION['userid'];

    $user_details = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
    $user = $user_details->fetch_assoc();
}

	if (isset($_GET["recipeid"])){
		$recipeid = $_GET["recipeid"];
	}
	if (isset($_GET["recipeid"])){
		$recipeid = $_GET["recipeid"];
	}
	if (isset($_GET["percent"])){
		$percent = $_GET["percent"]."%";
	}
?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Food Recipe a hotel Category Flat Bootstrap Responsive Website Template | Contact :: w3layouts</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Food Recipe a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->

<!-- font-awesome-icons -->
<link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- //font-awesome-icons -->

<!-- google fonts -->
<link href="//fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- //google fonts -->

</head>
	
<body>


<div class="banner-header banner2 recipepage">
	<div class="banner-dott1 recipepage">
		<!--header-->
		<div class="header">
		<div class="container-fluid">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="w3_navigation_pos">
						<a href="."><img src="images/logo1.png" class="logoimg" alt=""/></a>
					</div>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav>
						<ul class="nav navbar-nav">
							<li><a href="index.php">Αρχικη</a></li>
							<li><a href="about.html">Σχετικα με εμας</a></li>
							<li><a href="gallery.html">Γκαλερι</a></li>
							<li><a href="contact.html">Επικοινωνια</a></li>
                            <?php
                            if ($_SESSION['user_authorized'] == 1) {
                                ?>
                                <li class="login_register_btn profile_options">
                                    <a><?= $user['Name'] ?> <?= $user['Surname'] ?></a>
                                    <div class="dropdown-content">
                                        <a href="users/dashboard">Πίνακας ελέγχου</a>
                                        <a href="users/login/logout.php">Αποσύνδεση</a>
                                    </div>

                                </li>

                                <?php
                            } else {
                                ?>
                                <li class="login_register_btn"><a href="users/login">Συνδεση / Εγγραφη</a></li>
                                <?php
                            }
                            ?>
						</ul>
					</nav>
				</div>
			</nav>	
		</div>
	</div>
		<!--//header-->
	</div>
</div>
<!-- // banner -->




<?php
	$result_rec = $connect->query("SELECT * FROM recipes WHERE `RecipeID` ='$recipeid'");
	$recipe = $result_rec->fetch_assoc();
	
	$adminid = $recipe['AdminID'];
	$userid = $recipe['UserID'];
	
	$result_adm = $connect->query("SELECT * FROM admins WHERE `AdminID` ='$adminid'");
	$admin = $result_adm->fetch_assoc();
	
	$result_user = $connect->query("SELECT * FROM users WHERE `UserID` ='$userid'");
	$user = $result_user->fetch_assoc();
	
	$result_materials = $connect->query("SELECT * FROM quantity WHERE `RecipeID` ='$recipeid'");
	
	$result_steps = $connect->query("SELECT DISTINCT(Performance) FROM steps WHERE `RecipeID` ='$recipeid'");
	
	
?>

<div class="container-panel">

<div class="col-sm-8 recipeinfo_left">
	<div class="leftcolumn">
		<div class="recipe_header">
			<div class="panel_recipe_title">
				<h3><?= $recipe['Title'] ?></h3>
			</div>
			<div class="panel_recipe_date">
				<span>Ημερομηνία δημιουργίας: <?= $recipe['CreatedDate'] ?></span>
			</div>
		</div>
		<div class="panel_recipe_image">
			<img src="<?= $recipe['Thumbnail'] ?>"/>
		</div>
		<div class="panel_recipe_description">
			<p><?= $recipe['Description'] ?></p>
		</div>
		<hr>
		<div class="main_recipe_panel">
		<div class="all-steps col-sm-7">
			<i class="fa fa-ellipsis-v"> Βήματα</i>
			
			
			
			
				<?php
				while($steps = mysqli_fetch_array($result_steps)) 
				{
					$cur_performance = $steps['Performance'];
					$query111 = $connect->query("SELECT * FROM steps WHERE `RecipeID` ='$recipeid' AND `Performance` = '$cur_performance'");
					
					?>
					<div class="performances">
						<div class="perf_title"><?= $cur_performance; ?></div>
					<?php
					
					while($steps_perf = mysqli_fetch_array($query111)) 
					{
				?>
					<div class="step_by_step chiller_cb material col-sm-12">
						<input id="<?= $steps_perf["Description"]; ?>" value="<?= $steps_perf["Description"]; ?>" name="check_list[]" type="checkbox">
						<label for="<?= $steps_perf["Description"]; ?>"><?= $steps_perf["CurrentStep"]; ?></label>
						<label for="<?= $steps_perf["Description"]; ?>"><?= $steps_perf["Description"]; ?></label>
						<span></span>
					</div>
				<?php
					}
					?>
					</div>
					<?php
				}
				?>
			</div>
			<div class="panel_recipe_materials col-sm-5">
			<i class="fa fa-shopping-basket"> Υλικά</i>
				<?php
				$flag = 0;
				while($materials = mysqli_fetch_array($result_materials)) 
				{
					if(!empty($_GET['check_list'])){
						foreach($_GET['check_list'] as $selected){
							if ($materials["Name"] == $selected){
								$flag = 1;
							?>
								<div class="chiller_cb material col-sm-12">
									<input disabled id="<?= $materials["Name"]; ?>" value="<?= $materials["Name"]; ?>" checked name="check_list[]" type="checkbox">
									<label style="text-decoration: line-through;" for="<?= $materials["Name"]; ?>"><?= $materials["Name"]; ?></label>
									<span></span>
								</div>
							<?php
							}
						}
					}
					if ($flag == 0){
						?>
						<div class="chiller_cb material col-sm-12">
							<input id="<?= $materials["Name"]; ?>" value="<?= $materials["Name"]; ?>" name="check_list[]" type="checkbox">
							<label for="<?= $materials["Name"]; ?>"><?= $materials["Name"]; ?></label>
							<span></span>
						</div>	
						<?php
					}else{
						$flag = 0;
						continue;
					}
				}
				?>
			</div>
			
			
		</div>
	</div>
</div>



<div class="col-sm-4 recipeinfo_right">
	<div class="rightcolumn">
		<!-- <div class="panel_recipe_owner">
			<?php
			if ($recipe['AdminID'] == "" OR $recipe['AdminID'] == NULL){
				?>
				<h3><?= $user['Name']." ". $user['Surname']?></h3>
				<?php
			}else{
				?>
				<h3><?= $admin['Name']." ". $admin['Surname']?></h3>
				<?php
			}
			?>
			
		</div> -->
		<div class="panel_random_recipes">
			<h4>Προτεινόμενες συνταγές</h4>
			<?php
			$random="SELECT COUNT(QuantityID) AS count_materials, RecipeID FROM quantity GROUP BY RecipeID";
			$output = mysqli_query($connect, $random);
				

			$random="SELECT (COUNT(quantity.RecipeID)/recipes.TotalMaterials)*100 AS percent, quantity.RecipeID, recipes.*
					FROM quantity
					INNER JOIN recipes ON quantity.RecipeID = recipes.RecipeID
					WHERE (quantity.Name = '' ";

			
			if(!empty($_GET['check_list'])){
			// Loop to store and display values of individual checked checkbox.
				foreach($_GET['check_list'] as $selected){
					$random .="OR quantity.Name = '$selected' ";	
				}
			}
			
			$random .= ") AND (recipes.RecipeID <> '$recipeid') GROUP BY quantity.RecipeID
					   ORDER BY rand() LIMIT 3 ";
			
			$output_random = mysqli_query($connect, $random);


			while($random = mysqli_fetch_array($output_random)) 
			{
				
				?>
			<form action="recipe.php" method="GET">
				<div class="r_recipe">
					<a onclick="$(this).closest('form').submit()">
						<div class="img_random">
							<img src="<?= $random["Thumbnail"] ?>"/>
						</div>
					</a>
					<a onclick="$(this).closest('form').submit()">
						<div class="random_title"><?= $random["Title"] ?></div>
					</a>
					<footer class="recipe_footer">
						<div class="recipe_time">
							<i class="fa fa-clock-o"></i><span> <?= $random["Time"] ?></span>
						</div>
						<div class="recipe_cost">
							<i class="fa fa-money"></i><span> <?= ltrim($random["Cost"], 0) ?>&euro;</span>
						</div>
						<div class="recipe_percent">
							<i class="fa fa-shopping-basket"></i><span> <?= round($random["percent"],0) ?>%</span>
						</div>
					</footer>
				</div>
				
				<input type="hidden" name="recipeid" value="<?= $random["RecipeID"] ?>"/>
				<input type="hidden" name="percent" value="<?= round($random["percent"],0) ?>"/>
				<?php
				foreach($_GET['check_list'] as $selected){
				?>
					<input value="<?= $selected; ?>" name="check_list[]" type="hidden">
				<?php
					}
			?>
			</form>	
			<?php
			}
			?>
		</div>
		
	</div>
</div>
<?php
// if(!empty($_GET['check_list'])){
	// echo $percent."<br>";

	// foreach($_GET['check_list'] as $selected){
		// echo $selected."<br>";	
	// }
	
// }
// $query ="SELECT * FROM recipes WHERE RecipeID = '$recipeid' ";  
// $result_materials = mysqli_query($connect, $query);

// while($row = mysqli_fetch_array($result_materials)) 
// {
	// echo $row["Title"];
// }
?>

</div>





<!-- start-smoth-scrolling -->
<script src="js/SmoothScroll.min.js"></script>

<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>

	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->

<script>
    var profile_options = $('.profile_options').width();
    $('.dropdown-content').width(profile_options);
</script>

</body>
</html>