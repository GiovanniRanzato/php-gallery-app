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

        // My SOLUTION:
        // $user_data = array (
        //     'username' => 'pippo',
        //     'password' => 'paperino',
        //     'first_name' => 'pippo',
        //     'last_name' => 'paperino'
        // );
        // $new_user = User::create_user($user_data);
        // $new_user->create();
        $new_user = new User();
        $new_user->username = "pluto";
        $new_user->password = "pippo";
        $new_user->first_name = "topolino";
        $new_user->second_name = "pluto";
        // $new_user->create(); comment out to avoid creation on db
        $updated_user= User::find_user_by_id(4);
        $updated_user->username = "minnie";
        $updated_user->update();

        $deleted_user= User::find_user_by_id(4);
        $deleted_user->username = "minnie";
        $deleted_user->delete();




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