<?php
/**
 * Users controller
 *
 * Controle dos Usuários
 * 
 * @package default
 * @author Jorge Jardim
 */
class UsersController extends AppController {

    var $name = 'Users';    
    var $users;
    var $user;
    var $groups;
    var $ok = false;

    /**
     * Login
     *
     * @access public
     */
    function login() {
        $this->set('title_for_layout', 'Login');
        $this->logout(true); 
    }

    /**
     * Logout
     *
     * @access public
     */
    function logout($redirect=null) {
        $this->Session->delete('menu_data');
        $this->Session->delete('last_page');
        $this->Session->delete('Auth');
        if(!$redirect) {
            $this->Session->setFlash(__('Sua sessão foi encerrada.', true));
            $this->redirect($this->Auth->logout());
        }
    }
    
    /**
     * Meus Dados
     *
     * @access public
     */
    function admin_my_data() {
        
        //salva usuario
        $this->save($this->data, USER_ID);
        
        //lista usuario
        if(empty($this->data))
            $this->admin_view(USER_ID);
    }

    function admin_index() {
        $this->User->recursive = 0;
        $this->users = $this->paginate();
        $this->set('users', $this->users);
        $this->set('title_for_layout', 'Usuários');
    }

    function admin_view($id = null) {
        
        if (!$id) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }

        //lista usuario
        $this->data = $this->User->read(null, $id);
         
        //lista telefones
        $this->loadModel('UsersPhone');
        $options = false;
        $options['conditions']['UsersPhone.user_id'] = $id;
        $options['conditions']['UsersPhone.status'] = 1;
        $data = $this->UsersPhone->find('all',$options);
        if(!empty($data))
            $this->data = array_merge($this->data, $data);
        
        //lista endereco
        $this->loadModel('UsersAddress');
        $options = false;
        $options['conditions']['UsersAddress.user_id'] = $id;
        $options['conditions']['UsersAddress.status'] = 1;
        $data = $this->UsersAddress->find('first',$options);
        if(!empty($data))
            $this->data = array_merge($this->data, $data);
        
        //lista dados
        $this->loadModel('UsersData');
        $options = false;
        $options['conditions']['UsersData.user_id'] = $id;
        $options['conditions']['UsersData.status'] = 1;
        $data = $this->UsersData->find('first',$options);
        if(!empty($data)) {
            $data['UsersData']['birth'] = $this->Commons->data_brasileira($data['UsersData']['birth']);
            $this->data = array_merge($this->data, $data);
        }
        
        $this->set('user', $this->data);
        $this->set('title_for_layout', 'Usuário');
    }

    function admin_add() {
        
        //salva usuario
        $salvar = $this->save($this->data);
        if($salvar=='ok') {
            $this->redirect(array('action' => 'index'));
        }
        
        if(empty($this->data['remote'])) {
            $this->groups = $this->User->Group->find('list');          
            $this->set('groups',$this->groups);
        }
        $this->set('title_for_layout', 'Adicionar Usuário');
    }

    function admin_edit($id = null) {
        
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }
        
        //salva usuario
        $salvar = $this->save($this->data, $id);
        if($salvar=='ok') {
            $this->redirect(array('action' => 'index'));
        }
        
        //lista
        if (empty($this->data)) {
            $this->admin_view($id);
        }
        $this->groups = $this->User->Group->find('list'); 
        $this->set('groups',$this->groups);
        $this->set('title_for_layout', 'Editar Usuário');
    }

    function admin_delete($id = null, $redirect=true) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->ok = false;
        if ($this->User->delete($id)) {
            $this->loadModel('UsersAddress');
            $this->UsersAddress->deleteAll(array(
                'UsersAddress.user_id' => $id ));
            $this->loadModel('UsersData');
            $this->UsersData->deleteAll(array(
                'UsersData.user_id' => $id ));
            $this->loadModel('UsersPhone');
            $this->UsersPhone->deleteAll(array(
                'UsersPhone.user_id' => $id ));
            $this->Session->setFlash(__('User deleted', true));
            $this->ok = true;
            if($redirect)
                $this->redirect(array('action' => 'index'));
        }
        if(!$this->ok)
            $this->Session->setFlash(__('User was not deleted', true));
        if($redirect)
            $this->redirect(array('action' => 'index'));
    }
    
    //salva ou edita usuario
    function save($data, $user_id=null) {
        
        if(!empty($data)) { 
        
            $existe = $this->_exists($data['User']['email'], $user_id);

            if(!$existe) {
                
                if($user_id) {
                     $data['User']['id'] = $user_id;
                     $this->User->id     = $user_id;
                }

                //salva usuario
                if ($this->User->save($data)) {
                    
                    if(empty($data['User']['id'])) {
                        $data['User']['id'] = $this->User->id;
                    } if(empty($user_id)) {
                        $user_id = $this->User->id;
                    }

                    //telefones
                    $this->loadModel('UsersPhone');
                    $this->UsersPhone->beforeSaveAll($data);
                    
                    //endereços
                    if(!empty($data['UsersAddress']['address'])) {
                        App::import('Controller', 'UsersAddresses');
                        $this->UsersAddresses = & new UsersAddressesController;
                        $this->UsersAddresses->constructClasses();
                        $this->UsersAddresses->save($data, $user_id);
                    }

                    //dados
                    App::import('Controller', 'UsersDatas');
                    $this->UsersDatas = & new UsersDatasController;
                    $this->UsersDatas->constructClasses(); 
                    $this->UsersDatas->save($data, $user_id);                
                    
                    //foto
                    $upload = $this->_avatar($user_id);
                    if ($upload=='ok') {
                        $this->Session->setFlash('Dados salvos com sucesso.');
                        $this->ok = 'ok';
                        return 'ok';
                    } else {
                        $this->Session->setFlash(__($upload, true));
                        return false;
                    }

                } else {
                    $this->Session->setFlash('O registro não pôde ser salvo. Por favor, tente novamente.');
                    return false;
                }            

            } else {
                return false;
            }            
        }        
    }
    
    function activation_code($code) {
        
        $options = array();
        $options['conditions']['User.activation_code'] = $code;
        $User = $this->User->find('first', $options);
        if( isset($User['User']['id']) ) {
            
            $this->User->validate = false;
            $this->User->id                  = $User['User']['id'];
            $data['User']['id']              = $User['User']['id'];
            $data['User']['activation_code'] = null;
            if ($this->User->save($data)) {   
                $this->Session->setFlash(__('Verificação realizada com sucesso!', true));               
            } else {
                $this->Session->setFlash(__('Erro ao ativar o cadastro! Tente novamente.', true));
            }   
            
        } else {
            $this->Session->setFlash(__('Cadastro já verificado ou inexistente.', true));
        }
        $this->redirect(array('action' => 'login'));  
        
    }       

    function remember_password() {

        $this->set('css_for_layout', 'pages/users_login');
        $this->set('title_for_layout', 'Lembrar Minha Senha');
        
        if (!empty($this->data)) {

            $options = array();
            $options['conditions']['User.email'] = $this->data['User']['email'];
            $data = $this->User->find('first', $options);

            if(isset($data['User']['email'])) {                
                
                $this->Email->to = $data['User']['email'];
                $this->Email->subject = 'Recuperação de senha';
                $this->Email->template = 'remember_password'; 
                $this->set('name', $data['User']['name']); 
                $this->set('email', $data['User']['email']);
                $this->set('password', $data['User']['password']);
                $this->set('code', $data['User']['activation_code']);
                //$this->Email->delivery = 'debug';
                $this->Email->send();
                
                $this->set('ok', true);                      

            } else {
                $this->Session->setFlash(__('E-mail não Cadastrado.', true));                  
            }
        }
    }    
    
    function register() {
        
        $this->set('title_for_layout', 'Cadastre-se');
        $this->set('css_for_layout', 'pages/users_login');
        
        if (!empty($this->data)) {
        	
        	//verifica se o email ja existe
        	$options = array();
        	$options['conditions']['User.email'] = $this->data['User']['email'];
        	$data = $this->User->find('first', $options);
        	
        	if(!isset($data['User']['email'])) {
            
	            //salva usuario
	            $code = md5(uniqid(rand(), true));
	            $this->data['User']['group_id'] = 3;
	            $this->data['User']['activation_code'] = $code;
	            $salvar = $this->save($this->data);
	            if($salvar) {
	                
	                //envia email
	                $this->Email->to = $this->data['User']['email'];
	                $this->Email->subject = 'Finalizar cadastro';
	                $this->Email->template = 'activation_code'; 
	                $this->set('name', $this->data['User']['name']); 
	                $this->set('email', $this->data['User']['email']);
	                $this->set('code', $code); 
	                $this->Email->send();
	
	                $this->set('ok', true); 
	                
	            } else {
	                $this->Session->setFlash('O registro não pôde ser salvo. Por favor, tente novamente.');
	            }
	            
        	} else {
        		$this->Session->setFlash('Erro: O e-mail digitado já existe.');
        	}
        }
        
        $this->set('ok', @$salvar);
    }

    //verifica se o email enviado ja existe
    private function _exists($email, $id=null) {

        $options['conditions']['User.email'] = $email;
        if(!empty($id))
            $options['conditions']['User.id !='] = $id;        
        
        if($User = $this->User->find('first', $options)) {
            $this->Session->setFlash('Erro: O e-mail cadastrado já existe.');
            return $User['User']['id'];
        }
        return false;
    }
    
    private function _avatar($id) {

        App::import('Vendor', 'Upload', array('file' => 'class.upload'.DS.'class.upload.php'));

        if(isset($this->data['Arquivo']['avatar'])) {

            $handle = new upload($this->data['Arquivo']['avatar']);
            if ($handle->uploaded) {

                $handle->file_new_name_body   = $id;                                    // nome arquivo
                $handle->file_safe_name       = true;                                   // formata nome 
                $handle->file_overwrite       = true;                                   // sobreescreve
                $handle->allowed              = array('image/*');                       // arquivos permitidos
                $handle->image_convert        = 'jpg';                                  // converte para jpg
                $handle->jpeg_quality         = 72;                                     // qualidade
                $handle->image_resize         = true;                                   // redimensionar
                $handle->image_x              = 100;                                    // largura
                $handle->image_y              = 100;                                    // altura
                $handle->image_ratio_crop     = true;                                   // centralizar e recortar

                $handle->process(ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'avatars' . DS);   

                if ($handle->processed) {
                    $handle->clean();                        
                } else {
                    return $handle->error;
                }
            }
            $this->data['Arquivo']['avatar'] = false;
        }
        return 'ok';
    } 

    function beforeFilter() {
        parent::beforeFilter();
    }
}