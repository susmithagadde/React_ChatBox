<?php

$request = $_SERVER['REQUEST_URI'];
$uri = implode('/', 
            array_slice(
                explode('/', $_SERVER['REQUEST_URI']), 3)); 

//echo $uri;die;

switch ($uri) {
       
    case 'register' :
        require __DIR__ . '.\api\demo.php';
        break;
        
    case 'login' :
        require __DIR__ . '.\api\login.php';
        break;
        
    case 'home' :
        require __DIR__ .'.\api\home.php';
        break;
    
    case 'save' :
        require __DIR__ .'.\api\save.php';
        break;
        
    case 'msg' :
        require __DIR__ .'.\api\msg.php';
        break;
   
}