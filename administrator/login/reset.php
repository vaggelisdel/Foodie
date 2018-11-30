<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require '../../connection.php';
session_name("session3");
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $connect->escape_string($_GET['email']); 
    $hash = $connect->escape_string($_GET['hash']); 

    // Make sure user email with matching hash exist
    $result = $connect->query("SELECT * FROM admins WHERE `Email`='$email' AND `Hash`='$hash'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: index.php");
    }
}
else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    header("location: index.php");  
}

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
<div class="login-box">
  <div class="login-logo">
    <img src="../dashboard/dist/img/logo_admin.png"/>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Create new password</p>

      <form action="reset_password.php" method="post">
        <div class="form-group has-feedback">
          <input required type="password" name="new_password" class="form-control" placeholder="New Password">
        </div>
		<div class="form-group has-feedback">
          <input required type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
        </div>
			<input type="hidden" name="email" value="<?= $email ?>">    
			<input type="hidden" name="hash" value="<?= $hash ?>">  
          <!-- /.col -->
            <button type="submit" name="apply_btn" class="btn btn-primary btn-block btn-flat">Apply</button>
          <!-- /.col -->
      </form>

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
