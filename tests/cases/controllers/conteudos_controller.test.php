<?php
/* Conteudos Test cases generated on: 2013-06-10 12:41:10 : 1370878870*/
App::import('Controller', 'Conteudos');

class TestConteudosController extends ConteudosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ConteudosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.conteudo');

	function startTest() {
		$this->Conteudos =& new TestConteudosController();
		$this->Conteudos->constructClasses();
	}

	function endTest() {
		unset($this->Conteudos);
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
