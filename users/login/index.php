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

	

		<div class="col-lg-8 col-lg-offset-2 login-box" >
		
		
		<div class="col-lg-6 cover" style="transform:translateX(100%);">
			<img src="../../images/dott.png"/>
        		<h1>Καλώς όρισες στο Foodie</h1>
        		<p id="intro_text">Εάν δεν έχεις εγγραφεί ακόμα στο Foodie; Κάντο τώρα πατώντας το κουμπί εγγραφή.</p>
        		<br>
				<center>
					<button class="gotobtns" id="gotologin" style="display:none;">Σύνδεση Χρήστη</button>
					<button class="gotobtns" id="gotoregister">Εγγραφή Χρήστη</button>
				</center>
            </div>
		    
			
			
		<form action="login.php" method="POST">
			<div class="col-lg-6 loginform">
    		<h1>Σύνδεση Χρήστη</h1>
	
                <div class="form">
            
				<input required class="input_hideo" type="email" name="email_login" placeholder="Ηλεκτρονική διεύθυνση" />
				<input required class="input_hideo" type="password" name="pass_login" placeholder="Κωδικός πρόσβασης" />

				<a class="forgot_link" href="forgotpass.php">Ξεχάσατε τον κωδικό πρόσβασης;</a>
            
                    <div class="login-button">
                        <button name="login_btn" class="btn_login_actions">Σύνδεση</button>
                    </div>
            
                </div>
 
	    	</div>  <!-- right-box -->
			
		</form>
		<form action="register.php" method="POST">	
    		<div class="col-lg-6 registerform">
    		<h1>Εγγραφή Χρήστη</h1>
	
                <div class="form">
            
					<input required class="input_hideo" type="text" name="name_register" placeholder="Όνομα χρήστη" />
					<input required class="input_hideo" type="text" name="surname_register" placeholder="Επώνυμο χρήστη" />
					<input required class="input_hideo" type="email" name="email_register" placeholder="Ηλεκτρονική διεύθυνση" />
					<input required class="input_hideo" type="password" name="password_register" placeholder="Κωδικός πρόσβασης" />

            
                    <div class="login-button">
                        <button name="register_btn" class="btn_login_actions">Εγγραφή</button>
                    </div>
            
                </div>
 
	    	</div>  <!-- right-box -->
		</form>
		</div> <!--col-lg-8-->
        



<!-- Footer -->	


<!-- start-smoth-scrolling -->
<script src="../../js/SmoothScroll.min.js"></script>

<script>
$("#gotologin").click(function() {
  document.getElementById("intro_text").innerHTML = "Εάν δεν έχεις εγγραφεί ακόμα στο Foodie; Κάντο τώρα πατώντας το κουμπί εγγραφή.";
  $("#gotoregister").css("display", "inherit");
  $("#gotologin").css("display", "none");
  $(".cover").css("transform", "translateX(100%)");
});

$("#gotoregister").click(function() {
  document.getElementById("intro_text").innerHTML = "Εάν ολοκλήρωσες την εγγραφή σου κάνε συνδεση τώρα πατώντας το κουμπί σύνδεση.";
  $("#gotologin").css("display", "inherit");
  $("#gotoregister").css("display", "none");
   $(".cover").css("transform", "translateX(0%)");
 
  
});

</script>

	<script src="../../js/bootstrap.js"></script>
<!-- //for bootstrap working -->

</body>
</html>