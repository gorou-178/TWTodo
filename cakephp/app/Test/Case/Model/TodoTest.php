<?php
App::uses('Todo', 'Model');

/**
 * Todo Test Case
 *
 */
class TodoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.todo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Todo = ClassRegistry::init('Todo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Todo);

		parent::tearDown();
	}

}
