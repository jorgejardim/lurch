<?php

class UsersAddressesController extends AppController {

    var $name = 'UsersAddresses';

    function save($data, $user_id) {

        if (!empty($data)) {
            
            //verifica se ja existe 
            $options = false;
            $options['conditions']['UsersAddress.user_id'] = $user_id;
            $existe = $this->UsersAddress->find('first', $options);
            
            //prepara insert
            if(!isset($existe['UsersAddress']['id'])) {
                
                $data['UsersAddress']['user_id'] = $user_id;
                $this->UsersAddress->create();
                
            //prepara update
            } else {
                
                $data['UsersAddress']['id'] = $existe['UsersAddress']['id'];
                $this->UsersAddress->id = $existe['UsersAddress']['id'];
            }   
            
            //salva
            if ($this->UsersAddress->save($data)) {
                
                return 'ok';
                
            } else {
                
                $this->Session->setFlash('Erro: Os dados de endereço não foram salvos.');
                return 'erro';
            }
        }
    }
}