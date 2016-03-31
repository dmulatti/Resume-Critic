<?php   
session_start(); //to ensure you are using same session
$_SESSION['logged_in'] = true;
header("Location: /index.php"); //to redirect back to "index.php" after logging out
exit();
?>