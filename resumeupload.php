<?php include_once 'header.php'; ?>

	<div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

				<!-- Page Heading -->
                <div class="text-center">
                    <h1>Resume Upload</h1>
                </div>

				<div class="well">			
					<form id='upload' action='upload.php' method='post' enctype="multipart/form-data">
								
						<div class="form-group">
							<label for='uploaddescription' >Description:</label>
							<textarea class="form-control-large" name='uploaddescription' id='uploaddescription' cols= "50" rows = "10" form="upload"></textarea> 
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
