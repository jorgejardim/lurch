<?php
/* Convidados Test cases generated on: 2013-05-29 20:15:18 : 1369869318*/
App::import('Controller', 'Convidados');

class TestConvidadosController extends ConvidadosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ConvidadosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.convidado', 'app.evento', 'app.user', 'app.group');

	function startTest() {
		$this->Convidados =& new TestConvidadosController();
		$this->Convidados->constructClasses();
	}

	function endTest() {
		unset($this->Convidados);
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
