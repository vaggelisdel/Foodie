<?php
require '../../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if ($_SESSION['user_authorized'] == 1) {
    $userid = $_SESSION['userid'];

    $user_details = $connect->query("SELECT * FROM users WHERE UserID = '$userid'");
    $user = $user_details->fetch_assoc();

    $query = "SELECT * FROM feedback WHERE OwnerID = '$userid' ORDER BY feedback.Date DESC";
    $result1 = mysqli_query($connect, $query);

    if (isset($_GET["feedbackid"])) {
        $feedbackid = $_GET["feedbackid"];

        $result = $connect->query("SELECT * FROM feedback WHERE FeedBackID='$feedbackid'");
        $feed = $result->fetch_assoc();

        if ($feed['OwnerID'] != $userid) {
            header("Location: feedback.php");
        }
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
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
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
                        <li><a href="wishlist.php">Επιθυμητές συνταγές</a></li>
                        <li class="active"><a href="feedback.php">Σχόλια</a></li>
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


            <!-- Modal -->
            <div class="modal fade" id="feedbacksmodal" role="dialog">
                <div class="modal-dialog stepbystep_modal">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header stepbystep_header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title rating_title"></h4>
                        </div>
                        <form action="actions/edit_feedbacks_actions.php" method="POST">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputRecipe">Συνταγή</label>
                                        <input disabled type="text" id="recipe" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputUser">Χρήστης</label>
                                            <input disabled type="text" id="username" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputDate">Ημερομηνία</label>
                                            <input disabled type="text" id="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputScore">Σκόρ</label>
                                            <input disabled type="text" id="score" class="form-control">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputDifficulty">Δυσκολία</label>
                                            <input disabled type="text" id="difficulty" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputReview">Σχόλιο</label>
                                        <textarea disabled id="review" class="form-control"></textarea>
                                    </div>
                                    <!-- <input type="hidden" name="userid" id="action" value="<?= $userid ?>"/>
                                    <input type="hidden" name="ownerid" id="ownerid" value=""/>
                                    <input type="hidden" name="recipeid" id="recipeid" value=""/>
                                    <input type="hidden" name="feedbackID" id="feedbackID" value=""/>
                                    -->
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            <!-- Answers Modal -->
            <div class="modal fade" id="answersmodal" role="dialog">
                <div class="modal-dialog stepbystep_modal">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header stepbystep_header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title answers_title"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div id="all_answers"></div>
                                <div class="form-group">
                                    <label for="exampleInputReview">Απαντήστε</label>
                                    <textarea id="answertext" class="form-control answertext"></textarea>
                                    <input type="hidden" id="feedbackid"/>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-danger savebtn submitanswer">Απάντηση</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Content Header (Page header) -->
            <section class="content-header col-md-12">
                <h1 class="col-md-6">
                    Σχόλια των συνταγών μου
                </h1>
                <ol class="col-md-6 breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Αρχική</a></li>
                    <li class="active">Πίνακας ελέγχου</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content col-md-12">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Χρήστης</th>
                                <th>Συνταγή</th>
                                <th>Σκόρ</th>
                                <th>Δυσκολία</th>
                                <th>Ημερομηνία</th>
                                <th>Ενέργεια</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($feedback_row = mysqli_fetch_array($result1)) {

                                $reviewerid = $feedback_row['UserID'];
                                $recipeid = $feedback_row['RecipeID'];
                                $feedbackid = $feedback_row['FeedBackID'];

                                $result_data = $connect->query("SELECT users.*, recipes.* FROM users, recipes WHERE recipes.RecipeID = '$recipeid' AND users.UserID = '$reviewerid'");
                                $feedback_data = $result_data->fetch_assoc();

                                $answers = $connect->query("SELECT count(*) as totalanswers FROM answers WHERE FeedBackID = '$feedbackid'");
                                $allanswers = $answers->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?= $feedback_data['Name']; ?> <?= $feedback_data['Surname']; ?></td>
                                    <td><?= $feedback_data['Title']; ?></td>
                                    <td><?= $feedback_row['Score']; ?></td>
                                    <td><?= $feedback_row['Difficulty']; ?></td>
                                    <td><?= $feedback_row['Date']; ?></td>
                                    <td>
                                        <button type="button" value="<?= $feedback_row['FeedBackID']; ?>"
                                                class="btn btn-block btn-primary view">Προβολή
                                        </button>
                                        <button type="button" value="<?= $feedback_row['FeedBackID']; ?>"
                                                class="btn btn-block btn-danger answer">Απαντήσεις (<?= $allanswers['totalanswers'] ?>)
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Χρήστης</th>
                                <th>Συνταγή</th>
                                <th>Σκόρ</th>
                                <th>Δυσκολία</th>
                                <th>Ημερομηνία</th>
                                <th>Ενέργεια</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<script>
    $(document).ready(function () {

        if (window.location.href.indexOf('?feedbackid') > 0) {

            var feedbackid = <?= $_GET['feedbackid'] ?>;
            var curaction = "Select";

            $.ajax(
                {
                    url: 'actions/fetch_feedbacks_view.php',
                    type: 'POST',
                    data: 'feedbackid=' + feedbackid + '&action=' + curaction,
                    dataType: 'json',

                    success: function (data) {
                        $('#feedbacksmodal').modal('show');
                        $('.rating_title').text("Βαθμολογία: " + data.FeedBackID);
                        $('#recipe').val(data.Recipe);
                        $('#username').val(data.User + " " + data.Surname);
                        $('#date').val(data.Date);
                        $('#score').val(data.Score);
                        $('#ownerid').val(data.OwnerID);
                        $('#recipeid').val(data.RecipeID);
                        $('#difficulty').val(data.Difficulty);
                        $('#review').val(data.Review);
                        $('#feedbackID').val(data.FeedBackID);
                    },
                });
        }

    });
</script>
<script>

    $(document).on('click', '.view', function () {
        var feedbackid = $(this).attr("value");
        var curaction = "Select";

        $.ajax(
            {
                url: 'actions/fetch_feedbacks_view.php',
                type: 'POST',
                data: 'feedbackid=' + feedbackid + '&action=' + curaction,
                dataType: 'json',

                success: function (data) {
                    $('#feedbacksmodal').modal('show');
                    $('.rating_title').text("Βαθμολογία: " + data.FeedBackID);
                    $('#recipe').val(data.Recipe);
                    $('#username').val(data.User + " " + data.Surname);
                    $('#date').val(data.Date);
                    $('#score').val(data.Score);
                    $('#ownerid').val(data.OwnerID);
                    $('#recipeid').val(data.RecipeID);
                    $('#difficulty').val(data.Difficulty);
                    $('#review').val(data.Review);
                    $('#feedbackID').val(data.FeedBackID);
                },
            });

    });


    $(document).on('click', '.answer', function () {
        var feedbackid = $(this).attr("value");
        var curaction = "Answers";
        $("#feedbackid").val(feedbackid);

        $.ajax(
            {
                url: 'actions/fetch_feedbacks_view.php',
                type: 'POST',
                data: 'feedbackid=' + feedbackid + '&action=' + curaction,
                dataType: 'html',

                success: function (data) {
                    $('.answers_title').text("Απαντήσεις από το σχόλιο: " + feedbackid);
                    $("#all_answers").html(data);
                    $("#answersmodal").modal('show');
                },
            });

    });

    function getanswers(){
        var feedbackid = $("#feedbackid").val();
        var curaction = "Answers";

        $.ajax(
            {
                url: 'actions/fetch_feedbacks_view.php',
                type: 'POST',
                data: 'feedbackid=' + feedbackid + '&action=' + curaction,
                dataType: 'html',

                success: function (data) {
                    $("#all_answers").html(data);
                },
            });
    }

    $(document).on('click', '.submitanswer', function () {
        var textanswer = $("#answertext").val();
        var curaction = "AddAnswer";
        var feedbackid = $("#feedbackid").val();
        var userid = <?= $userid ?>;

        $.ajax(
            {
                url: 'actions/fetch_feedbacks_view.php',
                type: 'POST',
                data: 'feedbackid=' + feedbackid + '&action=' + curaction + '&userid=' + userid + '&textanswer=' + textanswer,
                dataType: 'html',

                success: function (data) {
                    $("#all_answers").empty();
                    getanswers();
                    $("#answertext").val("");
                },
            });

    });
</script>
</body>
</html>
