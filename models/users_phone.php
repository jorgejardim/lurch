<?php

class UsersPhone extends AppModel {

    var $name = 'UsersPhone';
    var $validate = array(
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
        ),
    );
    
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    /**
    * Prepara para salvar
    */    
    function beforeSaveAll($data,$strike=true,$delete=false) {          

        if(isset($data['UsersPhone']['number'])) {
            $i = 0;
            foreach (array_keys($data['UsersPhone']['number']) as $k) {
                if($data['UsersPhone']['number'][$k]) {
                    $data['UsersPhone'][ $i ]['number']  = $data['UsersPhone']['number'][$k];
                    $data['UsersPhone'][ $i ]['type']    = $k;
                    $data['UsersPhone'][$i++]['user_id'] = $data['User']['id'];                    
                    if($strike) {                
                        $this->updateAll(
                            array('UsersPhone.status' => '0'),
                            array('UsersPhone.user_id' => $data['User']['id'],
                                  'UsersPhone.type' => $k,
                                  'UsersPhone.number !=' => $data['UsersPhone']['number'][$k]));              
                    }
                }
            }
            unset($data['UsersPhone']['number']);            
            foreach ($data['UsersPhone'] as $phone) {                
                $options['conditions']['UsersPhone.user_id'] = $phone['user_id'];
                $options['conditions']['UsersPhone.type']    = $phone['type']; 
                $options['conditions']['UsersPhone.number']  = $phone['number'];
                $options['conditions']['UsersPhone.status']  = 1;
                if(!$this->find('count', $options)) {  
                    $this->create();
                    $this->save($phone);
                }              
            }
        }
        return $data;
    }         

    /**
    * Prepara resultado da busca
    */       
    function afterFind($results) {
        foreach ($results as $key => $val) {
            if (isset($results[$key]['UsersPhone']['number'])) {  
                if($results[$key]['UsersPhone']['type']=='T') {
                    $results['UsersPhone']['branch'] = $results[$key]['UsersPhone']['branch'];
                }
                $results['UsersPhone']['number'][$results[$key]['UsersPhone']['type']] = $results[$key]['UsersPhone']['number'];
            }
        }
        return $results;
    } 
}
