<?php
require '../../connection.php';
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
session_name("session3");
session_start();
if (isset($_POST['register_btn'])) {
// Escape all $_POST variables to protect against SQL injections
$surname = $connect->escape_string($_POST['surname_register']);
$username = $connect->escape_string($_POST['name_register']);
$email = $connect->escape_string($_POST['email_register']);
$password = $connect->escape_string(password_hash($_POST['password_register'], PASSWORD_BCRYPT));
$hash = $connect->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that email already exists
$result = $connect->query("SELECT * FROM users WHERE `Email`='$email'") or die($connect->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['user_message'] = 'Υπάρχει ήδη χρήστης με αυτό το email!';
    header("location: alert.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO `users` (`Name`,`Surname`, `Email`, `Password`, `Hash`) 
	                     VALUES ('$username', '$surname', '$email', '$password', '$hash');";
						 
	
						 

    // Add user to the database
    if ( $connect->query($sql) ){

		$domain = $_SERVER['SERVER_NAME'];
        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['user_authorized'] = 0; // So we know the user has logged in
        $_SESSION['user_message'] =
                
                 "Ελέγξτε στο email $email για την ενεργοποίηση του λογαριασμού σας";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Ενεργοποίηση λογαριασμού';
        $message_body = '
        Χαίρεται '.$username.' '.$surname.',

        Σας ευχαριστούμε για την εγγραφή σας.

        Παρακαλώ πατήστε στον παρακάτω σύνδεσμο για την ενεργοποίηση του λογαριασμού σας!

        http://'.$domain.'/users/login/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

        header("location: alert.php"); 

    }

    else {
        $_SESSION['user_message'] = 'Η εγγραφή απέτυχε!';
        header("location: alert.php");
    }

}
}