<?php 
/* Reset your password form, sends reset.php password link */
require '../../connection.php';
session_name("session3");
session_start();

// Check if form submitted with method="post"
if (isset($_POST["forgetpass_btn"])) 
{   
    $email = $connect->escape_string($_POST['email']);
    $result = $connect->query("SELECT * FROM admins WHERE `Email` ='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['message'] = "Admin with that email doesn't exist!";
        header("location: forget_password.php");
    }
    else { // User exists (num_rows != 0)

        $admin = $result->fetch_assoc(); // $user becomes array with user data
        
        $email = $admin['Email'];
        $hash = $admin['Hash'];
        $name = $admin['Name'];
		$domain = $_SERVER['SERVER_NAME'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
        . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Password Reset Link (Foodie)';
        $message_body = '
        Hello '.$name.',

        You have requested password reset!

        Please click this link to reset your password:

        http://'.$domain.'/admin/login/reset.php?email='.$email.'&hash='.$hash;

        mail($to, $subject, $message_body);

        header("location: index.php");
  }
}else{
	header("Location: forget_password.php");
}
?>