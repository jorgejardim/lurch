<?php
class GroupsController extends AppController {

	var $name = 'Groups';

	function admin_index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Group->create();
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The', true).' '.__('Group', true).' '.__('has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The', true).' '.__('Group', true).' '.__('could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid', true).' '.__('group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The', true).' '.__('Group', true).' '.__('has been saved.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The', true).' '.__('Group', true).' '.__('could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Group->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for', true).' '.__('group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Group->delete($id)) {
			$this->Session->setFlash(__('Group', true).' '.__('deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Group', true).' '.__('was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
