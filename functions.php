<?php

    function classAutoLoader($class) {
        
        $class = strtolower($class);
        
        $thePath = "includes/{$class}.php";
        
        //if(file_exists($thePath)) {
        //    
        //    require_once($thePath);
        //    
        //} else {
        //    
        //    die("This file named {$class}.php was not found.");
        //    
        //}
        
        if(is_file($thePath) && !class_exists($class)){
            
            include $thePath;
            
        }
        
    }

    spl_autoload_register('classAutoLoader');

    function redirect($location){
        
        header("Location: {$location}");
        
    }

?>