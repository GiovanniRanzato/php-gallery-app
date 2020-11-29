<?php


class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array("username", "image", "password", "first_name", "last_name");
    public $id;
    public $username;
    public $image;
    public $password;
    public $first_name;
    public $last_name;
    public $upload_directory = "images";
    public $image_placeholder = "user_image_placeholder.png";
    /* TEST INSTANTIATION 
    There is no point in create this function. You can inizialize the proprety after creating an istance because are public.
    This can create also issues on security because indirectly turn instantation in a public function.
    public static function create_user($userdata){
        return self::instantation($userdata);
    }
    END TEST INSTANTATION */

    // This is passing $_FILES[uploaded_file] as an argument

    public $tmp_name; // used to upload image

    public  function set_file($file)
    {
        if (empty($file) || !$file) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->image = basename($file['name']); // basename escape file name
            $this->tmp_name = $file['tmp_name'];
            $this->upload_image();
        }
    }

    public function upload_image()
    {
        // Errors handling
        if (!empty($this->errors)) {
            return false;
        }
        if (empty($this->image) ||  empty($this->tmp_name)) {
            $this->errors[] = "No file name or temporary path found!";
            return false;
        }
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->image;
        // Uploading file
        if (move_uploaded_file($this->tmp_name, $target_path)) {
            unset($this->tmp_name);
            return true;
        } else {
            $this->errors[] = "A unexpected error occured while uploading the file... try to check directory permission.";
            return false;
        }
    }
    public function image_path()
    {
        return empty($this->image) ? $this->upload_directory . DS . $this->image_placeholder : $this->upload_directory . DS . $this->image;
    }


    // Method to check if user exist on DB 
    // Return User() or false
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string(($username));
        $password = $database->escape_string(($password));

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username= '{$username}' ";
        $sql .= "AND password= '{$password}' LIMIT 1";

        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
}// End User
