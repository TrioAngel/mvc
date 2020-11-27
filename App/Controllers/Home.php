<?php


namespace App\Controllers;

use \Core\View;


class Home extends \Core\Controller {
/*
 * Show the index page
 * @return void*/
public function indexAction(){
//  echo "hello from the index action in the Home controller";
  View::render('Home/index.php', [
    'name' => 'Dave',
    'colours' => ['red', 'green', 'yellow']
  ]);
}

/*
 * Before filter
 * @return void
 * */
protected function before(){
//  echo "{before} ";
//  return false;
}

/*
 * After filter
 * @return void
 * */
protected function after(){
//  echo " {after}";
}


}