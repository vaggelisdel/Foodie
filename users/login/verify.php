<?php 
/* Verifies registered user email, the link to this page
   is included in the register.php email message 
*/
require '../../connection.php';
session_name("session3");
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $connect->escape_string($_GET['email']); 
    $hash = $connect->escape_string($_GET['hash']); 
    
    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $connect->query("SELECT * FROM users WHERE `Email`='$email' AND `Hash`='$hash' AND `Active`='0'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['user_message'] = "Έχετε εισάγει λανθασμένο URL ή ο χρήστης με αυτό το email έχει ήδη ενεργοποιηθεί!";

        header("location: alert.php");
    }
    else {
        $_SESSION['user_message'] = "Ο λογαριασμός σας ενεργοποιήθηκε!";
        
        // Set the user status to active (active = 1)
        $connect->query("UPDATE users SET `Active`='1' WHERE `Email`='$email'") or die($connect->error);
        $_SESSION['active'] = 1;
        
        header("location: alert.php");
    }
}
else {
    $_SESSION['user_message'] = "Η ενεργοποίηση απέτυχε!";
    header("location: alert.php");
}     
?>