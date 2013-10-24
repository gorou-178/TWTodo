<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/07
 * Time: 21:58
 * To change this template use File | Settings | File Templates.
 */

App::uses("AppController", "Controller");
App::uses("Todo", "Model");

class TodosController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        // ログインしていない場合はHomeに飛ばす
        $this->log("todos beforefilter", "debug");
    }

    public function index() {
        $this->log("todos index", "debug");
    }

    public function add() {
        $this->log("todos add", "debug");
    }

    public function edit($id = null) {
        $this->log("todos edit", "debug");
    }

    public function delete($id = null) {
        $this->log("todos delete", "debug");
    }

}