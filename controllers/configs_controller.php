<?php
class ConfigsController extends AppController {

	var $name = 'Configs';

	function admin_index() {
		
		$id = 1;

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid', true).' '.__('Config', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Config->save($this->data)) {
				$this->Session->setFlash(__('The', true).' '.__('Config', true).' '.__('has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The', true).' '.__('Config', true).' '.__('could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Config->read(null, $id);
		}
	}
}
