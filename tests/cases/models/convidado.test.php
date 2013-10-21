<?php
/* Convidado Test cases generated on: 2013-05-29 20:14:35 : 1369869275*/
App::import('Model', 'Convidado');

class ConvidadoTestCase extends CakeTestCase {
	var $fixtures = array('app.convidado', 'app.evento');

	function startTest() {
		$this->Convidado =& ClassRegistry::init('Convidado');
	}

	function endTest() {
		unset($this->Convidado);
		ClassRegistry::flush();
	}

}
