<?php


class User
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

    public static function find_all()
    {
        return self::find_this_query("SELECT * FROM ".self::$db_table );
    }
    public static function find_by_id($id)
    {
        $the_result_array = self::find_this_query("SELECT * FROM ".self::$db_table." WHERE id= $id LIMIT 1");
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

        $sql = "SELECT * FROM ".self::$db_table." WHERE ";
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

    protected function properties () {
        //return get_object_vars($this);  // this method work only if there aren't any properties outside table fields names, but its never the case bacause there always be a porp for db_table name
        $properties= array();
        foreach ( self::$db_table_fields as $db_field){
            if (property_exists($this, $db_field)){
                $properties[$db_field]=$this->$db_field;
            }
        }
        return $properties;
    }
    protected function clean_properties (){
        global $database; 
        $clean_properties = array();
        foreach ($this->properties() as $key => $value){
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public function save(){
        return isset ($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database;
        $properties = $this->clean_properties();
         
        $sql = "INSERT INTO ".self::$db_table." ( ". implode(",", array_keys($properties) )." )";
        $sql .= "VALUES ('". implode ("','",array_values($properties) ). "')";
        console_log($sql);
        console_log($properties);

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false; 
        }
    }
    public function update()
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs =array();
        foreach($properties as $key=>$value){
            $properties_pairs[]= "{$key}= '{$value}' ";
        }

        $sql = "UPDATE ".self::$db_table." SET ". implode(",", $properties_pairs);
        $sql .= " WHERE id= "  . $database->escape_string($this->id);
        $database->query($sql);
        /* The  mysqli_affected_rows take the db connection as argument and return the numbbers of row affecte by the last query
           This is useful to update method because you can check how many updata has been done */
        return (mysqli_affected_rows($database->connection)) == 1 ? true : false;
    }
    public function delete()
    {
        global $database;
        $sql = "DELETE FROM ".self::$db_table." ";
        $sql .= " WHERE id= "  . $database->escape_string($this->id);
        $sql .= " LIMIT 1";
        console_log($sql);
        $database->query($sql);
        /* The  mysqli_affected_rows take the db connection an argument and return the numbbers of row affecte by the last query
           This is useful to update method because you can control how many updata has been done */
        return (mysqli_affected_rows($database->connection)) == 1 ? true : false;
    }
}// End User
