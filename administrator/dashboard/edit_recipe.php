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
		
		if (isset($_GET["recipeid"])){
			$recipeid = $_GET["recipeid"];
			
			$result = $connect->query("SELECT * FROM recipes WHERE `RecipeID`='$recipeid'");
			$recipe = $result->fetch_assoc();
			
			$query ="SELECT * FROM materials";  
			$result1 = mysqli_query($connect, $query);
			
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
    <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
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
            <a href="#" class="nav-link active">
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
            <h1 class="m-0 text-dark">Edit Recipe</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php">Foodie</a></li>
              <li class="breadcrumb-item active"><a href="all_recipes.php">Recipes</a></li>
              <li class="breadcrumb-item active">Edit Recipe</li>
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
          
		  <section class="col-lg-12">
		  
			<!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Edit Recipe</h3>
				<div class="card-tools">
                  <form id="deleterecipe_form" action="actions/edit_recipe_actions.php" method="POST">
					  <input type="hidden" name="recipeid" value="<?= $recipe["RecipeID"]; ?>"/>
					  <input type="hidden" name="prev_thumbnail" value="<?= $recipe["Thumbnail"]; ?>">
					  <input type="hidden" name="deleteinput" id="deleteinput" value=""/>
					  <button type="button" name="delete_recipe_btn" onclick="deleterecipe_function()" class="btn btn-default float-right"><i class="fa fa-trash"></i> Delete the recipe</button>
				  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="actions/edit_recipe_actions.php" method="POST" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputRecipeName">Recipe Name</label>
                    <input required type="text" name="recipe_name" value="<?= $recipe["Title"]; ?>" class="form-control" id="exampleInputRecipeName" placeholder="Enter recipe name">
					<input type="hidden" name="recipeid" value="<?= $recipe["RecipeID"]; ?>"/>
				  </div>
				  <label for="exampleInputProductionTime">Production Time</label>
				  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <input required type="text" name="recipe_time" value="<?= $recipe["Time"]; ?>" class="form-control" data-inputmask='"mask": "99:99"' data-mask>
                  </div>
				  <label for="exampleInputProductionTime">Calculated Cost</label>
				  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-money"></i></span>
                    </div>
                    <input required type="text" name="recipe_cost" value="<?= $recipe["Cost"]; ?>" class="form-control" data-inputmask='"mask": "99,99&euro;"' data-mask>
                  </div>
				  <label for="exampleInputProductionTime">Dishes</label>
				  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-cutlery"></i></span>
                    </div>
                    <input required type="text" name="recipe_dishes" value="<?= $recipe["NoDishes"]; ?>" class="form-control">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputDescription">Description (optional)</label>
                    <textarea name="recipe_description" class="form-control textarea_description_recipe" id="exampleInputDescription" placeholder="Enter the description"><?= $recipe["Description"]; ?></textarea>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputDescription">Current Thumbnail</label><br>
					<span class="fa fa-remove remove_thumbnail"></span>
					<img src="../../<?= $recipe["Thumbnail"]; ?>" id="cur_thumb" class="form-control review_thumbnail"/>
					<input type="hidden" name="prev_thumbnail" id="prev_thumbnail" value="<?= $recipe["Thumbnail"]; ?>">
				  </div>
				  <div class="form-group">
                    <label for="exampleInputDescription">New Thumbnail</label>
					<input class="form-control uploadfile" type="file" name="file">
				  </div>
                </div>
                <!-- /.card-body -->
				<div class="card-footer">
                  <button type="submit" name="save_recipe_changes_btn" class="btn btn-danger savebtn">Save Changes</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
		  
		  </section>
		</div>
	
	
		 <div class="row">
          <!-- Left col -->
          
		  <section class="col-lg-12">
		  
			<!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Select Materials</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
			  <div class="row">
				<div class="col-lg-5">
                <div class="card-body">
                  <div class="form-group">
                  <label>All Materials</label>
                  <select id="selected_material" name="selected_material" class="form-control select2" style="width: 100%;">
                    <option selected disabled>Select Material</option>
                    <?php  
						while($row = mysqli_fetch_array($result1))  
							{
							?>
								<option name="<?= $row["Name"]; ?>"><?= $row["Name"]; ?></option>
							<?php
							}
					?>
                  </select>
                </div>
				<div class="form-group">
                    <label for="exampleInputQuantity">Quantity</label>
                    <input type="text" class="form-control" id="quantity" placeholder="Enter the quantity">
                </div>
				<div class="form-group">
                    <label for="exampleInputNote">Note (optional)</label>
                    <input type="text" class="form-control" id="note" placeholder="Enter the note">
                    <input type="hidden" id="recipeid" value="<?= $recipe["RecipeID"]; ?>">
                </div>
				
				
                </div>
                <!-- /.card-body -->
				
				<div class="card-footer">
                  <button type="submit" class="btn btn-danger savebtn insert">Insert to recipe &nbsp <i class="fa fa-mail-forward"></i></button>
                </div>
			  </div>
			  
			  
			  <div class="col-lg-7">
              <form role="form">
                <div class="card-body">
					<div id="materials_table"></div>
                </div>
                <!-- /.card-body -->

              </form>
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
                    <label for="exampleInputStep">Step</label>
                    <input type="text" class="form-control" id="stepname" placeholder="Enter the step">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputPerformanceName">Performance Name</label>
                    <input type="text" class="form-control" id="performance" placeholder="Enter the performance name">
                  </div>
				  <div class="form-group">
                    <label for="exampleInputDescription">Description</label>
                    <textarea class="form-control" id="description_step" placeholder="Enter the description"></textarea>
					<input type="hidden" id="recipeid" value="<?= $recipe["RecipeID"]; ?>">
					<input type="hidden" id="stepid" value="">
					<input type="hidden" id="lastperf" value="">
				  </div>	  
            </div>
			<div class="card-footer">
                <button type="submit" id="centralbtn" class="btn btn-danger savebtn changevalues"></button>
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
                  Step By Step
                </h3>
				<div class="card-tools">
                  <button type="button" data-toggle="modal" data-target="#stepbystep_new" class="btn btn-default float-right createsteps"><i class="fa fa-plus"></i> Add new step</button>
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
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script>
$(function () {
	//Initialize Select2 Elements
    $('.select2').select2()
	$('[data-mask]').inputmask()
})
</script>
<script>
function deleterecipe_function() {
	var display_text = "Delete the recipe " + $('#exampleInputRecipeName').val() + "?";
if (confirm(display_text)) {
		$('#deleteinput').val("Delete");
        document.getElementById("deleterecipe_form").submit();
    }else{
		$('#deleteinput').val("");
	}
}
</script>

<script>
//load / insert / delete materials to recipe



$(document).on('click', '.createsteps', function(){
	$('.step_title').text("Add new step");
	$('.changevalues').text("Create Step");
	$('#stepname').val("");
	$('#description_step').val("");
	var lastperf = $('#lastperf').val();
	$('#performance').val(lastperf);
	document.getElementById("centralbtn").classList.add("create");
	document.getElementById("centralbtn").classList.remove("update");
});
$(document).on('click', '.editbtn', function(){
	$('#stepbystep_new').modal("show");
	$('.step_title').text("Update step");
	$('.changevalues').text("Update Step");
	document.getElementById("centralbtn").classList.add("update");
	document.getElementById("centralbtn").classList.remove("create");
});



load_cur_materials();


function load_cur_materials(){
  var action = "Load";
  var recipeid = $('#recipeid').val();
  
  $.ajax(
            {
                url:'actions/fetch_edit_recipe.php',
                type:'POST',
                data:'action=' + action + '&recipeid=' + recipeid,
				dataType:'html',

                success:function(data)
                {
					$("#materials_table").html(data);
                },
            });
}


 $(document).on('click', '.insert', function(){
	var cur_action = "Insert";
	var recipeid = $('#recipeid').val();
	var selected_material = $('#selected_material').val();
	var quantity = $('#quantity').val();
	var note = $('#note').val();
	
	$.ajax(
            {
                url:'actions/fetch_edit_recipe.php',
                type:'POST',
                data:'recipeid=' + recipeid + '&action=' + cur_action + '&material=' + selected_material + '&quantity=' + quantity + '&note=' + note,
				dataType:'html',

                success:function(data)
                {
					$('#selected_material').prop('selectedIndex',0);
					document.getElementById("select2-selected_material-container").innerHTML = "Select Material";
					document.getElementById("select2-selected_material-container").title = "Select Material";
					$('#quantity').val("");
					$('#note').val("");
					load_cur_materials();										
                },
            });
	
});




$(document).on('click', '.delete', function(){
	var quantityid = $(this).attr("value");
	var cur_action = "Delete";
	
	if (confirm("Delete this material from this recipe?")) {
    
		$.ajax(
            {
                url:'actions/fetch_edit_recipe.php',
                type:'POST',
                data:'quantityid=' + quantityid + '&action=' + cur_action,

                success:function(data)
                {
					load_cur_materials();
                },
            });
			
	}
	
});



//load / insert / delete steps

load_cur_steps();


function load_cur_steps(){
  var step_action = "Load";
  var recipeid = $('#recipeid').val();
  
  $.ajax(
            {
                url:'actions/fetch_edit_recipe_steps.php',
                type:'POST',
                data:'step_action=' + step_action + '&recipeid=' + recipeid,
				dataType:'html',

                success:function(data)
                {
					$("#all_steps").html(data);
                },
            });
}



 $(document).on('click', '.create', function(){
	var step_action = "Insert";
	var recipeid = $('#recipeid').val();
	var stepname = $('#stepname').val();
	var performance = $('#performance').val();
	var description_step = $('#description_step').val();
	
	if (($('#stepname').val() != "") && ($('#description_step').val() != "")){
		
		$.ajax(
				{
					url:'actions/fetch_edit_recipe_steps.php',
					type:'POST',
					data:'recipeid=' + recipeid + '&step_action=' + step_action + '&stepname=' + stepname + '&performance=' + performance + '&description_step=' + description_step,
					dataType:'html',

					success:function(data)
					{
						$('#stepbystep_new').modal('hide');
						$('#lastperf').val(performance);
						$('#performance').val("");
						$('#stepname').val("");
						$('#description_step').val("");
						load_cur_steps();
					},
				});	
	}else{
		alert("Step and Description are required!");
	}
});




$(document).on('click', '.trashbtn', function(){
	var stepid = $(this).attr("value");
	var step_action = "Delete";
	
	if (confirm("Delete this step from this recipe?")) {
    
		$.ajax(
            {
                url:'actions/fetch_edit_recipe_steps.php',
                type:'POST',
                data:'stepid=' + stepid + '&step_action=' + step_action,

                success:function(data)
                {
					load_cur_steps();
                },
            });
			
	}
	
});



$(document).on('click', '.editbtn', function(){
	var stepid = $(this).attr("value");
	var step_action = "Select";
    
		$.ajax(
            {
                url:'actions/fetch_edit_recipe_steps.php',
                type:'POST',
                data:'stepid=' + stepid + '&step_action=' + step_action,
				dataType:'json',
				
                success:function(data)
                {
					$('#performance').val(data.Performance);
					$('#stepname').val(data.CurrentStep);
					$('#description_step').val(data.Description);
					$('#stepid').val(data.StepID);
                },
            });
});


$(document).on('click', '.update', function(){
	var stepid = $('#stepid').val();
	var stepname = $('#stepname').val();
	var performance = $('#performance').val();
	var description_step = $('#description_step').val();
	var step_action = "Update";
    
		$.ajax(
            {
                url:'actions/fetch_edit_recipe_steps.php',
                type:'POST',
                data:'stepid=' + stepid + '&step_action=' + step_action + '&stepname=' + stepname + '&performance=' + performance + '&description_step=' + description_step,
				
                success:function(data)
                {
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
 $(document).on('click', '.remove_thumbnail', function(){
	var action = "Remove_thumbnail";
	var current_thumbnail = $('#prev_thumbnail').val();
	
	$.ajax(
            {
                url:'actions/fetch_edit_recipe.php',
                type:'POST',
                data:'current_thumbnail=' + current_thumbnail + '&action=' + action,
				dataType:'html',

                success:function(data)
                {
					$("#cur_thumb").attr("src","../../images/dishes/emptydish.jpg");
                },
            });
	
});
</script>

</body>
</html>
