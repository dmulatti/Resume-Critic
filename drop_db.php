<?php
include_once 'dbaccess.php';
include_once 'header.php';

if ($db->multi_query('DROP TABLE comments; DROP TABLE users;') === true)
    echo '<h1>Success! Tables Dropped.</h1>';
else
    echo '<h1>Failure! Error: ';
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
