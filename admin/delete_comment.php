<?php
set_include_path ('../');
include_once 'header.php';
if ($_SESSION['logged_in'] != 3){
    echo '<h1>Please log in as admin!</h1>';
    die();
}
include_once 'dbaccess.php';

if (isset($_GET['id']))
    $comment_id = $_GET['id'];
else
    die('no id specified!');


$stmt = $db->prepare('DELETE FROM comments WHERE comment_id=?');
$stmt->bind_param('i', $comment_id);
$stmt->execute();
$stmt->free_result();

header("Location: /admin/view_db.php#comments");
?>
