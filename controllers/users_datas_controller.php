<?php

class UsersDatasController extends AppController {

    var $name = 'UsersDatas';

    function save($data, $user_id) {

        if (!empty($data)) {
            
            //verifica se ja existe 
            $options = false;
            $options['conditions']['UsersData.user_id'] = $user_id;
            $existe = $this->UsersData->find('first', $options);
            
            //prepara insert
            if(!isset($existe['UsersData']['id'])) {
                
                $data['UsersData']['user_id'] = $user_id;
                $this->UsersData->create();
                
            //prepara update
            } else {
                
                $data['UsersData']['id'] = $existe['UsersData']['id'];
                $this->UsersData->id = $existe['UsersData']['id'];
            }   
            
            //formatacoes
            $data['UsersData']['birth'] = $this->Commons->data_americana(@$data['UsersData']['birth']);
            
            //salva
            if ($this->UsersData->save($data)) {
                
                return 'ok';
                
            } else {
                
                $this->Session->setFlash('Erro: Os dados cadastrais não foram salvos.');
                return 'erro';
            }
        }
    }
}