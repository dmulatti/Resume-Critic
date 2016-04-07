<?php
include_once 'header.php';
include_once 'dbaccess.php';

if ($_SESSION['logged_in'] == 0){
	echo ('<h1>Must be logged in!</h1>');
	die ();
}


$uwinid = $_SESSION['uwinid'];
$file = "resume/" . $uwinid . ".pdf";

if (file_exists($file)){
	unlink($file);
	$stmt = $db->prepare('UPDATE users SET hasuploaded = 0, description=NULL, rating=NULL WHERE uwinid = ?');
	$stmt->bind_param('s', $uwinid);
	$stmt->execute();
	$stmt->free_result();

	$stmt = $db->prepare('DELETE FROM comments WHERE uwinid = ?');
	$stmt->bind_param('s', $uwinid);
	$stmt->execute();
	$stmt->free_result();

	$stmt = $db->prepare('DELETE FROM ratings WHERE uwinid = ?');
	$stmt->bind_param('s', $uwinid);
	$stmt->execute();
	$stmt->free_result();

	$success = true;
}
else {
	$success = false;
}


?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">


        <?php if ($success): ?>
            <!-- Page Heading -->
            <div class="text-center">
                <h1>Done!</h1>
            </div>
            <hr>

            <p class="lead text-center">
                Your resume has been deleted.
            </p>

        <?php else: ?>
            <!-- Page Heading -->
            <div class="text-center">
                <h1>Oh no!</h1>
            </div>
            <hr>

            <p class="lead text-center">
                We couldn't delete your resume. Please contact the admins!
            </p>
        <?php endif; ?>

        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->






<?php include_once 'footer.php'; ?>
