<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>
<?php
$message_success = "";
$message_errors = "";
$user_id = "";
if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
} else {
    redirect("users.php");
}
$user = User::find_by_id($user_id);
console_log($_FILES);
if (isset($_POST['submit'])) {
    if ($user) {
        $user->id = $user_id;
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        
        if( file_exists($_FILES['image']['tmp_name']) ) {
            $user->set_file($_FILES["image"]); 
        }
        if ($user->save()) {
            $message_success = "User updated successfully!";
        } else {
            $message_errors = join("<br>", $user->errors);
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
                    Edit User
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
            <div class="col-md-6" >
                <img class="admin-user-image" src="<?php echo $user->image_path() ?>" alt="<?php echo $user->username ?>">
            </div>
            <div class="col-md-6 ">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>" aria-label="title" placeholder="username">
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" aria-label="file" value="<?php echo $user->image; ?>">
                    </div>
                    <div class="form-group">
                        <label for="first_name">First name: </label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>" placeholder="first name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name: </label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>" placeholder="last name">
                        <label for="password">Password: </label>
                        <input name="password" class="form-control" type="password" value="<?php echo $user->password; ?>">
                    </div>
                    <a name="delete" value="Delete" class="btn btn-danger btn-lg" href="delete_user.php?id=<?php echo $user->id ?>" >Delete</a>
                    <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg pull-right">
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