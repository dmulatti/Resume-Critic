<?php
set_include_path ('../');
include_once 'dbaccess.php';
include_once 'header.php';
require ('assets/password.php');

$createtables=<<<EOF
CREATE TABLE IF NOT EXISTS `users` (
  `uwinid` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rating` double DEFAULT NULL,
  `upload_date` timestamp DEFAULT CURRENT_TIMESTAMP,
  `hasuploaded` boolean DEFAULT FALSE,
  `description` varchar(2048),
  PRIMARY KEY (`uwinid`)
);


CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `uwinid` varchar(20) NOT NULL,
  `commenters_uwinid` varchar(20) NOT NULL,
  `commenters_fullname` varchar(50) NOT NULL,
  `comment_date` timestamp NOT NULL,
  `comment_data` varchar(2048) NOT NULL,
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`uwinid`) REFERENCES `users`(`uwinid`),
  FOREIGN KEY (`commenters_uwinid`) REFERENCES `users`(`uwinid`)
);

CREATE TABLE IF NOT EXISTS `ratings` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `uwinid` varchar(20) NOT NULL,
  `raters_uwinid` varchar(20) NOT NULL,
  `rating` double NOT NULL,
  PRIMARY KEY (`rating_id`),
  FOREIGN KEY (`uwinid`) REFERENCES `users`(`uwinid`),
  FOREIGN KEY (`raters_uwinid`) REFERENCES `users`(`uwinid`)
);
EOF;

if ($db->multi_query($createtables) === true)
    echo '<h1>Success! Tables Created.</h1>';
else
    echo '<h1>Failure! Error: ';
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
