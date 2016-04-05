<?php
$headextra =<<<EXTRA
<style>
.inline h4, h5{
    display: inline;
}
</style>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="/validate/validate_contact.js"></script>
EXTRA;
include_once 'header.php';
include_once 'dbaccess.php';

$name = '';
$email = '';

if ($_SESSION['logged_in'] > 0){
    $email = $_SESSION['uwinid'] . '@uwindsor.ca';
    $stmt = $db->prepare('SELECT fullname FROM users WHERE uwinid = ?');
    $stmt->bind_param("s", $_SESSION['uwinid']);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
}
?>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">


            <!-- Page Heading -->
            <div class="text-center">
                <h1>Contact us</h1>
            </div>
            <hr>


            <p>
                <h2>Open Source</h2>
            </p>
            <p>
                This website is entirely open source, and the code can be found
                on <a href="https://github.com/dmulatti/Web-Development-Project">GitHub by clicking here.</a>
                If you find a bug, or want to improve the site,
                feel free to fork the repo and make a pull request! Or, email us below.
            </p>
            <hr>
            
            <p>
                <h2>Who We Are</h2>
            </p>
            <p>
                <div class="inline">
                    <h4>David Mulatti</h4>  <h5>(<a href="mailto:mulatti@uwindsor.ca">mulatti@uwindsor.ca</a>)</h5>
                </div>

                David is a third year Computer Science student at the
                University of Windsor. He is currently trying really hard to
                think of something to put in here.
            </p>

            <p>
                <div class="inline">
                    <h4>Kyle Petrozzi</h4>  <h5>(<a href="mailto:petrozz1@uwindsor.ca">petrozz1@uwindsor.ca</a>)</h5>
                </div>
                Kyle is a fourth year Computer Science student at the
                University of Windsor. He will graduate in spring 2016 with Applied Computing Honours Co-Op.
            </p>
            <hr>



            <p>
                <h2>Questions, Comments, Concerns?</h2>
                If you have any comments, an idea for the site, or have found
                a bug somewhere, please email us! We'd love to hear what you think.
            </p>
            <br>

					<div class="well form-center">
						<form id="contactForm" name="contactForm" class="required" method="POST" action="contact_go.php">
							<div class="form-group">
								<label for="contactName">Name</label>
								<input type="text" class="form-control" id="contactName" name="contactName" placeholder="Enter your name" value="<?php echo $name; ?>">
							</div>
							<div class="form-group">
								<label for="contactEmail">Email</label>
								<input type="email" class="form-control" id="contactEmail" name="contactEmail" placeholder="Enter email" value="<?php echo $email; ?>">
							</div>
                            <div class="form-group">
                                <label for="textarea">Message</label>
								<textarea id="contactMessage" name="contactMessage"></textarea>
							</div>
                            <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfpEBwTAAAAAK_eBGjsH6nw0_5spyV9FQc6kZeU"></div>
                            <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
                            <br/>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
					<hr>

        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<?php include_once 'footer.php' ?>
