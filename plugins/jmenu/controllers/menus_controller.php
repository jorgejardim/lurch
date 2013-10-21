<?php
class MenusController extends JmenuAppController {

	var $name = 'Menus';
        var $helpers = array('Jmenu.Tree');

        function admin_index() {
            
                //grupo default
                if(isset($this->params['named']['g'])) {
                   $this->Session->write('group_selected', $this->params['named']['g']);                     
                }
                
                //lista            
		$this->Menu->recursive = 0;		
                $tree = $this->Menu->generatetreelist(array('Menu.group_id' => $this->Session->read('group_selected')), null, null, '_');
                $i = 0;
                if(count($tree)) {
                    foreach($tree as $k=>$v) {
                        $menus[$i] = $this->Menu->read(null, $k);
                        $menus[$i]['Menu']['name'] = $v;
                        ++$i;
                    }
                    $this->set('menus', $menus); 
                }
		$groups = $this->Menu->Group->find('list');
                $this->set('groups', $groups);                  
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menu', $this->Menu->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Menu->create();
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->Menu->Group->find('list');
                $parentMenus = $this->Menu->generatetreelist(null, null, null, '_');
                $this->set('groups', $groups);
                $this->set('parents', $parentMenus);
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Menu->read(null, $id);
		}
		$groups = $this->Menu->Group->find('list');
                $parentMenus = $this->Menu->generatetreelist(null, null, null, '_');
                $this->set('groups', $groups);
                $this->set('parents', $parentMenus);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Menu->delete($id)) {
			$this->Session->setFlash(__('Menu deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
        
        function admin_movedown($id, $delta = 1) {
            if ($delta > 0) {
                $this->Menu->moveDown($id, abs($delta));
            } else {
                $this->Session->setFlash('Por favor, forneça o número de posições do campo para ser movido para baixo.');
            }
            $this->Session->setFlash('Menu movido com sucesso!');
            $this->redirect(array('action' => 'index'), null, true);
        }
        
        function admin_moveup($id, $delta = 1){
            $this->Menu->id = $cat['Category']['id'];
            if ($delta > 0) {
                $this->Menu->moveup($id, abs($delta));
            } else {
                $this->Session->setFlash('Por favor, forneça um número de posições que a categoria deve ser deslocado para cima.');
            }
            $this->Session->setFlash('Menu movido com sucesso!');
            $this->redirect(array('action' => 'index'), null, true);
        }
}
