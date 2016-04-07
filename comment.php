<?php
include_once 'dbaccess.php';
session_start();
if ($_SESSION['logged_in'] == 0){
	echo ('Must be logged in!');
	die ();
}

if (!isset($_GET['id']))
    die('What uwinid tho?');

if (!isset($_POST['comment']))
    die('tfw no comment');


$commenters_uwinid = $_SESSION['uwinid'];
$uwinid = $_GET['id'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];


if (isset($rating)){
	$stmt = $db->prepare('SELECT EXISTS(SELECT 1 FROM ratings WHERE uwinid = ? AND raters_uwinid = ?)');
	$stmt->bind_param ('ss', $uwinid, $commenters_uwinid);
	$stmt->execute();
	$stmt->bind_result($hasrated);
	$stmt->fetch();
	$stmt->free_result();


	if ($hasrated)
	    $stmt = $db->prepare('UPDATE ratings SET rating = ? WHERE uwinid = ? AND raters_uwinid = ?');
	else
		$stmt = $db->prepare('INSERT INTO ratings (rating, uwinid, raters_uwinid) VALUES (?,?,?)');

	    $stmt->bind_param ('dss', $rating, $uwinid, $commenters_uwinid);
	    $stmt->execute();
	    $stmt->free_result();
}


if(!empty($comment)){

	//prevent images and links and whatnot from showing up in comments
	$comment = strip_tags($comment, '<b><i><u>');

    $stmt = $db->prepare('SELECT fullname FROM users WHERE uwinid = ?');
    $stmt->bind_param ('s', $commenters_uwinid);
    $stmt->execute();
    $stmt->bind_result($fullname);
    $stmt->fetch();
    $stmt->free_result();

    $stmt = $db->prepare('  INSERT INTO comments (uwinid,
                                                commenters_uwinid,
                                                commenters_fullname,
                                                comment_data)
                            VALUES (?,?,?,?)');
    $stmt->bind_param('ssss', $uwinid, $commenters_uwinid, $fullname, $comment);
    $stmt->execute();
    $stmt->free_result();
}


//Always reset rating

$rating = 0;
$numRatings = 0;

$stmt = $db->prepare('SELECT rating FROM ratings WHERE uwinid=?');
$stmt->bind_param('s', $uwinid);
$stmt->execute();
$stmt->bind_result($aRating);
while ($stmt->fetch()){
	if ($aRating > 0){
		$rating += $aRating;
		$numRatings += 1;
	}
}
$newRating = $rating/$numRatings;
$stmt->free_result();

$stmt = $db->prepare('UPDATE users SET rating = ? WHERE uwinid = ?');
$stmt->bind_param('ds', $newRating, $uwinid);
$stmt->execute();
$stmt->free_result();


header("Location: /resumeviewer.php?pdf=".$uwinid);
?>
