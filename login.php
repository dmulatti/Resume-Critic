<?php
	include_once 'dbaccess.php'; 
	require ('assets/password.php');
	session_start(); //to ensure you are using same session

	$myusername=$_POST['username']; 
	$mypassword=$_POST['password']; 

	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$sql = "SELECT * FROM users WHERE username='$myusername'";

	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$hashedPass = $row['password'];
	$check = password_verify($mypassword, $hashedPass);
	$count = mysql_num_rows($result);
	
	if($count == 1 && $check){
		session_register("myusername");
		$_SESSION['logged_in'] = 1;
		header("Location: /index.php"); //to redirect back to "index.php" after logging out
	}
	else {
		echo "Wrong Username or Password";
	}
?>