<?php
    /*
    * Returns true is uwinid does not exist in database,
    * and false if it already exists.
    * Used for form validation in creating a new account
    */
    set_include_path ('../');
    include_once 'dbaccess.php';

    $uwinid = $_GET["uwinid"];


    $stmt = $db->prepare("SELECT uwinid FROM users WHERE uwinid = ?");
    $stmt->bind_param("s", $uwinid);
    $stmt->execute();
    $result = $stmt->get_result();


    if($result->num_rows == 0)
        echo 'true';
    else
        echo 'false';
?>
