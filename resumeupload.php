<?php
include_once 'header.php';
include_once 'dbaccess.php';

if ($_SESSION['logged_in'] == 0){
	echo ('<h1>Must be logged in!</h1>');
	die ();
}



$stmt = $db->prepare('SELECT hasuploaded FROM users WHERE uwinid=?');
$stmt->bind_param('s', $_SESSION['uwinid']);
$stmt->execute();
$stmt->bind_result($hasuploaded);
$stmt->fetch();
$stmt->free_result();
?>

	<div class="container-fluid">
        <div class="row">

			<?php if ($hasuploaded): ?>
				<div class="col-sm-8">
					<object align = "left" height="750px" width="100%" data="resume/<?php echo $_SESSION['uwinid'] ?>.pdf"></object>
				</div>



				<div class="col-sm-4">
			<?php else: ?>
				<div class="col-sm-12">
			<?php endif; ?>
				<h2>Upload New Resume</h2>
				<hr>
				<div class="well">

					<form id='upload' action='upload.php' method='post' enctype="multipart/form-data">

						<div class="form-group" >
							<label for='uploaddescription' >Description:</label>

							<!-- php for description -->
							<?php
							    $descript = '';
							    $stmt = $db->prepare('SELECT description FROM users WHERE uwinid=?');
                                $stmt->bind_param('s', $_SESSION['uwinid']);
                                $stmt->execute();
                                $stmt->bind_result($descript);
                                $stmt->fetch();
								$stmt->free_result();
                            ?>
							<textarea align="right" class="form-control-large" name='uploaddescription'
							id='uploaddescription' cols= "50" rows = "10" form="upload"><?php echo $descript;?></textarea>
						</div>

						<div class="form-group">
							<label for='fileToUpload' >File:</label>
							<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						</div>


						<input class="btn btn-primary" type='submit' name='uploadButton' value='Upload' />
						
						<?php if ($hasuploaded): ?>
							<input class="btn btn-danger" type='button' id = 'deleteButton' name='deleteButton' value='Delete' />
							<script type="text/javascript">
			                    document.getElementById("deleteButton").onclick = function () {
			                        if (window.confirm("Are you sure? Your resume will be gone forever!"))
			                            location.href = "resumedelete.php";
			                            };
			                </script>
						<?php endif; ?>

					</form>
				</div>

	        </div>
        </div> <!-- /.row -->

	</div> <!-- /.container-fluid -->

<?php include_once 'footer.php'; ?>
