<?php
class ControllersController extends AppController {

	var $name = 'Controllers';

	function admin_index() {
		$this->Controller->recursive = 0;
		$this->set('controllers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid controller', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('controller', $this->Controller->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Controller->create();
			if ($this->Controller->save($this->data)) {
				$this->Session->setFlash(__('The controller has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The controller could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid controller', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Controller->save($this->data)) {
				$this->Session->setFlash(__('The controller has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The controller could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Controller->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for controller', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Controller->delete($id)) {
			$this->Session->setFlash(__('Controller deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Controller was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
