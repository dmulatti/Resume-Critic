<?php 	include_once 'header.php';
		include_once 'dbaccess.php';
?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            <!-- Page Heading -->
            <div class="text-center">
                <h1>Welcome!</h1>
            </div>
            <hr>

			<!-- Table -->
			<h3>Uploaded Resumes</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Date Uploaded</th>
						<th>Rating</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM users WHERE hasuploaded = 1 ORDER BY upload_date DESC";
						$result = $db->query($sql);
						while($row = $result->fetch_array()){
							$name = $row['fullname'];
							$date = $row['upload_date'];
							$rating = number_format($row['rating'], 2);
							$uwinid = $row['uwinid'];
							echo "<tr><td><a href=\"resumeviewer.php?pdf=".$uwinid."\">".$name."</a></td><td>".$date."</td><td>".$rating."</td></tr>";
						}
					?>
				</tbody>
			</table>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<?php include_once 'footer.php' ?>
