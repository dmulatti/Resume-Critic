<?php
	include_once 'dbaccess.php';
	require ('assets/password.php');
	session_start(); //to ensure you are using same session

	$myusername=$_POST['username'];
	$mypassword=$_POST['password'];


	$stmt = $db->prepare("SELECT password FROM users WHERE uwinid=?");
	$stmt->bind_param("s", $myusername);
	$result = $stmt->execute();

	if ($result == false){
		echo'error: ';
		echo $db->error;
		die();
	}

	$stmt->store_result();
	$count = $stmt->num_rows;

	$stmt->bind_result($hashedPass);
	$stmt->fetch();

	$check = password_verify($mypassword, $hashedPass);


	if($count == 1 && $check){
		$_SESSION['uwinid'] = $myusername;
		$_SESSION['logged_in'] = 1;
		header("Location: /index.php"); //to redirect back to "index.php" after logging out
	}
	else {
		echo "Wrong Username or Password";
	}
?>
