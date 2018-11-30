<?php
	require '../../connection.php';
	session_name("session3");
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	if ($_SESSION["admin_authorised"] == 1){
		header("Location: ../dashboard");
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../dashboard/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<center>
<?php if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): ?>
	<div class="alert alert-danger alert-dismissible admin_dash_alerts">
        <i class="icon fa fa-bell"></i>
        <?php 
			echo $_SESSION["message"]; 
			$_SESSION['message'] = "";
		?>
    </div>
<?php endif; ?>
</center>
<div class="login-box">
  <div class="login-logo">
    <img src="../dashboard/dist/img/logo_admin.png"/>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to admin dashboard</p>

      <form action="login.php" method="post">
        <div class="form-group has-feedback">
          <input required type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group has-feedback">
          <input required type="password" name="password" class="form-control" placeholder="Password">
        </div>
          <!-- /.col -->
            <button type="submit" name="signin_btn" class="btn btn-primary btn-block btn-flat">Sign In</button>
          <!-- /.col -->
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="../../" class="btn btn-block btn-danger">
          Go back to homepage
        </a>
      </div>
      <!-- /.social-auth-links -->

        <a href="forget_password.php">I forgot my password</a>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
