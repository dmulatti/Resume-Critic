<?php
$headextra=<<<HEAD
<link href="/star_rating/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="/star_rating/js/star-rating.min.js" type="text/javascript"></script>
<style>
.inline h2{
    display: inline;
}
</style>
HEAD;


include_once 'dbaccess.php';
include_once 'header.php';


if (!isset($_GET['pdf']))
    die ("Error!");

$uwinid = stripslashes($_GET['pdf']);

if ($_SESSION['logged_in'] > 0){
    $myuwinid = $_SESSION['uwinid'];
    $loggedin = true;
}
else {
    $loggedin = false;
}

$stmt = $db->prepare('SELECT EXISTS(SELECT 1 FROM users WHERE uwinid = ?)');
$stmt->bind_param ('s', $uwinid);
$stmt->execute();
$stmt->bind_result($exists);
$stmt->fetch();
$stmt->free_result();

$stmt = $db->prepare('SELECT hasuploaded FROM users WHERE uwinid = ?');
$stmt->bind_param ('s', $uwinid);
$stmt->execute();
$stmt->bind_result($hasuploaded);
$stmt->fetch();
$stmt->free_result();

if (!$exists)
    die ('<h1>user does not exist!</h1>');
if (!$hasuploaded)
    die ('<h1>user has not uploaded a resume :(</h1>');


$stmt = $db->prepare('SELECT fullname FROM users WHERE uwinid = ?');
$stmt->bind_param ('s', $uwinid);
$stmt->execute();
$stmt->bind_result($fullname);
$stmt->fetch();
$stmt->free_result();


$stmt = $db->prepare('SELECT description FROM users WHERE uwinid = ?');
$stmt->bind_param ('s', $uwinid);
$stmt->execute();
$stmt->bind_result($description);
$stmt->fetch();
$stmt->free_result();

$stmt = $db->prepare('SELECT rating FROM users WHERE uwinid = ?');
$stmt->bind_param ('s', $uwinid);
$stmt->execute();
$stmt->bind_result($rating);
$stmt->fetch();
$stmt->free_result();

$hasrated=false;

if ($loggedin){
    $stmt = $db->prepare('SELECT EXISTS(SELECT 1 FROM ratings WHERE uwinid = ? AND raters_uwinid = ?)');
    $stmt->bind_param ('ss', $uwinid, $myuwinid);
    $stmt->execute();
    $stmt->bind_result($hasrated);
    $stmt->fetch();
    $stmt->free_result();
}

if ($hasrated){
    $stmt = $db->prepare('SELECT rating FROM ratings WHERE uwinid = ? AND raters_uwinid = ?');
    $stmt->bind_param ('ss', $uwinid, $myuwinid);
    $stmt->execute();
    $stmt->bind_result($myrating);
    $stmt->fetch();
    $stmt->free_result();
}

 ?>



 <div class="container-fluid">
     <div class="row">
       <div class="col-sm-12">
         <div class="inline">
             <table>
                 <tr>
                     <td style="padding-right:10px">
                         <h2><?php echo $fullname;?>'s Resume - </h2>
                     </td>
                     <td>
                         <input id="star-rating" value="<?php echo $rating; ?>" class="rating-loading" data-size="xs" >
                    </td>
                </tr>
            </table>
        </div>
      </div>
    </div>

    <div class="row">

             <div class="col-sm-8">
                 <object align = "left" height="750px" width="100%" data="resume/<?php echo $uwinid ?>.pdf"></object>
             </div>



             <div class="col-sm-4">
             <div class="comments">
                 <h3>Description</h3>
                 <?php echo $description; ?>
                 <hr>
                 <h3>Comments</h3>
                 <hr>
                 <?php
                 $stmt = $db->prepare('SELECT   commenters_fullname,
                                                comment_date,
                                                comment_data
                                                FROM comments WHERE
                                                uwinid = ?
                                                ORDER BY comment_date DESC');

                 $stmt->bind_param('s', $uwinid);
                 $stmt->execute();
                 $stmt->bind_result($commenters_fullname, $comment_date, $comment_data);
                 while ($stmt->fetch()){
                 ?>
                     <strong><?php echo $commenters_fullname; ?>: </strong>
                     <?php echo $comment_data; ?>
                     <br><small><?php echo $comment_date; ?></small>
                     <hr>
                 <?php
                 }
                 $stmt->free_result();
                ?>
            </div>
            <hr>

            <?php if ($loggedin): ?>
             <div class="well">

                 <form id='commentForm' action='comment.php?id=<?php echo $uwinid; ?>' method='post'>

                     <div class="form-group" >
                         <label for='comment' >Comment:</label>
                         <textarea align="right" class="form-control-large" name='comment'
                         id='comment' cols= "50" rows = "10"></textarea>
                     </div>
                     <div class="form-group">
                         <input id="comment-star-rating" name="rating" value="<?php echo $myrating; ?>" class="rating" data-size="xs" >
                     </div>

                     <input class="btn btn-primary" type='submit' name='commentButton' value='Submit' />

                 </form>
             </div>
           <?php endif; ?>

         </div>
     </div> <!-- /.row -->

 </div> <!-- /.container-fluid -->

 <script>
 $(document).on('ready', function(){
     $('#star-rating').rating({displayOnly: true, step: 0.5});
 });
 </script>

<?php include_once 'footer.php'; ?>
