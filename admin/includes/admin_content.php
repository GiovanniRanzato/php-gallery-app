<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard
            <small>Subheading</small>
        </h1>
        <?php 
        echo "all users: <br>";
        $users=User::find_all_users();
        foreach ($users as $user){
            echo $user->username."<br>";
        }
        $id=1;
        echo "user with id: $id <br>";
        $single_user=User::find_user_by_id($id);
        echo $single_user->username;

        ?>
      

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->