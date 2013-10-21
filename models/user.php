<?php
class User extends AppModel {
    
    var $name = 'User';
    
    var $validate = array(
        'group_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Não pode ser vazio.' 
            ),
        ),
        'email' => array(
            'notempty' => array(
                'rule' => array('email'),
                'message' => 'Digite um email válido.',
            ),
        ),
        'password' => array(
            'rule' => array('minLength', '6'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'A senha deve ter pelo menos 6 caracteres.'             
        ), 
        'password_confirmation' => array(
            'required' => true,
            'match'=>array(
                'rule' => 'validatePasswdConfirm',
                'message' => 'As senhas não coincidem.'
            )
        ),
        'active' => array(
            'boolean' => array(
                'rule' => array('boolean'),
            ),
        ),
    );
        
    var $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
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
        'Logable'
    );
    
    /**
     * Binds the User's permission always to the Group.
     * This makes the Acl Behavior to not update the Aros table every time
     * a users is added, because only the Group permissions matter, there is no
     * per-user permission setting.
     *
     * @param string $user
     * @return void
     * @author Augusto Pascutti
     */
    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }     
    
    /**
    * Save Hash
    * 
    * Cria o Hash da senha antes de salvar
    */    
    function beforeSave() {
        $this->data = $this->hashPasswords($this->data);
        return true;
    }    
    
    /**
    * Find Hash Decode
    * 
    * Decodifica a senha nos resultados de buscas
    */       
    function afterFind($results) {        
        foreach ($results as $key => $val) {
            if (isset($results[$key]['User']['password'])) { 
                $results[$key]['User']['password'] = $this->hashPasswordsDecode($results[$key]['User']['password']);
            }
        }
        return $results;
    }   
    
    /**
    * Hash
    *    
    * Método de Hash da senha
    */    
    function hashPasswords($data) { 
         //return $data;
         if (isset($data['User']['password'])) {
            if(!$this->isHash($data['User']['password'])) {
                $data['User']['password'] = 'Hs@|'.base64_encode( $data['User']['password'] );
            }
         }
         return $data;         
    }        
    
    /**
    * Hash Decode
    *    
    * Método de Decode do Hash da senha
    */    
    function hashPasswordsDecode($data) {
        //return $data;
        if($this->isHash($data)) {
            $data = str_replace('Hs@|', '', $data);
            return base64_decode( $data );
        } else {
            return $data;
        }
    }         
    
    /**
    * Is Hash
    *    
    * Método de Decode do Hash da senha
    */    
    function isHash($data) {
        $pos = strpos($data, 'Hs@|');
        if ($pos === false) 
            return false;       
        return true;
    }    
    
    /**
    * Is Hash
    *    
    * Valida a confirmação de senha
    */ 
    function validatePasswdConfirm($data) {
        if ($this->hashPasswordsDecode($this->data['User']['password']) !== $data['password_confirmation']) {
            return false;
        }
        return true;
    }
}