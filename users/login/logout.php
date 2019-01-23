<?php

require '../../connection.php';
session_name("session3");
session_start();
$_SESSION['user_authorized'] = 0;
$_SESSION["user_message"] = "Μόλις αποσυνδεθήκατε!";
header("Location: alert.php");