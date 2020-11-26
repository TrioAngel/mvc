<?php

namespace App\Controllers\Admin;

class Users extends \Core\Controller {

  /*before filter
  @return void
  */
  protected function before(){
    //Make sure an admin user is Logged in for example
    //return false;
  }

  /*
   * Show the index page
   * @return void
   * */
  public function indexAction(){
    echo "User admin index";
  }

  /*
   * after filter
   * @return void*/
  protected function after(){
    //some after void
  }

}