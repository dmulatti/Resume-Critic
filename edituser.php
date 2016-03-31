<?php
$headextra=<<<SCRIPTS
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="validate_edituser.js"></script>
SCRIPTS;

include_once 'header.php';

if ($_SESSION['logged_in'] == 3){
    $admin = true;
    if (isset($_GET['id']))
        $uwinid = $_GET['id'];
    else
        $uwinid = $_SESSION['uwinid'];
}
else if ($_SESSION['logged_in'] == 1){
    $admin = false;
    $uwinid = $_SESSION['uwinid'];
}
else {
    echo '<h1>Must be logged in!</h1>';
    die();
}



include_once 'dbaccess.php';

$stmt = $db->prepare("SELECT fullname, rating, upload_date, hasuploaded FROM users WHERE uwinid=?");
$stmt->bind_param("s", $uwinid);
$stmt->execute();
$stmt->bind_result($fullname, $rating, $date, $hasuploaded);
$stmt->fetch();

?>




    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">


                <!-- Page Heading -->
                <div class="text-center">
                    <h1>Edit User<?php if ($admin): ?> - (Admin) <?php endif; ?></h1>
                </div>
                <hr>


                <!-- Forms -->
                <div class="well">
                    <form id="edituserform" method="POST" action="edituser_go.php?id=<?php echo $uwinid; ?>">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name = "fullname" placeholder="Bob Loblaw" value="<?php echo $fullname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password (optional)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <?php if($admin): ?>
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <input type="text" class="form-control" id="rating" name = "rating" placeholder="Bob Loblaw" value="<?php echo $rating; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="hasuploaded">hasuploaded</label>
                                <input type="text" class="form-control" id="hasuploaded" name = "hasuploaded" placeholder="Bob Loblaw" value="<?php echo $hasuploaded; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="uwinid">UWinID to Update</label>
                                <input type="text" class="form-control" id="uwinid" name="uwinid" placeholder="UWinID" value="<?php echo $uwinid; ?>" required>
                            </div>
                        <? endif; ?>

                        <br/>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>



            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

<?php include_once 'footer.php'; ?>
