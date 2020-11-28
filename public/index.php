<?php


/**
 * Composer
 */
require '../vendor/autoload.php';


/**
 * Twig
 */
Twig_Autoloader::register();

/*
 * Autoloader*/

spl_autoload_register(function($class){
  $root = dirname(__DIR__); //get the parent directory
  $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
  if(is_readable($file)){
    require $root . '/' . str_replace('\\', '/', $class) . '.php';
  }
});

//Routing
$router = new Core\Router();


//Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');


$router->dispatch($_SERVER['QUERY_STRING']);