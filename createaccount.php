<?php
$headextra=<<<SCRIPTS
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="/validate/validate_createaccount.js"></script>
SCRIPTS;


include_once 'header.php'; ?>




    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">


                <!-- Page Heading -->
                <div class="text-center">
                    <h1>Create New Account</h1>
                </div>
                <hr>


                <!-- Forms -->
                <div class="well">
                    <form id="newuserform" class="required" method="POST" action="createaccount_go.php">
                        <div class="form-group">
                            <label for="uwinid">UWinID</label>
                            <input type="text" class="form-control" id="uwinid" name="uwinid" placeholder="UWinID" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name = "fullname" placeholder="Bob Loblaw">
                        </div>
                        <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfpEBwTAAAAAK_eBGjsH6nw0_5spyV9FQc6kZeU"></div>
                        <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
                        <br/>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>



            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

<?php include_once 'footer.php'; ?>
