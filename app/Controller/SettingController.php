<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/22
 * Time: 16:25
 * To change this template use File | Settings | File Templates.
 */

class SettingController extends AppController {

    public $helpers = array("Html", "Form");

    public function index() {
        $this->log("setting index", "debug");
    }

    public function update() {
        $this->log("setting update", "debug");
    }

}