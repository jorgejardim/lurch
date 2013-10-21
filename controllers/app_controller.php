<?php
/**
* Objeto controlador padrão prorrogado por todos os
* outros controladores do sistema
*
* @package default
* @author Jorge Jardim
*/
class AppController extends Controller {

    /**
    * Define os componentes disponíveis por padrão
    *
    * @var array
    * @access public
    */
    var $components = array(
        'Auth',
        'RequestHandler',
        'Session',
        'AclCaching.AclCaching' => array(
            'use' => array(
                'contain' => false
            ),
            'aro' => array(
                'model'        => 'Group',
                'primaryKey'   => 'id',
                'displayField' => 'name',
                'foreignKey'   => 'group_id'
            )
        ),
        'Email' => array('from' => 'Suporte <suporte@lurch.com.br>',
                'sendAs' => 'both',
                'delivery' => 'smtp',
                'smtpOptions' => array(
                    'timeout'  => '30',
                    //'port'     => '465',
                    //'host'     => 'ssl://s8-dallas.accountservergroup.com',
                    //'username' => 'suporte@festaonline.net',
                    //'password' => 't4r5zjj',
                    'port'     => '587',
                    'host'     => 'forward-in.splio.fr',
                )),
        'Enum',
        'Commons',
        'Functions',
    );

    /**
    * Define os helpers disponíveis por padrão
    *
    * @var array
    * @access public
    */
    var $helpers = array(
        'Html',
        'Javascript',
        'Form',
        'Session',
        'Formatacao',
        'Commons',
        'Paginator',
        'AclCaching.AclHtml',
        'Jmenu.Tree',
        'Estados',
    );

    /**
    * Before Filter
    *
    * Função de callback executada antes que qualquer outra
    *
    * @access public
    * @link http://book.cakephp.org/pt/view/984/Callbacks
    */
    function beforeFilter() {

        /*
        * AUTH
        */
        $this->_auth();

        /*
        * LOG
        */
        if(sizeof($this->uses) && $this->{$this->modelClass}->Behaviors->attached('Logable')) {
            $this->{$this->modelClass}->setUserData($this->Session->read('Auth'));
        }

        /*
        * MENU
        */
        if($this->Auth->user('id')) {
            if(!$this->Session->check('menu_data')) {
                $this->menu();
            }
        }

        /*
        * CONTEUDO
        */
        $this->_conteudo_do_site();
    }

    /**
    * Menu
    *
    * Função que monta o menu do usuário de acordo com seu cargo/grupo
    *
    * @access public
    */
   protected function menu() {
        $this->loadModel('Menu');
        $menu_data = $this->Menu->find('threaded',
                array('conditions' => array(
                            'Menu.group_id' => $this->Auth->user('group_id'),
                            'Menu.active' => 1),
                      'order' => 'Menu.lft ASC'));
        $this->Session->write('menu_data', $menu_data);
    }

    /**
    * Conteudo
    *
    * Função que monta o conteudo da página do site
    *
    * @access private
    */
    private function _conteudo_do_site() {
        if(!isset($this->params["admin"])) {
            $this->loadModel('Conteudo');
            $Conteudos = $this->Conteudo->find('all',
                    array('conditions' => array(
                                'Conteudo.action' => $this->params["action"],
                                'Conteudo.pass' => @$this->params["pass"][0])));
            if(is_array($Conteudos)) {
                foreach($Conteudos as $Conteudo) {
                    $conteudo[$Conteudo['Conteudo']['block']] = $Conteudo['Conteudo'];
                }
            }
            $this->set('conteudo', @$conteudo);
        }
    }

    /**
    * Auth
    *
    * Função de controle de acesso ao sistema
    *
    * @access private
    */
    private function _auth() {

        if($this->params['action']=='login' &&        // Deleta a sessao anterior se ja existir
           isset($this->data['User']['email']) &&
           isset($this->data['User']['password'])) {
            App::import('Controller', 'Users');
            $this->Users = & new UsersController;
            $this->Users->constructClasses();
            $this->Users->logout(true);
        }

        $this->Auth->allow(array('testes', 'email', 'login', 'logout', 'remember_password', 'activation_code', 'notificacao', 'register'));

        $this->Auth->authenticate = ClassRegistry::init('User'); // Altera o método de Hash, para chamalo pelo controller User

        $this->Auth->userModel = 'User'; // Nome do Model para os usuários

        $this->Auth->fields = array(
            'username'=>'email', // Troque o segundo parametro se desejar
            'password'=>'password', // Troque o segundo parametro se desejar
        );
        $this->Auth->userScope = array( // Permite apenas usuários ativos
            'User.active' => '1',
            'User.activation_code' => null
        );
        $this->Auth->authorize = 'actions'; // Utiliza o ACL para autorizar os usuários
        $this->Auth->autoRedirect = true; // Redireciona o usuário para a requisição anterior que foi negada após o login
        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action'     => 'login',
            'plugin'     => false,
            'admin'      => false
        );
        $this->Auth->loginRedirect = array(
            'controller' => 'home',
            'action'     => 'index',
            'plugin'     => false,
            'admin'      => true
        );
        $this->Auth->logoutRedirect = array(
            'controller' => 'users',
            'action'     => 'login',
            'plugin'     => false,
            'admin'      => false
        );
        $this->Auth->loginError = __('Usuário ou senha inválidos.', true);
        $this->Auth->authError  = __('Você não tem permissão para acessar.', true);
        $this->Auth->actionPath = 'controllers/';

        // Groups
        if($this->Auth->user('email')) {
            $this->loadModel('Group');
            $groups = $this->Group->findById($this->Auth->user('group_id'));
            $this->Session->write( 'Auth.Group', $groups['Group']);
        }

        // Constantes
        define('ADM', $this->Session->read('Auth.Group.adm'));
        define('USER_ID', $this->Session->read('Auth.User.id'));
        define('USER_NAME', $this->Session->read('Auth.User.name'));
        define('GROUP_ID', $this->Session->read('Auth.Group.id'));
        define('GROUP_REFERENCE', $this->Session->read('Auth.Group.reference'));

        /**
        * LIBERAR TUDO
        * Descomente a chamada dos metodos forceAllow para liberar os acessos
        */
        if($_SERVER['HTTP_HOST']=='localhostXXX') {
            // Libera acesso para localhost
            //$this->AclCaching->forceAllow();
            if(!USER_ID && $this->params['controller']!='users') {
            //    $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => false));
            }
        } elseif (isset($this->params['admin'])) {
            // Libera acesso para actions com o prefixo admin
            //$this->AclCaching->forceAllow();
        } else {
            // Libera acesso para actions sem o prefixo admin
            //$this->AclCaching->forceAllow();
        }
    }
}
