<?php 
/* Reset your password form, sends reset.php password link */
require '../../connection.php';
session_name("session3");
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $email = $connect->escape_string($_POST['email']);
    $result = $connect->query("SELECT * FROM users WHERE `Email` ='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['user_message'] = "Δεν βρέθηκε χρήστης με αυτό το email!";
        header("location: alert.php");
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data
        
        $email = $user['Email'];
        $hash = $user['Hash'];
        $name = $user['Name'];
		$surname = $user['Surname'];
		$domain = $_SERVER['SERVER_NAME'];

        // Session user_message to display on alert.php
        $_SESSION['user_message'] = "<p>Ελέγξτε στο email <span>$email</span>"
        . " για την επαναφορά του κωδικού πρόσβασής σας</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Επαναφορά κωδικού πρόσβασης';
        $message_body = '
        Χαίρεται '.$name.' '.$surname.',

        Ζητήσατε επαναφορά του κωδικού πρόσβασής σας!

        Πατήστε τον παρακάτω σύνδεσμο για την επαναφορά:

        http://'.$domain.'/users/login/reset.php?email='.$email.'&hash='.$hash;

        mail($to, $subject, $message_body);

        header("location: alert.php");
  }
}
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

<center>	
	<div class="forgot_form">

		<h1>Επαναφορά κωδικού πρόσβασης</h1>

		<form action="" method="post">
		 <div class="field-wrap">
		  <input type="email" required autocomplete="off" name="email" placeholder="Εισάγετε την ηλεκτρονική σας διεύθυνση"/>
		</div>
		<button class="btn btn-danger"/>Επαναφορά</button>
		</form>
	</div>
</center>


<!-- Footer -->	


<!-- start-smoth-scrolling -->
<script src="../../js/SmoothScroll.min.js"></script>

	<script src="../../js/bootstrap.js"></script>
<!-- //for bootstrap working -->

</body>
</html>