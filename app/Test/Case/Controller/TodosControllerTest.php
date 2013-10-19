<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/07
 * Time: 22:51
 * To change this template use File | Settings | File Templates.
 */
class TodosControllerTest extends ControllerTestCase {

    public $fixtures = array('app.Todo');

    public function setUp() {
        parent::setUp();
        $this->Todo = ClassRegistry::init('Todo');
    }

//    public function tearDown() {
//        parent::tearDown();
//    }

//    static public function setupBeforeClass() {
//        echo "setupBeforeClass";
//    }
//
//    static public function tearDownAfterClass() {
//        echo "tearDownAfterClass";
//    }

    public function testIndex() {
        $result = $this->testAction('/todos/');
        $result = json_decode($result, true);
        debug($result);
//        $this->assertEquals($expected, $result);
    }

}