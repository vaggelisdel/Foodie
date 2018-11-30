<?php  
require '../../connection.php';
session_name("session3");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);


if(isset($_POST["login_btn"])){
	
	 $email_login = mysqli_real_escape_string($connect, $_POST["email_login"]);
	 $result = $connect->query("SELECT * FROM users WHERE `Email`='$email_login'");
	 
	 if ( $result->num_rows == 0 ){ // User doesn't exist
		$_SESSION['user_message'] = "Δεν βρέθηκε χρήστης με αυτό το email!";
		header("Location: alert.php");
		
	}else{
		
		$user = $result->fetch_assoc();
		
		if ( password_verify($_POST['pass_login'], $user['Password'])) {
			$userid = $user['UserID'];
			
			$_SESSION['userid'] = $userid;
			$_SESSION['active'] = $user['Active'];
			
			if ($_SESSION['active'] == 0){
				$_SESSION['user_message'] = "Δεν έχετε ακόμα επιβεβαιώσει τον λογαριασμό σας!";
				$_SESSION['user_authorized'] = 0;
				header("Location: alert.php");
			}else{				
				$_SESSION['user_authorized'] = 1;
				header("Location: ../dashboard");
			}
			
		}else{
			
			$_SESSION['user_message'] = "Έχετε εισάγει λανθασμένο κωδικό πρόσβασης, προσπαθήστε ξανά!";
			header("Location: alert.php");
			
		}
	}
}else{
	header("Location: index.php");
}
?>