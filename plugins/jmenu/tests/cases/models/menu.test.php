<?php
/* Menu Test cases generated on: 2011-12-05 17:54:32 : 1323114872*/
App::import('Model', 'Jmenu.Menu');

class MenuTestCase extends CakeTestCase {
	function startTest() {
		$this->Menu =& ClassRegistry::init('Menu');
	}

	function endTest() {
		unset($this->Menu);
		ClassRegistry::flush();
	}

}
