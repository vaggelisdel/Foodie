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
		
		$result = $connect->query("SELECT count(*) as totalrecipes FROM recipes");
		$recipes = $result->fetch_assoc();
		
		$result1 = $connect->query("SELECT count(*) as totalusers FROM users");
		$users = $result1->fetch_assoc();
		
		$result2 = $connect->query("SELECT count(*) as totaladmins FROM admins");
		$admins = $result2->fetch_assoc();
		
		$result3 = $connect->query("SELECT count(*) as totalfeedback FROM feedback");
		$feedback = $result3->fetch_assoc();
		
		$query ="SELECT * FROM users ORDER BY RegisterBy DESC LIMIT 8";  
		$result4 = mysqli_query($connect, $query);
		
		$query ="SELECT * FROM recipes ORDER BY CreatedDate DESC LIMIT 8";  
		$result5 = mysqli_query($connect, $query);
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
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>Dashboard</p>
            </a>
          </li>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
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
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $recipes["totalrecipes"];?></h3>

                <p>Recipes</p>
              </div>
              <div class="icon">
                <i class="ion ion-pizza"></i>
              </div>
              <a href="all_recipes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $users["totalusers"];?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="all_users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $admins["totaladmins"];?></h3>

                <p>Admins</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-contact"></i>
              </div>
              <a href="all_admins.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $feedback["totalfeedback"];?></h3>

                <p>Ratings</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-pulse"></i>
              </div>
              <a href="all_feedbacks.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
		
		
		
				<!-- Modal todolist -->
  <div class="modal fade" id="new_todolist" role="dialog">
    <div class="modal-dialog todolist_modal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header stepbystep_header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add new item</h4>
        </div>
        <div class="modal-body">
			<div class="card-body">
				  <div class="form-group">
                    <label for="exampleInputDescription">Description</label>
                    <textarea class="form-control" id="description_item" placeholder="Enter the description"></textarea>
					<input type="hidden" name="adminid" id="adminid" value="1"/>
				  </div>	  
            </div>
			<div class="card-footer">
                <button type="submit" class="btn btn-danger savebtn create_to_do">Create item</button>
            </div>
        </div>
      </div>
      
    </div>
  </div>
		
		
		
		
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <button type="button" data-toggle="modal" data-target="#new_todolist" class="btn btn-danger float-right"><i class="fa fa-plus"></i> Add item</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list">
					<div id="todolist_items"></div>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </section>
		  <section class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
					<i class="ion ion-android-people"></i>
					Latest Users
					</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0 index_users">
                    <ul class="users-list clearfix">
					  <?php  
							while($row = mysqli_fetch_array($result4))  
								{
						?>
								<li>
									<div class="icon">
										<i class="ion ion-ios-contact"></i>
									</div>
									<a class="users-list-name" target="_blank" href="edit_user.php?&userid=<?= $row["UserID"]; ?>"><?= $row["Name"]; ?> <?= $row["Surname"]; ?></a>
									<span class="users-list-date"><?= $row["RegisterBy"]; ?></span>
								</li>
						<?php
								}
						?>
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a target="_blank" href="all_users.php">View All Users</a>
                  </div>
                  <!-- /.card-footer -->
					</div>
				</section>
                <!--/.card -->
              </div>
			  
	<div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
				<div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Recipe ID</th>
                      <th>Title</th>
                      <th>Time</th>
                      <th>Cost</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php  
							while($row = mysqli_fetch_array($result5))  
								{
					?>
								<tr>
								  <td><a target="_blank" href="edit_recipe.php?&recipeid=<?= $row["RecipeID"]; ?>">#<?= $row["RecipeID"]; ?></a></td>
								  <td><?= $row["Title"]; ?></td>
								  <td><?= $row["Time"]; ?> h</td>
								  <td><?= $row["Cost"]; ?>&euro;</td>
								  <td>
								  
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
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a target="_blank" href="create_recipe.php" class="btn btn-sm btn-danger float-left">Add New Recipe</a>
                <a target="_blank" href="all_recipes.php" class="btn btn-sm btn-secondary float-right">View All Recipes</a>
              </div>
              <!-- /.card-footer -->
            </div>
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
<script>

load_todolist();


function load_todolist(){
  var action = "Load";
  
  $.ajax(
            {
                url:'actions/fetch_todolist.php',
                type:'POST',
                data:'action=' + action,
				dataType:'html',

                success:function(data)
                {
					$("#todolist_items").html(data);
                },
            });
}


$(document).on('click', '.create_to_do', function(){
	var action = "Insert";
	var adminid = $('#adminid').val();
	var description_item = $('#description_item').val();
	
	
	$.ajax(
            {
                url:'actions/fetch_todolist.php',
                type:'POST',
                data:'&action=' + action + '&description_item=' + description_item + '&adminid=' + adminid,
				dataType:'html',

                success:function(data)
                {
					$('#new_todolist').modal('hide');
					$('#description_item').val("");
					load_todolist();
                },
            });
	
});


$(document).on('click', '.deleteitem', function(){
	var todolistid = $(this).attr("value");
	var action = "Delete";
	
	if (confirm("Delete this item from to do list?")) {
    
		$.ajax(
            {
                url:'actions/fetch_todolist.php',
                type:'POST',
                data:'todolistid=' + todolistid + '&action=' + action,

                success:function(data)
                {
					load_todolist();
                },
            });
			
	}
	
});



$(document).on('click', '.activebtn', function(){
	var todolistid = $(this).attr("value");
	var action = "Status";
	
	if (document.getElementById(todolistid).checked == true) {
			var status = "0";
	}else{
			var status = "1";
	}
	
	$.ajax(
            {
                url:'actions/fetch_todolist.php',
                type:'POST',
                data:'todolistid=' + todolistid + '&action=' + action + '&status=' + status,

                success:function(data)
                {
					load_todolist();
                },
            });
	
});
</script>
</body>
</html>
