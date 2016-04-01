<?php
set_include_path ('../');
include_once 'header.php';
if ($_SESSION['logged_in'] != 3){
    echo '<h1>Please log in as admin!</h1>';
    die();
}
include_once 'dbaccess.php';
?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            <!-- Page Heading -->
            <div class="text-center">
                <h1>Database Contents</h1>
            </div>
            <hr>

			<!-- Table -->
			<h3>Users Table</h3>
			<table class="table table-striped">
				<thead>
					<tr>
                        <th></th>
						<th>uwinid</th>
						<th>fullname</th>
						<th>rating</th>
                        <th>upload_date</th>
                        <th>has_uploaded</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM users";
						$result = $db->query($sql);
						while($row = $result->fetch_array()){
                            $uwinid = $row['uwinid'];
							$fullname = $row['fullname'];
                            $rating = $row['rating'];
							$date = $row['upload_date'];
                            $hasuploaded = $row['hasuploaded'];

							echo "<tr><td>"."<a href=\"edituser.php?id=".$uwinid."\">Edit</a>".
                            "</td><td>".$uwinid.
                            "</td><td>".$fullname.
                            "</td><td>".$rating.
                            "</td><td>".$date.
                            "</td><td>".$hasuploaded.
                            "</td></tr>";
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
