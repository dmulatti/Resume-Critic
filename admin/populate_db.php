<?php

function addToDB($db, $uwinid, $fullname, $password, $rating, $hasuploaded){
    require ('assets/password.php');
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (uwinid, fullname, password, rating, hasuploaded) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdi", $uwinid, $fullname, $hashedpassword, $rating, $hasuploaded);
    $result = $stmt->execute();

    if ($result == false){
        echo '<h1>Failure! Error: ';
        echo $db->error;
        echo '</h1>';
    }
    return $result;
}

set_include_path ('../');
$dir = '../';
include_once 'header.php';
include_once "dbaccess.php"; //produces $db object


$result1 = addToDB($db, "testone", "Test One", "password", "2", "0");
$result2 = addToDB($db, "testtwo", "Test Two", "password", "3.4", "1");
$result3 = addToDB($db, "testthree", "Test Three", "password", "2.5", "0");
$result4 = addToDB($db, "testfour", "Test Four", "password", "4.5", "1");
$result5 = addToDB($db, "admin", "Admin Dude", "password", "5", "1");



if (($result1 && $result2 && $result3 && $result4 && $result5) == true)
    echo '<h1>Success!</h1>';
else
    echo '<h1>Something Failed.';
    echo $db->error;
    echo '</h1>'
 ?>

 <button id="return" class="btn btn-primary">Return to Admin Control Panel</button>
 <script type="text/javascript">
     document.getElementById("return").onclick = function () {
         location.href = "/admin.php";
     };
 </script>

 <?php include_once 'footer.php'; ?>
