<?php
/* Autoload function will automatically load files from $the_path and including if non included yet */
function classAutoLoader ($class)
{
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
    if (is_file($the_path)  && !class_exists($class) ) {
        include $the_path;
    } else {
        die("Impossible to find file: {$class}.php");
    }
}
spl_autoload_register('classAutoLoader');

function redirect($location){
    header ("Location: {$location}");
}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

?>