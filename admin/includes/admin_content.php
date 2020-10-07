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
 
        $users=User::find_all();
        foreach ($users as $user){
            echo $user->username."<br>";
        }
        $id=1;
        echo "user with id: $id <br>";
        $single_user=User::find_by_id($id);
        echo $single_user->username;


        // $new_user = new User();
        // $new_user->username = "aaaa";
        // $new_user->password = "bbbb";
        // $new_user->first_name = "cccc";
        // $new_user->last_name = "dddd";
        // $new_user->create(); //comment out to avoid creation on db

        //$updated_user= User::find_user_by_id(4);
        //$updated_user->username = "minnie";
        //$updated_user->update();

        //$deleted_user= User::find_user_by_id(4);
        //$deleted_user->username = "minnie";
        //$deleted_user->delete();
        // $saved_user = User::find_user_by_id(8);
        // $saved_user->username= "edited user name";
        // $saved_user->save();

        // $saved_user = User::find_user_by_id(8);
        // $saved_user->delete();

        $created_user = User::find_by_id(3);
        $created_user->last_name="dfsdfsdfsfsfsdf";
        $created_user->save();





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