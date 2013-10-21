<?php

class ConteudosController extends AppController {

    var $name = 'Conteudos';

    function admin_index() {
        $this->Conteudo->recursive = 0;
        $this->paginate['order'] = array('Conteudo.pass');
        $this->paginate['limit'] = 500;
        $this->set('conteudos', $this->paginate());
        $this->set('title_for_layout', 'Conteúdos do Site');
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid conteudo', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('conteudo', $this->Conteudo->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Conteudo->create();
            if ($this->Conteudo->save($this->data)) {
                $this->Session->setFlash(__('The', true) . ' ' . __('Conteudo', true) . ' ' . __('has been saved.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The', true) . ' ' . __('Conteudo', true) . ' ' . __('could not be saved. Please, try again.', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid', true) . ' ' . __('conteudo', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Conteudo->save($this->data)) {
                $this->Session->setFlash('Conteúdo salvo com sucesso.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The', true) . ' ' . __('Conteudo', true) . ' ' . __('could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Conteudo->read(null, $id);
            $exp = explode(';', $this->data['Conteudo']['config']);
            foreach($exp as $v) {
                $campos[$v] = 1;
            }
            $this->set('campos', $campos);
        }
        $this->set('title_for_layout', 'Editar Conteúdo do Site');
    }

    function admin_deletexxx($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for', true) . ' ' . __('conteudo', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Conteudo->delete($id)) {
            $this->Session->setFlash(__('Conteudo', true) . ' ' . __('deleted', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Conteudo', true) . ' ' . __('was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

}
