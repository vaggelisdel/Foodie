<?php
	require '../../connection.php';
	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	if ($_SESSION['admin_authorised'] == 0){
		$_SESSION["message"] = "You have to login first";
		header("Location: ../login");
	}else{
		$adminid = $_SESSION["adminid"];
		
		$resultadmin = $connect->query("SELECT * FROM admins WHERE AdminID = '$adminid'");
		$administrator = $resultadmin->fetch_assoc();
		if (isset($_GET["userid"])){
			$userid = $_GET["userid"];
			$result = $connect->query("SELECT * FROM users WHERE `UserID`='$userid'");
			$user = $result->fetch_assoc();
		}else{
			header("Location: index.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Foodie | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-danger">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../" target="_blank" class="nav-link">Homepage</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
         <button type="submit" onclick="location.href='../login/logout.php'" class="btn btn-default logoutbtn"><i class="fa fa-unlock-alt"></i> Logout</button>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-dark-danger">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <center><img src="dist/img/foodie_logo.png" class="foodie_logo"/></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="edit_admin.php?&adminid=<?= $administrator["AdminID"]; ?>" target="_blank" class="d-block"><?= $administrator["Name"]; ?> <?= $administrator["Surname"]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
		<li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>Dashboard</p>
            </a>
          </li>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Users
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="create_user.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Create User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_users.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item">
            <a href="all_admins.php" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>Admins</p>
            </a>
          </li>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cutlery"></i>
              <p>
                Recipes
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="create_recipe.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Create Recipe</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_recipes.php" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>All Recipes</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item">
            <a href="all_materials.php" class="nav-link">
              <i class="nav-icon fa fa-shopping-basket"></i>
              <p>Materials</p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="all_feedbacks.php" class="nav-link">
              <i class="nav-icon fa fa-star"></i>
              <p>Feedbacks</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php">Foodie</a></li>
              <li class="breadcrumb-item active"><a href="all_users.php">Users</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <!-- Main row -->
		
        <div class="row">
          <!-- Left col -->
          
		  <section class="col-lg-8">
		  
			<!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
				<div class="card-tools">
				<form id="deleteuser_form" action="actions/edit_user_actions.php" method="POST">
				  <input type="hidden" name="userid" value="<?= $user["UserID"]; ?>"/>
				  <input type="hidden" name="action" id="action" value=""/>
                  <button type="button" name="delete_user_btn" onclick="deleteuser_function()" class="btn btn-default float-right"><i class="fa fa-trash"></i> Delete the user</button>
                </form>
				</div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="actions/edit_user_actions.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input required type="text" class="form-control" name="user_name" value="<?= $user["Name"]; ?>" id="exampleInputName" placeholder="Enter name">
					<input type="hidden" name="userid" value="<?= $user["UserID"]; ?>"/>
				  </div>
				  <div class="form-group">
                    <label for="exampleInputSurname">Surname</label>
                    <input required type="text" class="form-control" name="user_surname" value="<?= $user["Surname"]; ?>" id="exampleInputSurname" placeholder="Enter surname">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" class="form-control" name="user_password" id="exampleInputPassword" placeholder="Password">
                    <input type="hidden" name="user_password_old" value="<?= $user["Password"]; ?>" placeholder="Password">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input required type="email" class="form-control" name="user_email" value="<?= $user["Email"]; ?>" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
				  <label for="exampleInputPhone">Phone Number</label>
				  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <input required type="text" name="user_phone" value="<?= $user["Phone"]; ?>" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="edit_user_btn" class="btn btn-danger savebtn">Save Changes</button>
                </div>
            </div>
            <!-- /.card -->
		  
		  </section>
		  
		  <section class="col-lg-4">
		  
			<!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Actions</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label>User status</label>
					
					<select hidden id="user_status_prev" name="user_status_prev" class="form-control">
                      <option name="simple" selected>Simple User</option>
                      <option name="admin">Administrator</option>
                    </select>
					
                    <select id="user_status_next" name="user_status_next" class="form-control">
                      <option name="simple" selected>Simple User</option>
                      <option name="admin">Administrator</option>
                    </select>
                  </div>
				  <div class="form-group">
                    <label>Active status</label>
					<?php
						if ($user["Active"] == "1"){
							?>
								<select name="active_status" class="form-control">
								  <option name="active" selected>Active</option>
								  <option name="inactive">Inactive</option>
								</select>
							<?php
						}else{
							?>
								<select name="active_status" class="form-control">
								  <option name="active">Active</option>
								  <option name="inactive" selected>Inactive</option>
								</select>
							<?php
						}
                    ?>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <!-- /.card -->
		  
		  </section>
		  
        </div>
			  
	
        </div>
	</section>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script>
$(function () {
	$('[data-mask]').inputmask()
})
</script>

<script>
function deleteuser_function() {
	var display_text = "Delete the user " + $('#exampleInputName').val() + " " + $('#exampleInputSurname').val() + "?";
if (confirm(display_text)) {
		$('#action').val("Delete");
        document.getElementById("deleteuser_form").submit();
    }else{
		$('#action').val("");
	}
}
</script>
</body>
</html>
