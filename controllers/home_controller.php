<?php
class HomeController extends AppController {

    /**
    * This controller does not use a model
    *
    * @var array
    * @access public
    */
    var $uses = array();

    /**
    * Index
    *
    * @param mixed What page to display
    * @access public
    */
    function admin_index() {
        //lista endereco
        $this->loadModel('Evento');
        $options = false;
        $options['conditions']['Evento.user_id'] = USER_ID;
        $count = $this->Evento->find('count',$options);
        
        if($count) {
            $this->redirect(array('controller' => 'eventos', 'action' => 'index'));
        } else {
            $this->redirect(array('controller' => 'eventos', 'action' => 'add'));
        }
    }
}