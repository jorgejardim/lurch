<?php
/* Conteudo Test cases generated on: 2013-06-10 12:40:49 : 1370878849*/
App::import('Model', 'Conteudo');

class ConteudoTestCase extends CakeTestCase {
	var $fixtures = array('app.conteudo');

	function startTest() {
		$this->Conteudo =& ClassRegistry::init('Conteudo');
	}

	function endTest() {
		unset($this->Conteudo);
		ClassRegistry::flush();
	}

}
