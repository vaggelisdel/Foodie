<?php
require '../../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1) {
    $userid = $_SESSION['userid'];

    $user_details = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
    $user = $user_details->fetch_assoc();

    if (isset($_GET["recipeid"])) {
        $recipeid = $_GET["recipeid"];

        $result = $connect->query("SELECT * FROM recipes WHERE `RecipeID`='$recipeid'");
        $recipe = $result->fetch_assoc();

        if ($recipe['UserID'] != $userid){
            header("Location: index.php");
        }

        $query = "SELECT * FROM materials";
        $result1 = mysqli_query($connect, $query);

    } else {
        header("Location: index.php");
    }
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
                <?php require_once 'navbar_top.php'; ?>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Main content -->
            <div class="row">
                <!-- Left col -->

                <section class="col-lg-6">

                    <!-- general form elements -->
                    <div class="card card-danger" id="basic_info_box">
                        <div class="card-header">
                            <h3 class="card-title">Επεξεργασία συνταγής</h3>
                            <div class="card-tools">
                                <form id="deleterecipe_form" action="actions/edit_recipe_actions.php" method="POST">
                                    <input type="hidden" name="recipeid" value="<?= $recipe["RecipeID"]; ?>"/>
                                    <input type="hidden" name="prev_thumbnail" value="<?= $recipe["Thumbnail"]; ?>">
                                    <input type="hidden" name="deleteinput" id="deleteinput" value=""/>
                                    <button type="button" name="delete_recipe_btn" onclick="deleterecipe_function()"
                                            class="btn btn-default float-right"><i class="fa fa-trash"></i> Διαγραφή της συνταγής
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="actions/edit_recipe_actions.php" method="POST" role="form"
                              enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputRecipeName">Ονομασία συνταγής</label>
                                    <input required type="text" name="recipe_name" value="<?= $recipe["Title"]; ?>"
                                           class="form-control" id="exampleInputRecipeName"
                                           placeholder="Εισάγετε ονομασία">
                                    <input type="hidden" name="recipeid" value="<?= $recipe["RecipeID"]; ?>"/>
                                </div>
                                <label for="exampleInputProductionTime">Χρόνος παραγωγής</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <input required type="text" name="recipe_time" value="<?= $recipe["Time"]; ?>"
                                           class="form-control" data-inputmask='"mask": "99:99"' data-mask>
                                </div>
                                <label for="exampleInputProductionTime">Εκτιμώμενο κόστος</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                                    </div>
                                    <input required type="text" name="recipe_cost" value="<?= $recipe["Cost"]; ?>"
                                           class="form-control" data-inputmask='"mask": "99,99&euro;"' data-mask>
                                </div>
                                <label for="exampleInputProductionTime">Μερίδες</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-cutlery"></i></span>
                                    </div>
                                    <input required type="text" name="recipe_dishes" value="<?= $recipe["NoDishes"]; ?>"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDescription">Περιγραφή (προαιρετική)</label>
                                    <textarea name="recipe_description" class="form-control textarea_description_recipe"
                                              id="exampleInputDescription"
                                                  placeholder="Εισάγετε περιγραφή"><?= $recipe["Description"]; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDescription">Εικόνα</label><br>
                                    <span class="fa fa-remove remove_thumbnail"></span>
                                    <img src="../../<?= $recipe["Thumbnail"]; ?>" id="cur_thumb"
                                         class="form-control review_thumbnail"/>
                                    <input type="hidden" name="prev_thumbnail" id="prev_thumbnail"
                                           value="<?= $recipe["Thumbnail"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDescription">Νέα εικόνα</label>
                                    <input class="form-control uploadfile" type="file" name="file">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="save_recipe_changes_btn" class="btn btn-danger savebtn">Αποθήκευση αλλαγών
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </section>

                <section class="col-lg-6">

                    <!-- general form elements -->
                    <div class="card card-danger" id="select_materials_box">
                        <div class="card-header" id="materials_header">
                            <h3 class="card-title">Επιλογή υλικών</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <div id="materials_add">
                                        <div class="form-group">
                                            <label>Όλα τα υλικά</label>
                                            <select id="selected_material" name="selected_material"
                                                    class="form-control select2" style="width: 100%;">
                                                <option selected disabled>Επιλογή υλικού</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($result1)) {
                                                    ?>
                                                    <option name="<?= $row["Name"]; ?>"><?= $row["Name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputQuantity">Ποσότητα</label>
                                            <input type="text" class="form-control" id="quantity"
                                                   placeholder="Εισάγετε ποσότητα">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputNote">Σημείωση (προαιρετική)</label>
                                            <input type="text" class="form-control" id="note"
                                                   placeholder="Εισάγετε σημείωση">
                                            <input type="hidden" id="recipeid" value="<?= $recipe["RecipeID"]; ?>">
                                        </div>

                                        <button type="submit" class="btn btn-danger savebtn insert">Προσθήκη στη συνταγή
                                            &nbsp <i class="fa fa-mail-forward"></i></button>
                                    </div>
                                    <div id="materials_table"></div>
                                </div>
                                <!-- /.card-body -->


                            </div>


                        </div>

                    </div>
                    <!-- /.card -->

                </section>
            </div>


            <!-- Modal step -->
            <div class="modal fade" id="stepbystep_new" role="dialog">
                <div class="modal-dialog stepbystep_modal">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header stepbystep_header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title step_title"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputStep">Βήμα</label>
                                    <input type="text" class="form-control" id="stepname" placeholder="Εισάγετε βήμα">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPerformanceName">Ονομασία εκτέλεσης</label>
                                    <input type="text" class="form-control" id="performance"
                                           placeholder="Εισάγετε ονομασία εκτέλεσης">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDescription">Περιγραφή του βήματος</label>
                                    <textarea class="form-control" id="description_step"
                                              placeholder="Εισάγετε περιγραφή"></textarea>
                                    <input type="hidden" id="recipeid" value="<?= $recipe["RecipeID"]; ?>">
                                    <input type="hidden" id="stepid" value="">
                                    <input type="hidden" id="lastperf" value="">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="centralbtn"
                                        class="btn btn-danger savebtn changevalues"></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <!-- Left col -->

                <section class="col-lg-12">

                    <!-- general form elements -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                Βήματα εκτέλεσης συνταγής
                            </h3>
                            <div class="card-tools">
                                <button type="button" data-toggle="modal" data-target="#stepbystep_new"
                                        class="btn btn-default float-right createsteps"><i class="fa fa-plus"></i> Εισαγωγή βήματος
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <ul class="todo-list stepbystep">
                                <div id="all_steps"></div>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
            </div>


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
    if (window.innerWidth > 768) {
        var basic_info_box = $('#basic_info_box').height();
        $('#select_materials_box').height(basic_info_box);
    }
</script>
<script>
        var select_materials_table = $('#select_materials_box').height() - $('#materials_header').height() - $('#materials_add').height() - 40;
        $('#materials_table').height(select_materials_table);
</script>
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

<script>
    function deleterecipe_function() {
        var display_text = "Διαγραφή της συνταγής " + $('#exampleInputRecipeName').val() + ";";
        if (confirm(display_text)) {
            $('#deleteinput').val("Delete");
            document.getElementById("deleterecipe_form").submit();
        } else {
            $('#deleteinput').val("");
        }
    }
</script>

<script>
    //load / insert / delete materials to recipe


    $(document).on('click', '.createsteps', function () {
        $('.step_title').text("Εισαγωγή νέου βήματος");
        $('.changevalues').text("Δημιουργία");
        $('#stepname').val("");
        $('#description_step').val("");
        var lastperf = $('#lastperf').val();
        $('#performance').val(lastperf);
        document.getElementById("centralbtn").classList.add("create");
        document.getElementById("centralbtn").classList.remove("update");
    });
    $(document).on('click', '.editbtn', function () {
        $('#stepbystep_new').modal("show");
        $('.step_title').text("Επεξεργασία βήματος");
        $('.changevalues').text("Αποθήκευση");
        document.getElementById("centralbtn").classList.add("update");
        document.getElementById("centralbtn").classList.remove("create");
    });


    load_cur_materials();


    function load_cur_materials() {
        var action = "Load";
        var recipeid = $('#recipeid').val();

        $.ajax(
            {
                url: 'actions/fetch_edit_recipe.php',
                type: 'POST',
                data: 'action=' + action + '&recipeid=' + recipeid,
                dataType: 'html',

                success: function (data) {
                    $("#materials_table").html(data);
                },
            });
    }


    $(document).on('click', '.insert', function () {
        var cur_action = "Insert";
        var recipeid = $('#recipeid').val();
        var selected_material = $('#selected_material').val();
        var quantity = $('#quantity').val();
        var note = $('#note').val();

        $.ajax(
            {
                url: 'actions/fetch_edit_recipe.php',
                type: 'POST',
                data: 'recipeid=' + recipeid + '&action=' + cur_action + '&material=' + selected_material + '&quantity=' + quantity + '&note=' + note,
                dataType: 'html',

                success: function (data) {
                    $('#selected_material').prop('selectedIndex', 0);
                    document.getElementById("select2-selected_material-container").innerHTML = "Select Material";
                    document.getElementById("select2-selected_material-container").title = "Select Material";
                    $('#quantity').val("");
                    $('#note').val("");
                    load_cur_materials();
                },
            });

    });


    $(document).on('click', '.delete', function () {
        var quantityid = $(this).attr("value");
        var cur_action = "Delete";

        if (confirm("Διαγραφή αυτού του υλικού;")) {

            $.ajax(
                {
                    url: 'actions/fetch_edit_recipe.php',
                    type: 'POST',
                    data: 'quantityid=' + quantityid + '&action=' + cur_action,

                    success: function (data) {
                        load_cur_materials();
                    },
                });

        }

    });


    //load / insert / delete steps

    load_cur_steps();


    function load_cur_steps() {
        var step_action = "Load";
        var recipeid = $('#recipeid').val();

        $.ajax(
            {
                url: 'actions/fetch_edit_recipe_steps.php',
                type: 'POST',
                data: 'step_action=' + step_action + '&recipeid=' + recipeid,
                dataType: 'html',

                success: function (data) {
                    $("#all_steps").html(data);
                },
            });
    }


    $(document).on('click', '.create', function () {
        var step_action = "Insert";
        var recipeid = $('#recipeid').val();
        var stepname = $('#stepname').val();
        var performance = $('#performance').val();
        var description_step = $('#description_step').val();

        if (($('#stepname').val() != "") && ($('#description_step').val() != "")) {

            $.ajax(
                {
                    url: 'actions/fetch_edit_recipe_steps.php',
                    type: 'POST',
                    data: 'recipeid=' + recipeid + '&step_action=' + step_action + '&stepname=' + stepname + '&performance=' + performance + '&description_step=' + description_step,
                    dataType: 'html',

                    success: function (data) {
                        $('#stepbystep_new').modal('hide');
                        $('#lastperf').val(performance);
                        $('#performance').val("");
                        $('#stepname').val("");
                        $('#description_step').val("");
                        load_cur_steps();
                    },
                });
        } else {
            alert("Step and Description are required!");
        }
    });


    $(document).on('click', '.trashbtn', function () {
        var stepid = $(this).attr("value");
        var step_action = "Delete";

        if (confirm("Διαγραφή αυτού του βήματος;")) {

            $.ajax(
                {
                    url: 'actions/fetch_edit_recipe_steps.php',
                    type: 'POST',
                    data: 'stepid=' + stepid + '&step_action=' + step_action,

                    success: function (data) {
                        load_cur_steps();
                    },
                });

        }

    });


    $(document).on('click', '.editbtn', function () {
        var stepid = $(this).attr("value");
        var step_action = "Select";

        $.ajax(
            {
                url: 'actions/fetch_edit_recipe_steps.php',
                type: 'POST',
                data: 'stepid=' + stepid + '&step_action=' + step_action,
                dataType: 'json',

                success: function (data) {
                    $('#performance').val(data.Performance);
                    $('#stepname').val(data.CurrentStep);
                    $('#description_step').val(data.Description);
                    $('#stepid').val(data.StepID);
                },
            });
    });


    $(document).on('click', '.update', function () {
        var stepid = $('#stepid').val();
        var stepname = $('#stepname').val();
        var performance = $('#performance').val();
        var description_step = $('#description_step').val();
        var step_action = "Update";

        $.ajax(
            {
                url: 'actions/fetch_edit_recipe_steps.php',
                type: 'POST',
                data: 'stepid=' + stepid + '&step_action=' + step_action + '&stepname=' + stepname + '&performance=' + performance + '&description_step=' + description_step,

                success: function (data) {
                    $('#stepbystep_new').modal('hide');
                    $('#lastperf').val(performance);
                    $('#performance').val("");
                    $('#stepname').val("");
                    $('#description_step').val("");
                    load_cur_steps();
                },
            });
    });


    //remove thumbnail
    $(document).on('click', '.remove_thumbnail', function () {
        var action = "Remove_thumbnail";
        var current_thumbnail = $('#prev_thumbnail').val();

        $.ajax(
            {
                url: 'actions/fetch_edit_recipe.php',
                type: 'POST',
                data: 'current_thumbnail=' + current_thumbnail + '&action=' + action,
                dataType: 'html',

                success: function (data) {
                    $("#cur_thumb").attr("src", "../../images/dishes/emptydish.jpg");
                },
            });

    });
</script>
</body>
</html>
