<?php
spl_autoload_register('Autoloader::autoloadTrait');
spl_autoload_register('Autoloader::autoloadDto');
spl_autoload_register('Autoloader::autoloadDao');
spl_autoload_register('Autoloader::autoloadLib');


class Autoloader{
    
     
    
    static function autoloadDto($class){
        $file = 'modele/DTO/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
      
    }
    
    static function autoloadLib($class){
        $file = 'lib/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
        
    }
    
    static function autoloadDao($class){
        $file = 'modele/DAO/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
        
    }
    
    static function autoloadTrait($class){
        $file = 'modele/traits/' . lcfirst($class) . '.php';
        if(is_file($file)&& is_readable($file)){
            require $file;
        }
        
    }
    
}


