<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect("login.php");
} ?>
<?php
$message = "";
if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    console_log($_FILES);
    $photo->set_file($_FILES['file_upload']);
    if ($photo->save()) {
        $message = "Photo uploaded successfully!";
    } else {
        $message = join("<br>", $photo->errors);
    }
}
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/top_nav.php") ?>
    <?php include("includes/side_nav.php") ?>
</nav>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Upload
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb col-sm-12">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
                <div class="col-md-6">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" value="" placeholder="image name..." aria-label="img name">
                        </div>
                        <div class="form-group">
                            <input type="file" name="file_upload" aria-label="file">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="submit" name="submit">
                        </div>
                    </form>
                    <?php
                    echo $photo->errors ? "<div class='bg-danger'>" : "<div class='bg-success'>";
                    echo $message;
                    echo "</div>"
                    ?>
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>