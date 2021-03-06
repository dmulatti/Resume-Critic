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
			header("Location: /resumeviewer.php?pdf=".$name);


			//upadte description, time, and boolean
			$stmt = $db->prepare('UPDATE users 	SET	description = ?,
													upload_date = CURRENT_TIMESTAMP,
													hasuploaded = 1
												WHERE
													uwinid = ?');
			$stmt->bind_param('ss', $description, $name);
			$stmt->execute();
			$stmt->free_result();



			//Insert update into comments
			$admin_uwinid = 'admin';
			$comment_name = 'UPDATED RESUME';
			$comment_data = '<em>User has uploaded a new resume.</em>';

			$stmt = $db->prepare('  INSERT INTO comments (uwinid,
		                                                commenters_uwinid,
		                                                commenters_fullname,
		                                                comment_data)
		                            VALUES (?,?,?,?)');
		    $stmt->bind_param('ssss', $name, $admin_uwinid, $comment_name, $comment_data);
		    $stmt->execute();
		    $stmt->free_result();
		}
		else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>
