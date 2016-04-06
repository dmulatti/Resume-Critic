<?php include_once 'header.php'; ?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">


            <!-- Page Heading -->
            <div class="text-center">
                <h1>Something happened!</h1>
            </div>
            <hr>

            <p class="lead text-center">
				<?php $error = trim($_GET['error']);
					if ($error == 2){
						echo "Sorry, that file is too large! Your file was not uploaded.";
					}
					else if ($error == 3){
						echo "Sorry, only PDFs can be uploaded! Your file was not uploaded.";	
					}
					else if ($error == 4)
						echo "Sorry, wrong username or password";
					else{
						echo "Sorry, something went wrong and your file was not uploaded.";
					}
				?>
			</p>

        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<?php include_once 'footer.php' ?>
