<?php


namespace App\Controllers;


class Home extends \Core\Controller {
/*
 * Show the index page
 * @return void*/
public function indexAction(){
  echo "hello from the index action in the Home controller";
}

/*
 * Before filter
 * @return void
 * */
protected function before(){
  echo "{before} ";
//  return false;
}

/*
 * After filter
 * @return void
 * */
protected function after(){
  echo " {after}";
}


}