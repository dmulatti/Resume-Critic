<?php

function addToDB($db, $uwinid, $fullname, $password, $hasuploaded){
    require ('assets/password.php');
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (uwinid, fullname, password, hasuploaded) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $uwinid, $fullname, $hashedpassword, $hasuploaded);
    $result = $stmt->execute();

    if ($result == false){
        echo '<h1>Failure! Error: ';
        echo $db->error;
        echo '</h1>';
    }
    return $result;
}


include_once "dbaccess.php"; //produces $db object
include_once 'header.php';

$result1 = addToDB($db, "testone", "Test One", "password", "0");
$result2 = addToDB($db, "testtwo", "Test Two", "password", "1");
$result3 = addToDB($db, "testthree", "Test Three", "password", "0");
$result4 = addToDB($db, "testfour", "Test Four", "password", "1");



if (($result1 && $result2 && $result3 && $result4) == true)
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
