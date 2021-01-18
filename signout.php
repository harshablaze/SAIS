<?php
session_start();

unset($_SESSION['user_id']);

session_destroy();
session_unset(); 

header("location: login.php?signout=1");
?>