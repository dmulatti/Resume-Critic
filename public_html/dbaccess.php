<?php
// Replace with your own values!!
$db = new mysqli('localhost', 'dbUsername', 'dbPassword', 'dbName');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>
