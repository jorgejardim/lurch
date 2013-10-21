<?php
/* Locais Test cases generated on: 2013-06-10 15:53:50 : 1370890430*/
App::import('Controller', 'Locais');

class TestLocaisController extends LocaisController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class LocaisControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.locai', 'app.user', 'app.group');

	function startTest() {
		$this->Locais =& new TestLocaisController();
		$this->Locais->constructClasses();
	}

	function endTest() {
		unset($this->Locais);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
