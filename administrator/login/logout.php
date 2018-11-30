<?php

require '../../connection.php';
session_name("session3");
session_start();
$_SESSION['admin_authorised'] = 0;
$_SESSION["message"] = "You are logged out!";
header("Location: index.php");