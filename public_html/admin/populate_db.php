<?php

function addToDB($db, $uwinid, $fullname, $password){
    require ('assets/password.php');
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (uwinid, fullname, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $uwinid, $fullname, $hashedpassword);
    $result = $stmt->execute();

    if ($result == false){
        echo '<h1>Failure! Error: ';
        echo $db->error;
        echo '</h1>';
    }
    return $result;
}

set_include_path ('../');
include_once 'header.php';
include_once "dbaccess.php"; //produces $db object


$result1 = addToDB($db, "testone", "Test One", "password");
$result2 = addToDB($db, "testtwo", "Test Two", "password");
$result3 = addToDB($db, "testthree", "Test Three", "password");
$result4 = addToDB($db, "testfour", "Test Four", "password");
$result4 = addToDB($db, "admin", "Admin Dude", "password");



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
         location.href = "/admin/";
     };
 </script>

 <?php include_once 'footer.php'; ?>
