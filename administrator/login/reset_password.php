<?php
/* Password reset process, updates database with new user password */
require '../../connection.php';
session_name("session3");
session_start();

// Make sure the form is being submitted with method="post"
if (isset($_POST["apply_btn"])) { 

    // Make sure the two passwords match
    if ( $_POST['new_password'] == $_POST['confirm_password'] ) { 

        $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $connect->escape_string($_POST['email']);
        $hash = $connect->escape_string($_POST['hash']);
        
        $sql = "UPDATE admins SET `Password`='$new_password', `Hash`='$hash' WHERE `Email`='$email'";

        if ( $connect->query($sql) ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: index.php");    

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: index.php");    
    }

}else{
	header("Location: index.php");
}
?>