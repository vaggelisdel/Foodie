<?php
require 'connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$query = "SELECT * FROM materials";
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
    <title>Food Recipe a hotel Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Food Recipe a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>

    <!-- //custom-theme -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>

    <!-- for banner css -->
    <link href="css/carousel.css" type="text/css" rel="stylesheet" media="all"><!-- carousel css -->
    <!-- //for banner css -->

    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all"/> <!-- Owl-Carousel-CSS -->

    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/><!-- Theme-CSS -->

    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property=""/><!-- Flexslider-CSS -->

    <!-- js -->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <!-- //js -->

    <!-- font-awesome-icons -->
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <!-- //font-awesome-icons -->

    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese"
          rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">

    <!-- //google fonts -->

</head>

<body>

<div class="banner-header">
    <!--header-->
    <div class="header">
        <div class="container-fluid">
            <nav class="navbar navbar-default">
                <div class="navbar-header navbar-left">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
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
                            <li class="active"><a href="index.html">Αρχικη</a></li>
                            <li><a href="about.html">Σχετικα με εμας</a></li>
                            <li><a href="gallery.html">Γκαλερι</a></li>
                            <li><a href="contact.html">Επικοινωνια</a></li>
                            <li class="login_register_btn"><a href="users/login">Συνδεση / Εγγραφη</a></li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
    </div>
    <!--//header-->
</div>


<!-- Modal create material-->
<div class="modal fade" id="allmaterials" role="dialog">
    <div class="modal-dialog materials_modal mat_modal">

        <div class="modal-content mat_content">
            <div class="modal-header mat_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Επιλέξτε τα υλικά της κουζίνας σας:</h4>
            </div>
            <form action="list_recipes.php" method="GET">
                <div class="modal-body">

                    <div class="allmetarials_modal">

                        <div class="col-sm-12 separate_line">
                            <input type="text" id="myInput" onkeyup="searchMaterials()" autocomplete="off"
                                   placeholder="Αναζήτηση υλικών"/>
                        </div>
                        <hr>

                        <div class="all_of_materials" id="all_of_materials">
                            <?php
                            while ($row = mysqli_fetch_array($result_materials)) {
                                ?>
                                <div class="chiller_cb material col-sm-3">
                                    <input id="<?= $row["Name"]; ?>" value="<?= $row["Name"]; ?>" name="check_list[]"
                                           type="checkbox">
                                    <label for="<?= $row["Name"]; ?>"><?= $row["Name"]; ?></label>
                                    <span></span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button name="search_recipes_btn" class="btn btn-danger search_recipes_btn">Αναζήτηση συνταγών
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- slider -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <!--		<ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            </ol> -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="banner-dott">
                <div class="container">
                    <div class="carousel-caption">
                        <h3>There's no sincerer love than</h3>
                        <h4>The Love of food</h4>
                        <div class="contrast">
                            <p> Επιλέξτε τα υλικά που έχετε στην κουζίνα σας και ξεκινήστε το μαγείρεμα.</p>
                        </div>
                        <center><a href="" class="choose_materials_btn" data-toggle="modal" data-target="#allmaterials">Επιλέξτε
                                τα υλικά σας</a></center>
                        <div class="thim-click-to-bottom">
                            <a href="#about" class="scroll">
                                <i class="fa  fa-chevron-down arrowdown"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="item item1">
                <div class="banner-dott">
                <div class="container">
                    <div class="carousel-caption">
                        <h3>Food is not rational</h3>
                        <h4>Food is a habit</h4>
                        <div class="contrast">
                              <p> Vestibulum ante ipsum primis in faucibus orci luctus et ultrices.</p>
                         </div>
                        <div class="thim-click-to-bottom">
                            <a href="#about" class="scroll">
                                <i class="fa  fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="item item2">
                <div class="banner-dott">
                <div class="container">
                    <div class="carousel-caption">
                        <h3>We saw on every street corner </h3>
                          <h4>and they're donuts</h4>
                          <div class="contrast">
                              <p> Vestibulum ante ipsum primis in faucibus orci luctus et ultrices.</p>
                          </div>
                        <div class="thim-click-to-bottom">
                            <a href="#about" class="scroll">
                                <i class="fa  fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div> -->

    </div>
    <!--<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>-->
</div>
<!-- //slider -->
<!-- // banner -->

<!-- banner bottom section -->
<div class="bannerbottom">
    <div class="container">
        <div class="bannerbottomgrids">
            <div class="col-md-6 bottomleft">
                <h5>we are special in</h5>
                <h3>making delicious dishes</h3>
                <p>Vestibulum ante ipsum primis in faucibus ante ipsum primis in faucibus orci luctus et orci luctus et
                    ultrices.faucibus orci luctus et ultrices lore ipsum dolor sit amet faucibus ante ipsum primis in
                    faucibus orci luctus</p>
                <div class="agile-services-left-grid">
                    <div class="services-icon">
                        <div class="col-md-2">
                            <div class="services-icon-info">
                                <i class="fa fa-glass" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-md-10 services-icon-text">
                            <h3>Maecenas cursus ligula</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Maecenas cursus ligula quis malesuada placerat. </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="services-icon">
                        <div class="col-md-2">
                            <div class="services-icon-info">
                                <i class="fa fa-cutlery" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-md-10 services-icon-text">
                            <h3>Maecenas cursus ligula</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Maecenas cursus ligula quis malesuada placerat. </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="services-icon">
                        <div class="col-md-2">
                            <div class="services-icon-info">
                                <i class="fa fa-spoon" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-md-10 services-icon-text">
                            <h3>Maecenas cursus ligula</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Maecenas cursus ligula quis malesuada placerat. </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-5 bottomright">
                <img src="images/bottom.jpg" alt=""/>
                <div class="positiongrid1">
                    <h4>Cooking is one of the great gifts you can give to your love</h4>
                </div>
                <div class="positiongrid2">
                    <h4>Food is essential to life therefore make it good and eat it</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //banner bottom section -->
<!-- special -->
<div class="special">
    <div class="container">
        <h2 class="heading">Today <span>Specials</span></h2>
        <p class="heading">today special offers</p>
        <div class="special-grids">
            <div class="col-md-6 w3l-special-grid">
                <div class="col-md-6 w3ls-special-img">
                    <div class="w3ls-special-text effect-1">
                        <h4>$ 12.00</h4>
                    </div>
                </div>
                <div class="col-md-6 agileits-special-info">
                    <h4>Bread Egg</h4>
                    <p>Maecenas ac hendrerit purus. Lorem ipsum dolor sit amet</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 w3l-special-grid">
                <div class="col-md-6 w3ls-special-img wthree-img1">
                    <div class="w3ls-special-text effect-1">
                        <h4>$ 16.00</h4>
                    </div>
                </div>
                <div class="col-md-6 agileits-special-info">
                    <h4>Veg Soup</h4>
                    <p>Maecenas ac hendrerit purus. Lorem ipsum dolor sit amet</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 w3l-special-grid">
                <div class="col-md-6 agileits-special-info">
                    <h4>Burger</h4>
                    <p>Maecenas ac hendrerit purus. Lorem ipsum dolor sit amet</p>
                </div>
                <div class="col-md-6 w3ls-special-img wthree-img2">
                    <div class="w3ls-special-text effect-1">
                        <h4>$ 14.00</h4>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="col-md-6 w3l-special-grid">
                <div class="col-md-6 agileits-special-info">
                    <h4>Pasta</h4>
                    <p>Maecenas ac hendrerit purus. Lorem ipsum dolor sit amet</p>
                </div>
                <div class="col-md-6 w3ls-special-img wthree-img3">
                    <div class="w3ls-special-text effect-1">
                        <h4>$ 21.00</h4>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>


            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //special -->

<!-- team -->
<div class="team">
    <div class="container">
        <h3 class="heading">Our <span>Chefs</span></h3>
        <p class="heading">our Food Specialists</p>
        <div class="w3_agile_team_grids">
            <div class="col-md-3 w3_agile_team_grid">
                <div class="hover14 column">
                    <figure><img src="images/chef.png" alt=" " class="img-responsive"/></figure>
                </div>
                <div class="team-tt">
                    <h4>Laura Mark</h4>
                    <p>master chef</p>
                    <ul class="agileits_social_list">
                        <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 w3_agile_team_grid">
                <div class="hover14 column">
                    <figure><img src="images/chef.png" alt=" " class="img-responsive"/></figure>
                </div>
                <div class="team-tt">
                    <h4>Wick dolde</h4>
                    <p>master chef</p>
                    <ul class="agileits_social_list">
                        <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 w3_agile_team_grid">
                <div class="hover14 column">
                    <figure><img src="images/chef.png" alt=" " class="img-responsive"/></figure>
                </div>
                <div class="team-tt">
                    <h4>Lusiana James</h4>
                    <p>master chef</p>
                    <ul class="agileits_social_list">
                        <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 w3_agile_team_grid">
                <div class="hover14 column">
                    <figure><img src="images/chef.png" alt=" " class="img-responsive"/></figure>
                </div>
                <div class="team-tt">
                    <h4>Catharine</h4>
                    <p>master chef</p>
                    <ul class="agileits_social_list">
                        <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- team -->

<!-- testimonials -->
<div class="testimonials">
    <div class="container">
        <h3 class="heading">Testimonials</h3>
        <p class="heading">our customer reviews</p>
        <div class="w3_testimonials_grids">
            <div class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="col-md-7 w3_testimonials_grid_left">
                                <p><img src="images/q1.png" alt=" " class=""/>Morbi cursus, turpis quis laoreet blandit,
                                    odio turpis imperdiet nisl,
                                    quis bibendum lorem purus lobortis nunc. Suspendisse tincidunt eu sapien
                                    pellentesque interdum. Aenean lacus sapien, blandit vel nibh in, imperdiet
                                    egestas erat Suspendisse tincidunt eusapien. Maecenas ac hendrerit purus. Lorem
                                    ipsum dolor sit amet<img src="images/q2.png" alt=" " class=""/></p>
                            </div>
                            <div class="col-md-5 w3_testimonials_grid_right">
                                <img src="images/test1.jpg" alt=" " class="img-responsive"/>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-md-7 w3_testimonials_grid_left">
                                <p><img src="images/q1.png" alt=" " class=""/>Morbi cursus, turpis quis laoreet blandit,
                                    odio turpis imperdiet nisl,
                                    quis bibendum lorem purus lobortis nunc. Suspendisse tincidunt eu sapien
                                    pellentesque interdum. Aenean lacus sapien, blandit vel nibh in, imperdiet
                                    egestas erat Suspendisse tincidunt eusapien. Maecenas ac hendrerit purus. Lorem
                                    ipsum dolor sit amet<img src="images/q2.png" alt=" " class=""/></p>
                            </div>
                            <div class="col-md-5 w3_testimonials_grid_right">
                                <img src="images/test2.jpg" alt=" " class="img-responsive"/>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //testimonials -->

<!-- News letter -->
<div class="agile-form">
    <div class="container">
        <div class="col-md-4 newsletter">
            <p>Subscribe to our newsletter</p>
            <h4>For our latest updates</h4>
        </div>
        <div class="col-md-8">
            <form action="#" method="get">
                <input type="email" name="email" placeholder="Enter Your Email Address" required="">
                <input type="submit" value="">
            </form>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- News letter -->

<!-- Footer -->
<div class="footer w3ls">
    <div class="container">
        <div class="footer-main">
            <div class="footer-top">
                <div class="col-md-4 ftr-grid fg1">
                    <h3>opening timings</h3>
                    <p><span class="fa fa-clock-o" aria-hidden="true"></span><span>Mon - friday</span> : 9am to 8pm</p>
                    <p><span class="fa fa-clock-o" aria-hidden="true"></span><span>Saturday</span> : 9am to 5pm</p>
                    <p><span class="fa fa-clock-o" aria-hidden="true"></span><span>Sunday</span> : 6am to 11pm</p>
                </div>
                <div class="col-md-4 ftr-grid fg2 mid-gd">
                    <h3>Our Address</h3>
                    <div class="ftr-address">
                        <div class="local">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <div class="ftr-text">
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="ftr-address">
                        <div class="local">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </div>
                        <div class="ftr-text">
                            <p>+1 (512) 154 8176</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="ftr-address">
                        <div class="local">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div class="ftr-text">
                            <p><a href="mailto:info@example.com">info@example.com</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 ftr-grid fg2">
                    <h3>Recent posts</h3>
                    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices.</p>
                    <div class="more-button">
                        <a href="#">Read more</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>
<div class="copyrights">
    <div class="container">
        <div class="copyright">
            <p>&copy; 2017 Food Recipe. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a>
            </p>
        </div>
        <div class="social-icons">
            <ul>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Footer -->

<!-- Owl-Carousel-JavaScript -->
<script src="js/owl.carousel.js"></script>
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
    $(document).ready(function () {
        $("#owl-demo").owlCarousel({
            items: 5,
            lazyLoad: true,
            autoPlay: true,
            pagination: true,
        });
    });
</script>
<!-- //Owl-Carousel-JavaScript -->

<!-- flexSlider -->
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>


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
    $(document).ready(function () {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({easingType: 'easeOutQuart'});

    });
</script>
<!-- //here ends scrolling icon -->

<!-- for bootstrap working -->
<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->

</body>
</html>