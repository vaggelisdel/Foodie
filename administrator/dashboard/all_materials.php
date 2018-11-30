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
		
		$query ="SELECT * FROM materials";  
		$result_all_materials = mysqli_query($connect, $query);
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
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
            <a href="all_materials.php" class="nav-link active">
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <!-- Main row -->
		
		
				<!-- Modal create material-->
  <div class="modal fade" id="new_material" role="dialog">
    <div class="modal-dialog materials_modal">
          <div class="modal-content">
        <div class="modal-header stepbystep_header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add new material</h4>
        </div>
	<form action="actions/create_material_actions.php" method="POST">
        <div class="modal-body">
			<div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputMaterial">Material's Name</label>
                    <input type="text" name="material_name" class="form-control" id="exampleInputMaterial" placeholder="Enter the material's name">
                  </div>
            </div>
			<div class="card-footer">
                <button type="submit" name="create_material_btn" class="btn btn-danger savebtn">Create Material</button>
            </div>
	</form>
        </div>
      </div>
      
    </div>
  </div>
  
  
  
  <!------------------------------>
  
  
  				<!-- Modal edit material -->
  <div class="modal fade" id="edit_material" role="dialog">
    <div class="modal-dialog materials_modal">
          <div class="modal-content">
        <div class="modal-header stepbystep_header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit material</h4>
        </div>
	<form id="editmaterial_form" action="actions/edit_material_actions.php" method="POST">
        <div class="modal-body">
			<div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputMaterial">Material's Name</label>
                    <input type="text" name="material_name" id="material_name" class="form-control">
                    <input type="hidden" name="material_id" id="material_id" class="form-control">
					<input type="hidden" name="action" id="action" value=""/>
                  </div>
            </div>
			<div class="card-footer material_actions_btn">
                <button type="button" name="delete_material_btn" onclick="deletematerial_function()" class="btn btn-default delbtn">Delete the material</button>
                <button type="submit" name="edit_material_btn" class="btn btn-danger savebtn">Update the material</button>
            </div>
	</form>
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
                <h3 class="card-title">Materials</h3>
				<div class="card-tools">
                  <button type="button" data-toggle="modal" data-target="#new_material" class="btn btn-default float-right"><i class="fa fa-plus"></i> Add new material</button>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="15%">ID</th>
                  <th width="70%">Name</th>
                  <th width="15%">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php  
                    while($row = mysqli_fetch_array($result_all_materials))  
						{
				?>
							<tr>
							  <td><?= $row["MaterialID"] ?></td>
							  <td><?= $row["Name"] ?></td>
							  <td><center><button type="button" value="<?= $row["MaterialID"] ?>" class="btn btn-block btn-outline-primary btn-sm edit">Edit</button></center></td>
							</tr>
				<?php
						}
				?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
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
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
	$("#example1").DataTable();
  });
</script>
<script>
$(document).on('click', '.edit', function(){
	var matid = $(this).attr("value");
	var cur_action = "Select";
	
	$.ajax(
            {
                url:'actions/fetch_materials_edit.php',
                type:'POST',
                data:'matid=' + matid + '&action=' + cur_action,
				dataType:'json',

                success:function(data)
                {
					$('#edit_material').modal('show');
					 $('#material_id').val(data.MaterialID);
					 $('#material_name').val(data.MaterialName);
                },
            });
	
});
</script>
<script>
function deletematerial_function() {
	var display_text = "Delete " + $('#material_name').val() + "?";
if (confirm(display_text)) {
		$('#action').val("Delete");
        document.getElementById("editmaterial_form").submit();
    }else{
		$('#edit_material').modal('hide');
		$('#action').val("");
	}
}
</script>
</body>
</html>
