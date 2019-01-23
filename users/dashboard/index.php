<?php
require '../../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1) {
    $userid = $_SESSION['userid'];

    $user_details = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
    $user = $user_details->fetch_assoc();

    $result1 = $connect->query("SELECT count(*) as totalrecipes FROM recipes WHERE UserID = '$userid'");
    $recipes = $result1->fetch_assoc();

    $result2 = $connect->query("SELECT count(*) as totalwishes FROM wishlist WHERE UserID = '$userid'");
    $wishlist = $result2->fetch_assoc();

    $result3 = $connect->query("SELECT count(*) as totalfeeds FROM feedback WHERE OwnerID = '$userid'");
    $feedbacks = $result3->fetch_assoc();

    $query = "SELECT * FROM recipes WHERE UserID = '$userid' ORDER BY CreatedDate DESC LIMIT 3";
    $result4 = mysqli_query($connect, $query);

    $query1 = "SELECT * FROM feedback WHERE OwnerID = '$userid' ORDER BY feedback.Date DESC LIMIT 5";
    $result5 = mysqli_query($connect, $query1);

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
                        <li class="active"><a href="index.php">Πίνακας ελέγχου</a></li>
                        <li><a href="wishlist.php">Επιθυμητές συνταγές</a></li>
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
                    Καλωσόρισες στο Foodie
                </h1>
                <ol class="col-md-6 breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Αρχική</a></li>
                    <li class="active">Πίνακας ελέγχου</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?= $recipes['totalrecipes']; ?></h3>

                                    <p>Οι συνταγές μου</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pizza"></i>
                                </div>
                                <a href="myrecipes.php" class="small-box-footer">Περισσότερα <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?= $wishlist['totalwishes']; ?></h3>

                                    <p>Επιθυμητές συνταγές</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-heart"></i>
                                </div>
                                <a href="wishlist.php" class="small-box-footer">Περισσότερα <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $feedbacks['totalfeeds']; ?></h3>

                                    <p>Σχόλια</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-chatbubbles"></i>
                                </div>
                                <a href="feedback.php" class="small-box-footer">Περισσότερα <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>


                <!-- table: latest orders -->
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <i class="fa fa-cutlery"></i>
                            <h3 class="box-title">Πρόσφατες συνταγές</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Συνταγή</th>
                                        <th>Δημοτικότητα</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($latestorders = mysqli_fetch_array($result4)) {

                                        $recipeid = $latestorders['RecipeID'];
                                        $result_score = $connect->query("SELECT AVG(Score) AS recipe_avgscore, COUNT(*) AS recipe_count FROM feedback WHERE RecipeID = '$recipeid'");
                                        $avgscore_recipe = $result_score->fetch_assoc();
                                        ?>

                                        <tr>
                                            <td><a href="edit_recipe.php?recipeid=<?= $latestorders['RecipeID']; ?>" target="_blank">Order<?= $latestorders['RecipeID']; ?></a></td>
                                            <td><?= $latestorders['Title']; ?></td>
                                            <td>
                                                <?php
                                                if ($avgscore_recipe['recipe_count'] >= 10) {
                                                    if ($avgscore_recipe['recipe_avgscore'] < 2.5) {
                                                        ?>
                                                        <span class="label label-danger">Πολύ Χαμηλή</span>
                                                        <?php
                                                    } elseif (($avgscore_recipe['recipe_avgscore'] >= 2.5) && ($avgscore_recipe['recipe_avgscore'] < 5)) {
                                                        ?>
                                                        <span class="label label-warning">Χαμηλή</span>
                                                        <?php
                                                    } elseif (($avgscore_recipe['recipe_avgscore'] >= 5) && ($avgscore_recipe['recipe_avgscore'] < 7.5)) {
                                                        ?>
                                                        <span class="label label-success">Υψηλή</span>
                                                        <?php
                                                    } elseif ($avgscore_recipe['recipe_avgscore'] >= 7.5) {
                                                        ?>
                                                        <span class="label label-info">Πολύ Υψηλή</span>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <span class="label label-default">Μη διαθέσιμη</span>
                                                    <?php
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="create_recipe.php" target="_blank" class="btn btn-sm btn-danger btn-flat pull-left">Δημιουργία
                                νέας συνταγής</a>
                            <a href="myrecipes.php" target="_blank" class="btn btn-sm btn-default btn-flat pull-right">Προβολή
                                όλων των συνταγών</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>


                <!-- Chat box -->
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <i class="fa fa-comments-o"></i>

                            <h3 class="box-title">Σχόλια</h3>
                        </div>
                        <div class="box-body chat" id="chat-box">
                            <!-- chat item -->
                            <?php
                            while ($feedback_review = mysqli_fetch_array($result5)) {

                                $feedback_userid = $feedback_review['UserID'];
                                $feedback_recipeid = $feedback_review['RecipeID'];

                                $feedback_result = $connect->query("SELECT users.*, recipes.* FROM users, recipes WHERE users.UserID = '$feedback_userid' AND recipes.RecipeID = '$feedback_recipeid'");
                                $feedback_data = $feedback_result->fetch_assoc();
                                ?>
                                <div class="item">
                                    <a href="feedback.php?feedbackid=<?= $feedback_review['FeedBackID'] ?>" class="name">
                                        <img src="../../images/comment_icon.png">

                                        <p class="message">
                                            <small class="text-muted pull-right"><i
                                                        class="fa fa-clock-o"></i> <?= $feedback_review['Date']; ?>
                                            </small>
                                            <?= $feedback_data['Name']; ?> <?= $feedback_data['Surname']; ?>
<br>
                                            <b><?= $feedback_data['Title']; ?>:</b> <?= $feedback_review['Review']; ?>
                                            <br>
                                            Σκόρ: <?= $feedback_review['Score']; ?>,
                                            Δυσκολία: <?= $feedback_review['Difficulty']; ?>
                                        </p>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <!-- /.chat -->
                    </div>
                </div>

                <!-- /.box (chat box) -->

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
</body>
</html>
