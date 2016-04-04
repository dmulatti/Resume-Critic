<?php 
	include_once 'dbaccess.php';
	session_start();
	
	$description = $_POST['uploaddescription'];
	$file_type=$_FILES['fileToUpload']['type'];
	$name = $_SESSION['uwinid'];
	
	$target_dir = "resume/";
	$target_file = $target_dir . $name . ".pdf";
	$uploadOk = 0;
	
	if(!isset($_POST["uploadButton"])) {
			$uploadOk = 1;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		//echo "Sorry, your file is too large.";
		$uploadOk = 2;
	}
	
	// Allow certain file formats
	if($file_type != "application/pdf") {
		echo "Sorry, only PDF files are allowed.";
		$uploadOk = 3;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk != 0) {
		//echo "Sorry, your file was not uploaded.";
		header("Location: /uploaderror.php?error=$uploadOk");
	}
	
		// if everything is ok, try to upload file
	else {
		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
			echo "The file ". basename( $_FILES['fileToUpload']['name']). " has been uploaded.";
			header("Location: /resumeupload.php");
			
			//update description
			$stmt = $db->prepare("UPDATE users SET description = ? WHERE uwinid = ?");
			$stmt->bind_param("ss",$description, $name);
			$stmt->execute();
			$stmt->free_result();			
			
			//update time
			$stmt = $db->prepare("UPDATE users SET upload_date = CURRENT_TIMESTAMP WHERE uwinid = ?");
			$stmt->bind_param("s", $name);
			$stmt->execute();
			$stmt->free_result();
			
			//update boolean
			$stmt = $db->prepare("UPDATE users SET hasuploaded = 1 WHERE uwinid = ?");
			$stmt->bind_param("s", $name);
			$stmt->execute();
			$stmt->free_result();
		} 
		else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>
