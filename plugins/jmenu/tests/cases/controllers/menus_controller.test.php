<?php
/* Menus Test cases generated on: 2011-12-05 17:54:43 : 1323114883*/
App::import('Controller', 'Jmenu.Menus');

class TestMenusController extends MenusController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MenusControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Menus =& new TestMenusController();
		$this->Menus->constructClasses();
	}

	function endTest() {
		unset($this->Menus);
		ClassRegistry::flush();
	}

}
