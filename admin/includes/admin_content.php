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
        echo "<br>";


        // $new_user = new User();
        // $new_user->username = "2aaaa";
        // $new_user->password = "2bbbb";
        // $new_user->first_name = "2cccc";
        // $new_user->last_name = "2dddd";
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
        //$created_user->save();


        echo "all photos: <br>";
 
        $photos=Photo::find_all();
        foreach ($photos as $photo){
            echo $photo->filename."<br>";
        }
        console_log($photos);


        $photo_id=1;
        echo "photo with id: $id <br>";
        $single_photo=Photo::find_by_id($photo_id);
        echo $single_photo->filename;

        $new_photo = new Photo();
        $new_photo->title = "2aaaa";
        $new_photo->description = "2bbbb";
        $new_photo->filename = "2bbbb";
        $new_photo->size = 12;
        //$new_photo->save(); //comment out to avoid creation on db

        $photo_id=5;
        $delete_photo=Photo::find_by_id($photo_id);
        // $delete_photo->delete();

        $photo_id=7;
        $edit_photo=Photo::find_by_id($photo_id);
        $edit_photo->filename= "Foto Nr.6";
        $edit_photo->update();





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