<?php

	require 'connection.php';
	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1) {
    $user_authorized = $_SESSION['user_authorized'];
    $userid = $_SESSION['userid'];

    $user_details = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
    $user = $user_details->fetch_assoc();
}

if (isset($_GET["search_recipes_btn"])){
	
	
	$query="SELECT COUNT(QuantityID) AS count_materials, RecipeID FROM quantity GROUP BY RecipeID";
		$output = mysqli_query($connect, $query);
		

	$query="SELECT (COUNT(quantity.RecipeID)/recipes.TotalMaterials)*100 AS percent, quantity.RecipeID, recipes.*
			FROM quantity
			INNER JOIN recipes ON quantity.RecipeID = recipes.RecipeID
			WHERE quantity.Name = '' ";

	
	if(!empty($_GET['check_list'])){
	// Loop to store and display values of individual checked checkbox.
		foreach($_GET['check_list'] as $selected){
			$query .="OR quantity.Name = '$selected' ";	
		}
	}
	
	$query .= "GROUP BY quantity.RecipeID
	           ORDER BY percent DESC";
	
	$output1 = mysqli_query($connect, $query);
}else{
	header("Location: index.php");
}



	$query ="SELECT * FROM materials";  
	$result_materials = mysqli_query($connect, $query);

	
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
<title>Food Recipe a hotel Category Flat Bootstrap Responsive Website Template | About :: w3layouts</title>
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
	
<body id="body_recipes">


<div class="banner-header banner2">
	<div class="banner-dott1">
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






<!-- Modal extra materials-->
  <div class="modal fade" id="allmaterials" role="dialog">
    <div class="modal-dialog materials_modal mat_modal">
    
      <div class="modal-content mat_content">
        <div class="modal-header mat_header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Επιλέξτε τα υλικά της κουζίνας σας:</h4>
        </div>
	<form action="" method="GET">
        <div class="modal-body">
			
        <div class="allmetarials_modal">
			
        <div class="col-sm-12 separate_line">
				<input type="text" id="myInput" onkeyup="searchMaterials()" autocomplete="off" placeholder="Αναζήτηση υλικών"/>
		</div>
		<hr>
		
		<div class="all_of_materials" id="all_of_materials">
		<?php  
		$flag = 0;
			while($row = mysqli_fetch_array($result_materials)) 
				{
					if(!empty($_GET['check_list'])){
						foreach($_GET['check_list'] as $selected){
							if ($row["Name"] == $selected){
								$flag = 1;
							?>
								<div class="chiller_cb material col-sm-3">
									<input id="<?= $row["Name"]; ?>" value="<?= $row["Name"]; ?>" checked name="check_list[]" type="checkbox">
									<label for="<?= $row["Name"]; ?>"><?= $row["Name"]; ?></label>
									<span></span>
								</div>
							<?php
							}
						}
					}
					if ($flag == 0){
						?>
						<div class="chiller_cb material col-sm-3">
							<input id="<?= $row["Name"]; ?>" value="<?= $row["Name"]; ?>" name="check_list[]" type="checkbox">
							<label for="<?= $row["Name"]; ?>"><?= $row["Name"]; ?></label>
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
		<div class="modal-footer">
			<button name="search_recipes_btn" class="btn btn-danger search_recipes_btn">Αναζήτηση συνταγών</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>
  
  

<br>
<div class="col-sm-3 filter_panel">
	<section class="plan cf">
		<h3>Ταξινόμηση :</h3>
		<select class="sorting_list" id="fetchval">
			<optgroup label="Ποσοστό υλικών">
				<option selected value="percent_mat_desc">Ποσοστό υλικών: Φθίνουσα</option>
				<option value="percent_mat_asc">Ποσοστό υλικών: Αύξουσα</option>
			</optgroup>
			<optgroup label="Χρόνος">
				<option value="time_desc">Χρόνος: Φθίνουσα</option>
				<option value="time_asc">Χρόνος: Αύξουσα</option>
			</optgroup>
			<optgroup label="Τιμή">
				<option value="cost_desc">Τιμή: Φθίνουσα</option>
				<option value="cost_asc">Τιμή: Αύξουσα</option>
			</optgroup>
			<optgroup label="Διάφορα">
				<option value="added_recently">Προστέθηκαν Πρόσφατα</option>
				<option value="alphabetical_sort">A-Z Ταξινόμηση</option>
			</optgroup>
		</select>
	</section><br><br>
	
	<section class="plan cf">
	<h3>Τα υλικά σας :</h3>
	<ul class="selected_materials_ul">
		<?php
			if(!empty($_GET['check_list'])){
			// Loop to store and display values of individual checked checkbox.
				foreach($_GET['check_list'] as $selected){
					?>
					<li><?= $selected ?></li>
					<?php
				}
			}
		?>
	</ul>
		<button class="btn btn-danger extra_materials" data-toggle="modal" data-target="#allmaterials">Επεξεργασία υλικών</button>
	</section><br>
	
</div>
<div class="col-sm-9">
<div id="preload">
	<div class="row">
			<div class="recipe">
				<aside class="recipe_image">
					<div class="item_image_pre" style="background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;"/>
				</aside>
				<div class="recipe_dish">
					<header>
					<h3 class="recipe-title" style="width: 50%;height: 30px;background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;"></h3>
				</header>
				<section>
					<p class="recipe-description" style="width: 100%;height: 17px;background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;"></p>
					<p class="recipe-description" style="width: 85%;height: 17px;background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;"></p>
					<p class="recipe-description" style="width: 70%;height: 17px;background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;"></p>
				</section>
				<footer class="recipe_footer" style="border-top: 1px solid #e4e4e4;">
					<div class="recipe_time" style="background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;height: 30px;">
					</div>
					<div class="recipe_cost" style="background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;height: 30px;">
					</div>
					<div class="recipe_percent" style="background: #e4e4e4;animation-name: example;animation-duration: 3s;animation-timing-function: ease-in;animation-iteration-count: infinite;animation-direction: alternate;height: 30px;">
					</div>
				</footer>
				</div>
		</div>
	</div>
</div>
	
<div id="all_recipes" style="display:none;">
<?php if ($output1->num_rows == 0){
?>
	<center><span>Δεν βρέθηκαν συνταγές</span></center>
<?php
}
?>
<?php

	while($row = mysqli_fetch_array($output1))  
	{
		if ( $user_authorized == 1 ) {
			$recipeid = $row["RecipeID"];
			$result_wishlist = $connect->query("SELECT * FROM wishlist WHERE RecipeID = '$recipeid' AND UserID = '$userid'");  
			
		}
?>

<form action="recipe.php" method="GET">
<div class="row">
		<div class="recipe">
			<aside class="recipe_image">
				<a class="img_recipe_a" onclick="$(this).closest('form').submit()"><img class="item_image" src="<?= $row["Thumbnail"] ?>"/></a>
			</aside>
			<div class="recipe_dish">
				<?php
				if ( $user_authorized == 1 ) {
					if ( $result_wishlist->num_rows > 0 ) {
				?>
						<i value="<?= $row["RecipeID"] ?>" id="<?= $row["RecipeID"] ?>" class="iconheart fa fa-heart" style="color:#e63939;"></i>
				<?php
					}else{
				?>
						<i value="<?= $row["RecipeID"] ?>" id="<?= $row["RecipeID"] ?>" class="iconheart fa fa-heart"></i>
				<?php
					}
				}else{
				?>
						<i value="<?= $row["RecipeID"] ?>" id="<?= $row["RecipeID"] ?>" class="iconheart fa fa-heart"></i>
				<?php
				}
				?>
				<header>
                <h3><a onclick="$(this).closest('form').submit()"><?= $row["Title"] ?></h3></a>
            </header>
            <section>
				<p class="recipe-description"><?= $row["Description"] ?></p>
			</section>
            <footer class="recipe_footer">
				<div class="recipe_time">
		            <i class="fa fa-clock-o"></i><span> <?= $row["Time"] ?></span>
		        </div>
				<div class="recipe_cost">
		            <i class="fa fa-money"></i><span> <?= ltrim($row["Cost"], 0) ?>&euro;</span>
		        </div>
				<div class="recipe_percent">
		            <i class="fa fa-shopping-basket"></i><span> <?= round($row["percent"],0) ?>%</span>
		        </div>
            </footer>
			
			<!-- this inputs will send to recipe.php -->
			<input type="hidden" name="recipeid" value="<?= $row["RecipeID"] ?>"/>
			<input type="hidden" name="percent" value="<?= round($row["percent"],0) ?>"/>
			<?php  
				if(!empty($_GET['check_list'])){
			// Loop to store and display values of individual checked checkbox.
				foreach($_GET['check_list'] as $selected){
			?>
					<input value="<?= $selected; ?>" name="check_list[]" type="hidden">
			<?php
				}
				}
			?>
			</div>
		</div>
	</div>
</form>

<?php 
	}

?>
</div>

</div>
<!-- Footer -->	
<?php
if(!empty($_GET['check_list'])){
	foreach($_GET['check_list'] as $selected){
		$new[] = $selected;
	}
	$js_array= '["'. join('","', $new) .'"]';
}
?>

<!-- start-smoth-scrolling -->
<script src="js/SmoothScroll.min.js"></script>
<script>
setTimeout(
	function() 
	{
		document.getElementById("preload").style.display = "none";
		$( "#all_recipes" ).fadeToggle(1200);
	}, 1700);
</script>
<script>
$(document).on('click', '.iconheart', function(){
	var recipeid = $(this).attr("value");
	var userid = <?= $userid; ?>;
	var action = "Check";
	
	if (<?= $user_authorized ?> == "0"){
		$('#login').modal('show');
	}else{
		$.ajax(
				{
					url:'fetch_wishlist.php',
					type:'POST',
					data:'recipeid=' + recipeid + '&userid=' + userid + '&action=' + action,
					dataType:'html',

					success:function(data)
					{
						if (data == "1"){
							document.getElementById(recipeid).style.color = "#c7c7c7";
						}else if (data == "2"){
							document.getElementById(recipeid).style.color = "#e63939";
						}
					},
				});
	}
});
</script>

<script>
function searchMaterials() {
    var input, filter, all_of_materials, chiller, label, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    all_of_materials = document.getElementById("all_of_materials");
    chiller = all_of_materials.getElementsByTagName("div");
    for (i = 0; i < chiller.length; i++) {
        label = chiller[i].getElementsByTagName("label")[0];
        if (label.innerHTML.toUpperCase().indexOf(filter) > -1) {
            chiller[i].style.display = "";
        } else {
            chiller[i].style.display = "none";
        }
    }
}
</script>

<script>
$("#fetchval").change(function(){			   
	run_ajax_fetch();
});	

var check_list = <?php echo $js_array;?>;

function run_ajax_fetch(){
	$.ajax(
            {
                url:'fetch.php',
                type:'POST',
                data:{'check_list': check_list, 'fetchval': fetchval.value},
				dataType:'html',
                
                beforeSend:function()
                {	
                    $("#all_recipes").html('');
					document.getElementById("preload").style.display = "inline";
					document.getElementById("all_recipes").style.display = "none";
					setTimeout(
						function() 
						{
							document.getElementById("preload").style.display = "none";
						}, 500);
					},
					
                success:function(data)
                {
					setTimeout(
						function() 
						{
							$( "#all_recipes" ).fadeToggle(800);
							$("#all_recipes").html(data);
						}, 500);
                    
                },
            });	
}
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