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

    public $components = array('RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();

        if (!$this->request->is('ajax')) throw new BadRequestException('Ajax以外でのアクセスは許可されていません。');
        $this->response->header('X-Content-Type-Options', 'nosniff');
    }

    public function index() {
        // 自動ですべて文字列に変換されるのを防ぐ
        $pdo = $this->Todo->getDatasource()->getConnection();
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $todos = $this->Todo->find('all');
        $this->set(array(
            'todos' => $todos,
            '_serialize' => arsray('todos')
        ));
    }

    // 今回のアプリケーションではToDo個別表示はしないのでviewはいらないが例として表示
    public function view($id = null) {
        $todo = $this->Todo->findById($id);
        $this->set(array(
            'todo' => $todo,
            '_serialize' => array('todo')
        ));
    }

    public function add() {
        $this->Todo->create();
        if ($this->Todo->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message'    => $message,
            '_serialize' => array('message')
        ));
    }

    public function edit($id = null) {
        $this->Todo->id = $id;
        if ($this->Todo->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function delete($id = null) {
        if ($this->Todo->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

}