<?php


class User
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users()
    {
        return self::find_this_query("SELECT * FROM users");
    }
    public static function find_user_by_id($user_id)
    {
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id= $user_id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        /* Map query result in array of object usiong instantation method */
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantation($row);
        }
        return $the_object_array;
    }
    // Method to check if user exist on DB 
    // Return User() or false
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string(($username));
        $password = $database->escape_string(($password));

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username= '{$username}' ";
        $sql .= "AND password= '{$password}' LIMIT 1";
  
        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    private static function instantation($the_record)
    {

        $the_object = new self;
        /* Loop to record proprieties and initialize each to the relative value */
        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }
    private function has_the_attribute($the_attribute)
    {
        $object_proprieties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_proprieties);
    }
}
