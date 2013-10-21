<?php
class LocaisController extends AppController {

	var $name = 'Locais';

	function admin_index() {
		$this->Locai->recursive = 0;
		$this->set('locais', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid locai', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('locai', $this->Locai->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Locai->create();
			if ($this->Locai->save($this->data)) {
				$this->Session->setFlash(__('The', true).' '.__('Locai', true).' '.__('has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The', true).' '.__('Locai', true).' '.__('could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Locai->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid', true).' '.__('locai', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Locai->save($this->data)) {
				$this->Session->setFlash(__('The', true).' '.__('Locai', true).' '.__('has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The', true).' '.__('Locai', true).' '.__('could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Locai->read(null, $id);
		}
		$users = $this->Locai->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for', true).' '.__('locai', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Locai->delete($id)) {
			$this->Session->setFlash(__('Locai', true).' '.__('deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Locai', true).' '.__('was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
