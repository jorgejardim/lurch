<?php
class Group extends AppModel {
    
    var $name = 'Group';

    var $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'reference' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
        
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'group_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
        
    /**
    * Define os Behaviors utilizados pelo Model
    *
    * @var array
    * @access public
    * @link http://book.cakephp.org/pt/view/1072/Usando-Behaviors
    */
    var $actsAs = array(
        'acl' => array(
            'requester'
        ),
        'Logable'
    );
  
    /**
    * Parent Node
    *
    * Função que pega o registro "Pai" do grupo atual
    *
    * @return null
    * @access public
    */
    function parentNode() {
        return null;
    }
  
    /**
    * After Save
    *
    * Função de callback após salvar o registro
    * para que quando adicionados, alterados ou excluídos, 
    * a tabela Aro seja atualizada automáticamente.
    *
    * @param boolean $created Será true se for um novo registro
    * @access public
    * @link http://book.cakephp.org/pt/view/1053/afterSave
    */
    function afterSave($created) {
        $node = $this->node();
        $aro = $node[0];
        $aro['Aro']['alias'] = $this->data['Group']['name'];
        $this->Aro->save($aro);
    }       
}