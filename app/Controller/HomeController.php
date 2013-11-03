<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/22
 * Time: 16:23
 * To change this template use File | Settings | File Templates.
 */
class HomeController extends AppController {

    public $helpers = array("Html", "Form");

    public function index() {
        $this->log("home index", "debug");
        if ($this->Session->read("User.me")) {
            return $this->redirect(array("controller"=>"Todos", "action"=>"index"));
        }
    }

}