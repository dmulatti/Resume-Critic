<?php
/* If $headextra is set, it will include that string in the head of the
*  page. This can be used for extra scripts and whatnot.
*/
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Resume Critic</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<?php
    if (isset($headextra))
        echo $headextra;
	?>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Resume Critic</a>
            </div>
            <!-- /.navbar-header -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<?php if ($_SESSION['logged_in'] == 3) : ?>
					<li><a href="admin.php">Admin</a></li>
					<?php endif; ?>
                    <li><a href="createaccount.php">Create Account</a></li>
					 <li><a href="contact.php">Contact Us</a></li>
					<li>
					<?php if ($_SESSION['logged_in'] > 0) : ?>
						 <form class = 'logoutlabel' id='logout' action='logout.php' method='post'>
							<input type='submit' name='LogoutButton' value = 'Logout'/>
						</form>

					<?php else : ?>
						<form id='login' action='login.php' method='post'>
							<fieldset>
								<input type='hidden' name='submitted' id='submitted' value='1'/>
								<label class = 'loginlabel' for='username' >UWindsorID:</label>
								<input type='text' name='username' id='username'  maxlength="20" />
								<label class = 'loginlabel' for='password' >Password:</label>
								<input type='password' name='password' id='password' maxlength="60" />
								<input type='submit' name='LoginButton' value='Login' />
							</fieldset>
						</form>
					<?php endif; ?>
					</li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
