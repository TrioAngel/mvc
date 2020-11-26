<?php
namespace Core;

class Router {
/*
 * Asociative array of routes (the routing table)
 * @var array
 * */

protected $routes = [];

/*Parameters from the matched routes
@var array*/

protected $params = [];

/*
 * Ass a route to the routing table
 *
 * @param string $route  The route URL
 * @param array $params Parameters (controllers, action, etc)
 *
 * return void*/

public function dispatch($url){

  $url = $this->removeQueryStringVariables($url);

  if($this->match($url)){
    $controller = $this->params['controller'];
    $controller = $this->convertToStudlyCaps($controller);
    $controller = "App\Controllers\\$controller";

    if(class_exists($controller)){
      $controller_object = new $controller($this->params);

      $action = $this->params['action'];
      $action = $this->convertToCamelCase($action);

      if(is_callable([$controller_object, $action])){
        $controller_object->$action();
      } else {
        echo "Method $action (in controller $controller) not found";
      }
    } else {
      echo "Controller class $controller not found";
    }
  } else {
    echo 'no route matched';
  }
}

/*
 * Convert the string with hyphens to StudylyCaps
 * e.q. port-authors => PostAuthors
 *
 * @param string $string the string to cpnvert
 * @return string*/
protected function convertToStudlyCaps($string){
  return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
}

/*
 * Convert the string with hyphens to camelcase,
 * e.g. add-new =? addNew
 * @param string $string the string to convert
 * @return string*/

protected function convertToCamelCase($string){
  return lcfirst($this->convertToStudlyCaps($string));
}


public function add ($route, $params = []){
//Convert the rout to a regExp:escape forward slashes
  $route = preg_replace('/\//', '\\/', $route);

  //Convert variables e.g. {controller}
  $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

  //convert variables with custom regExp e.g. {id:\d+}
  $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

  //add start and end delimiters and case insensitive flag
  $route = '/^' . $route . '$/i';

  $this->routes[$route] = $params;
}

/* Get all the routes from The routing table
@return array */

public function getRoutes(){
  return $this->routes;
}

/*Match the route to the routes in the routing table, setting the @params property if a route is found

@param string $url The route URL

@return boolean true if a match found, false otherwise*/

public function match($url){
  /*foreach ($this->routes as $route => $params){
    if($url == $route){
      $this->params = $params;
      return true;
    }
  }*/

  //Match to the fixed URL format /controller/action
//  $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z]+)$/";
  foreach ($this->routes as $route => $params){
    if(preg_match($route, $url, $matches)){
      //Get named capture group values
      // $params = [];

      foreach ($matches as $key => $match){
        if(is_string($key)){
          $params[$key] = $match;
        }
      }

      $this->params = $params;
      return true;
    }

  }

   return false;
}

/**Get the currently matched parameters
 @return array */

public function getParams(){
  return $this->params;
}

/*
 * @param string $url the full URL
 * @return string the URL with the wuery string variables removed
 * */

  protected function removeQueryStringVariables($url){
    if($url != ''){
      $parts = explode('&', $url, 2);

      if(strpos($parts[0], '=') === false){
        $url = $parts[0];
      } else {
        $url = '';
      }
    }
    return $url;
  }

}