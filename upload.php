<?php include_once 'dbaccess.php';

	$description = $_POST['uploaddescription'];
	$file_type=$_FILES['fileToUpload']['type'];
		
		if ($file_type != "application/pdf") {
			echo "must be a PDF $file_type";
			//header("Location: /resumeupload.php?test=notpdf");
		} 
		else {
			$name = $_SESSION['uwinid'];
			$result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "resumes/$name.pdf");
			if ($result == 1){
				echo "File successfully uploaded.";
				header("Location: /resumseditor.php?pdf=$name;");
			}
			else {
				echo "<p>There was a problem uploading the file.</p>";
				//header("Location: /resumeupload.php?test=failed");
			}
		} 
?>