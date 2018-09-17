<?php 

class Redirect{
    
    public static function to($name)
    {
        header('location: ' . $name . '.php');
    }
}

?>