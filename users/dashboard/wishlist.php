<?php
require '../../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1) {
    $userid = $_SESSION['userid'];

    $user_details = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
    $user = $user_details->fetch_assoc();

    $query = "SELECT * FROM wishlist WHERE UserID = '$userid'";
    $result1 = mysqli_query($connect, $query);
} else {
    $_SESSION["user_message"] = "Δεν επιτρέπεται η πρόσβαση. Πρέπει πρώτα να συνδεθείτε!";
    header("Location: ../login/alert.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Foodie | Πίνακας ελέγχου</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="../../" class="navbar-brand"><img class="imglogo" src="../../images/logo2.png"></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Πίνακας ελέγχου</a></li>
                        <li class="active"><a href="wishlist.php">Επιθυμητές συνταγές</a></li>
                        <li><a href="feedback.php">Σχόλια</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Οι συνταγές μου <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="create_recipe.php">Δημιουργία</a></li>
                                <li><a href="myrecipes.php">Προβολή όλων</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <?php require_once 'navbar_top.php'; ?>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header col-md-12">
                <h1 class="col-md-6">
                    Επιθυμητές συνταγές
                </h1>
                <ol class="col-md-6 breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Αρχική</a></li>
                    <li class="active">Πίνακας ελέγχου</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content col-md-12">

                <div class="box">
                    <div class="box-body">
                        <?php
                        if ($result1->num_rows == 0) {
                            ?>
                            <center>
                                <div class="empty_dishes">
                                    <i class="fa fa-heart"></i>
                                    <h2>Δεν υπάρχουν ακόμη επιθυμητές συνταγές</h2>
                                </div>
                            </center>
                            <?php
                        } else {
                            while ($recipe_wish = mysqli_fetch_array($result1)) {

                                $recipeid = $recipe_wish['RecipeID'];
                                $recipe_info = $connect->query("SELECT * FROM recipes WHERE RecipeID = '$recipeid'");
                                $recipe_result = $recipe_info->fetch_assoc();
                                ?>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <i value="<?= $recipe_result['RecipeID']; ?>"
                                           id="<?= $recipe_result['RecipeID']; ?>" class="iconheart fa fa-heart"></i>
                                        <img src="../../<?= $recipe_result['Thumbnail']; ?>">
                                        <div class="container col-sm-12 recipe_card">
                                            <h4><b><?= $recipe_result['Title']; ?></b></h4>
                                            <i class="col-sm-4 fa fa-clock-o"> <?= $recipe_result['Time']; ?></i>
                                            <i class="col-sm-4 fa fa-money"> <?= $recipe_result['Cost']; ?>&euro;</i>
                                            <i class="col-sm-4 fa fa-cutlery"> <?= $recipe_result['NoDishes']; ?></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <strong>Copyright &copy; 2018-2019</strong> Foodie. All
            rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
    $("#alert_top").hide();
    $(document).on('click', '.iconheart', function () {
        var recipeid = $(this).attr("value");
        var userid = <?= $userid; ?>;
        var action = "Check";

        $.ajax(
            {
                url: 'actions/fetch_wishlist.php',
                type: 'POST',
                data: 'recipeid=' + recipeid + '&userid=' + userid + '&action=' + action,
                dataType: 'html',

                success: function (data) {
                    if (data == "1") {
                        document.getElementById(recipeid).style.color = "#c7c7c7";
                    } else if (data == "2") {
                        document.getElementById(recipeid).style.color = "#e63939";
                    }
                },
            });
    });
</script>
</body>
</html>
