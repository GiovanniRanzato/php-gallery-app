<?php 
    
    defined ('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // DIRECTORY_SEPARATOR is a system constant for '\'
    defined ('SITE_ROOT') ? null : define('SITE_ROOT', 'C:'. DS .'MAMP'. DS .'htdocs'. DS .'php-gallery-app');
    defined ('INCLUDES_PATH') ? null : define('INCLUDES_PATH', 'C:'. DS .'MAMP'. DS .'htdocs'. DS .'php-gallery-app'. DS .'includes');
    
    require_once("functions.php");
    require_once("new_config.php");
    require_once("database.php");
    require_once("db_object.php");
    require_once("user.php");
    require_once("photo.php");
    require_once("session.php");
    
?>