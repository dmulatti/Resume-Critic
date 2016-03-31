<?php
include_once 'header.php';
require ('assets/password.php'); //for password_hash function


if ($_SESSION['logged_in'] == 3){
    $admin = true;
    $rating = $_POST['rating'];
    $hasuploaded = $_POST['hasuploaded'];
    $uwinid = $_POST['uwinid'];
}
else{
    $admin = false;
    $uwinid = $_SESSION['uwinid'];
}


if (!empty($_POST['password'])){
    $changepw = true;
    $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
}
else {
    $changepw = false;
}



$fullname = mb_convert_case($_POST['fullname'], MB_CASE_TITLE);


include_once "dbaccess.php"; //produces $db object

if ($changepw){
    $stmt = $db->prepare("UPDATE users SET fullname = ?, password = ? WHERE uwinid = ?");
    $stmt->bind_param("sss", $fullname, $newpassword, $uwinid);
    $stmt->execute();
    $stmt->free_result();
}
else{
    $stmt = $db->prepare("UPDATE users SET fullname = ? WHERE uwinid = ?");
    $stmt->bind_param("ss", $fullname, $uwinid);
    $stmt->execute();
    $stmt->free_result();
}

if ($admin){
    $stmt = $db->prepare("UPDATE users SET rating = ?, hasuploaded = ? WHERE uwinid = ?");
    $stmt->bind_param("sss", $rating, $hasuploaded, $uwinid);
    $stmt->execute();
    $stmt->free_result();
}

?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">


            <!-- Page Heading -->
            <div class="text-center">
                <h1><?php echo $uwinid; ?> has been updated!</h1>
            </div>
            <hr>


        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->






<?php include_once 'footer.php'; ?>
