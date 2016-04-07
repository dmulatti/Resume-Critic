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

							echo "<tr><td>"."<a href=\"/edituser.php?id=".$uwinid."\">Edit</a>".
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

            <hr>

            <a name="comments"></a>
            <h3>Comments Table</h3>
			<table class="table table-striped">
				<thead>
					<tr>
                        <th></th>
						<th>comment_id</th>
						<th>uwinid</th>
						<th>commenters_uwinid</th>
                        <th>commenters_fullname</th>
                        <th>comment_date</th>
                        <th>comment_data</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM comments";
						$result = $db->query($sql);
						while($row = $result->fetch_array()){
                            $comment_id = $row['comment_id'];
							$uwinid = $row['uwinid'];
                            $commenters_uwinid = $row['commenters_uwinid'];
							$commenters_fullname = $row['commenters_fullname'];
                            $comment_date = $row['comment_date'];
                            $comment_data = $row['comment_data'];

							echo
                            "<tr><td>"."<a href=\"/admin/delete_comment.php?id=".$comment_id."\">Delete</a>".
                            "</td><td>".$comment_id.
                            "</td><td>".$uwinid.
                            "</td><td>".$commenters_uwinid.
                            "</td><td>".$commenters_fullname.
                            "</td><td>".$comment_date.
                            "</td><td>".$comment_data.
                            "</td></tr>";
						}
					?>
				</tbody>
			</table>

            <hr>

            <h3>Ratings Table</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>rating_id</th>
						<th>uwinid</th>
						<th>raters_uwinid</th>
                        <th>rating</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM ratings";
						$result = $db->query($sql);
						while($row = $result->fetch_array()){
                            $rating_id = $row['rating_id'];
							$uwinid = $row['uwinid'];
                            $raters_uwinid = $row['raters_uwinid'];
							$rating = $row['rating'];

							echo
                            "<tr><td>".$rating_id.
                            "</td><td>".$uwinid.
                            "</td><td>".$raters_uwinid.
                            "</td><td>".$rating.
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
