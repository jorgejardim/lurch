<?php
/* Evento Test cases generated on: 2013-05-29 20:14:43 : 1369869283*/
App::import('Model', 'Evento');

class EventoTestCase extends CakeTestCase {
	var $fixtures = array('app.evento', 'app.user', 'app.group', 'app.convidado');

	function startTest() {
		$this->Evento =& ClassRegistry::init('Evento');
	}

	function endTest() {
		unset($this->Evento);
		ClassRegistry::flush();
	}

}
