<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/07
 * Time: 21:58
 * To change this template use File | Settings | File Templates.
 */

require_once ('codebird.php');
use Codebird\Codebird;

App::uses("AppController", "Controller");
App::uses("Todo", "Model");

class TodosController extends AppController {

    private $cb = null;

    // コンストラクター
    public function __construct($request, $response) {
        parent::__construct($request, $response);
        Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
        $this->cb = Codebird::getInstance();
    }

    public function beforeFilter() {
        parent::beforeFilter();

        // ログインしていない場合はHomeに飛ばす
        $this->log("todos beforefilter", "debug");
        if (!$this->Session->read("User.me")) {
            $this->Session->setFlash("ログインを行ってください");
            return $this->redirect(array("controller"=>"Home", "action"=>"index"));
        }
    }

    public function index() {
        $this->log("todos index", "debug");
        if ($this->Session->read("User.me")) {
            $twUser = $this->Session->read("User.me");

            $this->cb->setToken($twUser->tw_access_token, $twUser->tw_access_token_secret);
            $tweets = $this->cb->statuses_homeTimeline();
            $this->log("twido logging", "debug");

            $this->set("twUser", $twUser);
            $this->set("tweets", $tweets);
        }
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