<?php include_once 'header.php';
include_once 'dbaccess.php';
session_start();
?>

	<div class="container-fluid">
        <div class="row">
				<!-- Page Heading -->
                <div class="text-center">
                    <h1>Resume Upload</h1>
                </div>



			<div class="col-sm-8">
				<object align = "left" height="750px" width="100%" data="resume/<?php echo $_SESSION['uwinid'] ?>.pdf"></object>
			</div>



			<div class="col-sm-4">
				<div class="well">

					<form id='upload' action='upload.php' method='post' enctype="multipart/form-data">

						<div class="form-group" >
							<label for='uploaddescription' >Description:</label>

							<!-- php for description -->
							<?php $stmt = $db->prepare('SELECT description FROM users WHERE uwinid=?');
                                $stmt->bind_param('s', $_SESSION['uwinid']);
                                $result = $stmt->execute();
                                $stmt->store_result();
                                $count = $stmt->num_rows;
                                $stmt->bind_result($descript);
                                $stmt->fetch();
                            ?>
							<textarea align="right" class="form-control-large" name='uploaddescription'
							id='uploaddescription' cols= "50" rows = "10" form="upload"><?php echo $descript;?></textarea>
						</div>

						<div class="form-group">
							<label for='fileToUpload' >File:</label>
							<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						</div>


						<input class="btn btn-primary" type='submit' name='uploadButton' value='Upload' />

					</form>
				</div>

	        </div>
        </div> <!-- /.row -->

	</div> <!-- /.container-fluid -->

<?php include_once 'footer.php'; ?>
