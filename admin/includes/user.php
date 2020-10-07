<?php


class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array("username","password","first_name","last_name");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    /* TEST INSTANTIATION 
    There is no point in create this function. You can inizialize the proprety after creating an istance because are public.
    This can create also issues on security because indirectly turn instantation in a public function.
    public static function create_user($userdata){
        return self::instantation($userdata);
    }
    END TEST INSTANTATION */

    
    // Method to check if user exist on DB 
    // Return User() or false
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string(($username));
        $password = $database->escape_string(($password));

        $sql = "SELECT * FROM ".self::$db_table." WHERE ";
        $sql .= "username= '{$username}' ";
        $sql .= "AND password= '{$password}' LIMIT 1";

        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
 
}// End User
