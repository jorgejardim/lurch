<?php
/* Locai Test cases generated on: 2013-06-10 15:53:38 : 1370890418*/
App::import('Model', 'Locai');

class LocaiTestCase extends CakeTestCase {
	var $fixtures = array('app.locai', 'app.user', 'app.group');

	function startTest() {
		$this->Locai =& ClassRegistry::init('Locai');
	}

	function endTest() {
		unset($this->Locai);
		ClassRegistry::flush();
	}

}
