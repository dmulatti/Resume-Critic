<?php
set_include_path ('../');
include_once 'header.php';


if ($_SESSION['logged_in'] != 3){
    echo '<h1>Please log in as admin!</h1>';
    die();
}

include_once 'dbaccess.php';

$usersdbexists = $db->query('SELECT 1 FROM users');
$commentsdbexists = $db->query('SELECT 1 FROM comments');
$dbexists = ($usersdbexists && $commentsdbexists);

if ($dbexists)
    $dbstatus = 'OK';
else
    $dbstatus = 'Does not exist!';

    ?>


<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">


            <!-- Page Heading -->
            <div class="text-center">
                <h1>Admin Control Panel</h1>
            </div>
            <hr>


            <h3>Database Status: <?php echo $dbstatus; ?></h3>
            <hr>

            <?php if ($dbexists){ ?>
                <button id="viewdb" class="btn btn-primary">View Database</button> <hr>
                <button id="populatedb" class="btn btn-primary">Populate Database With Sample Data</button> <hr>
                <button id="dropdb" class="btn btn-danger">Drop Database</button>
                <script type="text/javascript">
                    document.getElementById("dropdb").onclick = function () {
                        if (window.confirm("Are you sure? All user data will be gone forever!"))
                            location.href = "drop_db.php";
                            };
                    document.getElementById("populatedb").onclick = function () {
                            location.href = "populate_db.php";
                            };
                    document.getElementById("viewdb").onclick = function () {
                            location.href = "view_db.php";
                            };
                </script>

            <?php } else{ ?>
                <button id="createdb" class="btn btn-primary">Create Database</button>
                <script type="text/javascript">
                    document.getElementById("createdb").onclick = function () {
                        location.href = "/create_db.php";
                    };
                </script>
            <?php } ?>




        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->


<?php include_once 'footer.php'; ?>
