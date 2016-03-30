<?php
if(empty($_POST['uwinid']) || empty($_POST['password']) || empty($_POST['fullname'])){
    header("Location: newusererror.php");
    die ('not enough info');
}

require ('assets/recaptcha/autoload.php');
require ('assets/password.php'); //for password_hash function
include_once('assets/recaptcha/secret.php'); //produces $secret

$recaptcha = new \ReCaptcha\ReCaptcha($secret);

$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
if (!$resp->isSuccess()) {
    $errors = $resp->getErrorCodes();
    header("Location: newusererror.php");
    die('Captcha not verified');
}


$uwinid = $_POST['uwinid'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$fullname = mb_convert_case($_POST['fullname'], MB_CASE_TITLE);


include_once "dbaccess.php"; //produces $db object
$stmt = $db->prepare("INSERT INTO users (uwinid, fullname, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $uwinid, $fullname, $password);
$result = $stmt->execute();

if ($result == false){
    header("Location: newusererror.php");
    die('error adding user');
}
$stmt->free_result();



include_once 'header.php';
?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">


            <!-- Page Heading -->
            <div class="text-center">
                <h1>Welcome, <?php echo $fullname;?>!</h1>
            </div>
            <hr>

            <p class="lead text-center">
                Thanks for registering! You can now log in with your uWinID and
                the password you specified. We hope you enjoy the site!
            </p>


        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->






<?php include_once 'footer.php'; ?>
