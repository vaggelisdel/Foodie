<?php

	require '../../connection.php';
	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);


?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html id="login_bg" lang="en">
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
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script>
<!-- //js -->

<!-- font-awesome-icons -->
<link rel="stylesheet" href="../../css/font-awesome.min.css" />
<!-- //font-awesome-icons -->



<!-- google fonts -->
<link href="//fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- //google fonts -->

</head>
	
<body id="login_body_bg">


<div class="banner-header recipepage">
	<div class="recipepage">
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
						<a href="../../"><img src="../../images/logo1.png" class="logoimg" alt=""/></a>
					</div>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav>
						<ul class="nav navbar-nav">
							<li><a href="../../index.php">Αρχικη</a></li>
							<li><a href="../../about.html">Σχετικα με εμας</a></li>
							<li><a href="../../gallery.html">Γκαλερι</a></li>
							<li><a href="../../contact.html">Επικοινωνια</a></li>
							<li class="login_register_btn" style="display:none;"><a href=".">Συνδεση / Εγγραφη</a></li>
						</ul>
					</nav>
				</div>
			</nav>	
		</div>
	</div>
		<!--//header-->
	</div>
	</div>
</div>
<!-- // banner -->

	
<div class="alertpanel">
	<center>
		<div class="alert alert-dark alertphp" role="alert">
			<i class="icon fa fa-bell"></i> &nbsp; <?php echo $_SESSION["user_message"] ?>
		</div>
		<a href="index.php" class="btn btn-danger">Επιστροφή</a>
	</center>
</div>     



<!-- Footer -->	

<!-- start-smoth-scrolling -->
<script src="../../js/SmoothScroll.min.js"></script>

	<script src="../../js/bootstrap.js"></script>
<!-- //for bootstrap working -->

</body>
</html>