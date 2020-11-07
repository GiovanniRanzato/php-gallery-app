<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>
<?php
$message_success = "";
$message_errors = "";
if (isset($_POST['submit'])) {
    $user = new User();
    if ($user) {
        $user->username = $_POST['username'];
        $user->image = $_POST['image'];
        $user->first_name = $_POST['first_name'];
        $user->second_name = $_POST['second_name'];
        $user->password = $_POST['password'];
        if ($user->save()) {
            $message_success = "User added successfully!";
        } else {
            $message_errors = join("<br>", $photo->errors);
        }
    }
} ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/top_nav.php") ?>
    <?php include("includes/side_nav.php") ?>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <!-- Page Heading -->
            <div class="col-md-12">
                <h1 class="page-header">
                    Add User
                    <small>Subheading</small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php include("includes/message.php"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="add_user.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" value="" aria-label="title" placeholder="username">
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" aria-label="file">
                    </div>
                    <div class="form-group">
                        <label for="first_name">First name: </label>
                        <input type="text" name="first_name" class="form-control" value="" placeholder="first name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name: </label>
                        <input type="text" name="last_name" class="form-control" value="" placeholder="last name">
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input name="password" class="form-control" type="password" value="">
                    </div>
                    <input type="submit" name="submit" value="Save" class="btn btn-primary btn-lg pull-right">
                </form>

            </div>
        </div>
    </div>
</div>

<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<?php include("includes/footer.php"); ?>