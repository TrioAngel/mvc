<?php

//echo "Requested URL: " . $_SERVER['QUERY_STRING'];

//Require the controller class
require '../App/Controllers/Posts.php';


//Routing
require '../Core/Router.php';

$router = new Router();

//echo get_class($router);

//Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
/*
//Display the routing table
echo '<pre>';
//print_r($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes()), true);
echo '</pre>';

//Match the requested route
$url = $_SERVER['QUERY_STRING'];

if($router->match($url)){
  echo '<pre>';
  print_r($router->getParams());
  echo '</pre>';
} else {
  echo "no route found for URL '$url'";
}*/

$router->dispatch($_SERVER['QUERY_STRING']);