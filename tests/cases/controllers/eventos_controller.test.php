<?php
/* Eventos Test cases generated on: 2013-05-29 20:15:04 : 1369869304*/
App::import('Controller', 'Eventos');

class TestEventosController extends EventosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EventosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.evento', 'app.user', 'app.group', 'app.convidado');

	function startTest() {
		$this->Eventos =& new TestEventosController();
		$this->Eventos->constructClasses();
	}

	function endTest() {
		unset($this->Eventos);
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
