<?php
require '../../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1){
    $userid = $_SESSION['userid'];

    $user_details = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
    $user = $user_details->fetch_assoc();
}else{
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
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
                        <li><a href="wishlist.php">Επιθυμητές συνταγές</a></li>
                        <li><a href="feedback.php">Σχόλια</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Οι συνταγές μου <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="active"><a href="create_recipe.php">Δημιουργία</a></li>
                                <li><a href="myrecipes.php">Προβολή όλων</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <?php require_once 'navbar_top.php';?>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Main content -->
            <section class="content col-md-12">
                <form action="actions/create_recipe_actions.php" method="POST" role="form" id="uploadForm"
                      enctype="multipart/form-data">
                    <div class="col-lg-8">
                        <!-- general form elements -->
                        <div class="card card-danger" id="create_panel">
                            <div class="card-header">
                                <h3 class="card-title">Δημιουργία συνταγής</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputRecipeName">Ονομασία συνταγής</label>
                                    <input required type="text" name="recipe_name" class="form-control"
                                           id="exampleInputRecipeName" placeholder="Εισάγετε ονομασία">
                                    <input type="hidden" name="userid" value="<?= $user["UserID"]; ?>"/>

                                </div>
                                <label for="exampleInputProductionTime">Χρόνος παραγωγής</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <input required type="text" name="recipe_time" class="form-control"
                                           data-inputmask='"mask": "99:99"' data-mask>
                                </div>
                                <label for="exampleInputProductionTime">Εκτιμώμενο κόστος</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                                    </div>
                                    <input required type="text" name="recipe_cost" class="form-control"
                                           data-inputmask='"mask": "99,99&euro;"' data-mask>
                                </div>
                                <label for="exampleInputProductionTime">Μερίδες</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-cutlery"></i></span>
                                    </div>
                                    <input required type="text" name="recipe_dishes" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDescription">Περιγραφή (προαιρετική)</label>
                                    <textarea name="recipe_description" class="form-control textarea_description_recipe"
                                              id="exampleInputDescription"
                                              placeholder="Εισάγετε περιγραφή"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="create_recipe_btn" class="btn btn-danger savebtn">Αποθήκευση
                                    & επεξεργαία
                                </button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-danger" id="thumbnail_panel">
                            <div class="card-header">
                                <h3 class="card-title">Εικόνα συνταγής</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputDescription">Επιλογή εικόνας</label>
                                    <input class="form-control uploadfile" type="file" name="file" id="file">
                                </div>
                                <div class="form-group" id="preview_img">
                                    <img src="../../images/dishes/emptydish.jpg" width="100%"
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </form>
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
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script>
    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview_img').empty();
                $('#preview_img').html("<img src=" + e.target.result + " width='100%'/>");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $("#file").change(function () {
        filePreview(this);
    });
</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        $('[data-mask]').inputmask()
    })
</script>
<script>
    if (window.innerWidth > 768) {
        var create_panel_height = $('#create_panel').height();
        $('#thumbnail_panel').height(create_panel_height);
    }
</script>
</body>
</html>
