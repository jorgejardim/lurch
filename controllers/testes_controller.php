<?php
class TestesController extends AppController {

    var $name = 'Testes';
    var $uses = array();

    function pdf() {
        $this->layout = 'pdf'; //this will use the pdf.ctp layout
        $this->render();
    }

    function index() {

    }

    function infusion() {

        $this->autoRender = false;

        App::import('Vendor', 'infusionsoft/infusionsoft');

        $callName = 'testecapture';
        $actionId = 213;
        $contacts = array( array( 'email'   => 'jorge@jorgejardim.com.br',
                                   'name'     => 'Jorge Jardim',
                                   'password' => '12345'));

        $infusionsoft = new InfusionSoftApi;
        $add_contact  = $infusionsoft->addContact($contacts, $callName, $actionId);

        print_r($add_contact);

    }

    function post() {

    	$this->autoRender = false;

    	$this->Email->from = 'site@universidadedoingles.com.br';
    	$this->Email->to = 'jorge@universidadedoingles.com.br';
    	$this->Email->bcc = 'jorge.testes@gmail.com, jorge@conteudodinamico.com.br';
    	$this->Email->subject = 'Teste de envio de Emails - '.time();
    	$this->Email->template = 'default';
    	$this->set('conteudo', print_r($_POST, true));

    	if($res = $this->Email->send()) {
    		echo 'E-mail enviado em '.date('H:i:s').'h<br /><br />' ;
    	} else {
    		echo 'Erro: o e-mail nao foi enviado.<br /><br />' ;
    	}
    }

    function email() {

        $this->Auth->allow('*');
        $_SESSION['Message']['email'] = false;

        $this->autoRender = false;

        $this->Email->from = 'suporte@festaonline.net';
        $this->Email->to = 'jorge@conteudodinamico.com.br';
        $this->Email->bcc = array('jorge.testes@gmail.com', 'jorge@conteudodinamico.com.br');
        $this->Email->subject = 'Teste de envio de Emails - '.date('H:i:s');
        $this->Email->template = 'default';
        $this->set('conteudo', 'Teste Email Transacional Servidor Producao: '.date('H:i:s'));
        $this->Email->_debug = true;
        //$this->Email->delivery = 'debug';

        if($res = $this->Email->send()) {
            echo 'E-mail enviado em '.date('H:i:s').'h<br /><br />' ;
        } else {
            echo 'Erro: o e-mail nao foi enviado.<br /><br />' ;
        }

        echo '<hr><b>DEBUG:</b><br><br><pre>';

        $debug['to'] = $this->Email->to;
        $debug['cc'] = $this->Email->cc;
        $debug['bcc'] = $this->Email->bcc;
        $debug['bcc'] = $this->Email->bcc;
        $debug['subject'] = $this->Email->subject;
        $debug['headers'] = $this->Email->headers;
        $debug['smtpOptions'] = $this->Email->smtpOptions;
        $debug['smtpError'] = $this->Email->smtpError;

        print_r($debug);
        print_r($_SESSION['Message']['email']);
    }

    function mega_sena() {

        header('Content-type: text/css');
        $this->autoRender = false;

        for($j=0;$j<=600000;$j++) {

            $n = array();
            $casas = range(0,60);
            srand((float)microtime()*1000000);
            shuffle($casas);

            # Gera os 6 números
            for ($i = 1; $i <= 6; $i++) {

                $casa = array_shift($casas);

                $n[] = str_pad($casa, 2, '0', STR_PAD_LEFT);
            }

            # Ordena os números
            sort($n);

            # Exibe os números
            $numeros[ implode('-', $n) ] = $j;

        }

        foreach($numeros as $k => $v) {

            echo $k."\n";
        }
    }

    function user_student_id() {

        $this->autoRender = false;
        $this->loadModel('User');
        $this->loadModel('Student');

        $this->paginate['fields'] = array('Student.user_id', 'Student.id');
        $this->paginate['joins'][0] = array(
                        'table' => 'students',
                        'alias' => 'Student',
                        'conditions' => array(
                                'User.id = Student.user_id',
                            )
        );
        $this->paginate['conditions']['User.student_id'] = null;
        $this->paginate['limit']  = 10;
        $Students = $this->paginate('User');

        foreach($Students as $Student) {

            $this->User->id = $Student['Student']['user_id'];
            $this->User->saveField('student_id', $Student['Student']['id']);
            echo $Student['Student']['user_id'] . ' -> ' . $Student['Student']['id'] . '<br>';
        }
        echo '<meta http-equiv="refresh" content="2">';
    }

    function student_order($id=1) {

        $this->autoRender = false;
        $this->loadModel('StudentsAccompaniment');
        $this->loadModel('Student');

        $options = false;
        $options['limit']   = 10;
        $options['conditions']['Student.order'] = null;
        $options['conditions']['Student.course_id'] = array(3,4);
        $options['conditions']['Student.id >'] = (@$id);
        $options['order'] = array('Student.id');
        $Students = $this->Student->find('all', $options);

        foreach($Students as $Student) {

            $options = false;
            $options['conditions']['StudentsAccompaniment.student_id'] = $Student['Student']['id'];
            $options['conditions']['StudentsAccompaniment.course_id'] = $Student['Student']['course_id'];
            $options['order'] = array('StudentsAccompaniment.order DESC');
            $acompanhamento = $this->StudentsAccompaniment->find('first', $options);

            $this->Student->id = $Student['Student']['id'];
            $this->Student->saveField('order', $acompanhamento['StudentsAccompaniment']['order']);
            echo $Student['Student']['id'] . ' -> ' . $acompanhamento['StudentsAccompaniment']['order'] . '<br>';
            $id = $Student['Student']['id'];
        }
        echo '<meta http-equiv="refresh" content="2; url=http://www.universidadedoingles.net/portal/testes/student_order/'.(@$id).'">';
    }

    function cache() {

        if(isset($this->data)) {
            $this->set('msg', 'enviado: '.$this->data['StudentsLesson']['comentario']);
            $this->Session->write('teste_comentario', $this->data['StudentsLesson']['comentario']);
        }

        $this->data['StudentsLesson']['comentario'] = $this->Session->read('teste_comentario');

        if(!isset($this->data)) {
            $this->cacheAction = "1 hour";
        }
    }

    function cache_up() {

        $this->autoRender = false;
        $this->Session->write('teste_comentario', time());
        echo $this->Session->read('teste_comentario');
    }

    function vouchers_livro($id=0) {

        $this->autoRender = false;
        $this->loadModel('Test');
        $this->loadModel('MegaSena');
        $compras = $this->Test->query("SELECT *
                                       FROM `tests`
                                       WHERE `valor` < 999
                                       AND id > '".$id."'
                                       GROUP BY email
                                       ORDER BY id
                                       LIMIT 5");

        foreach($compras as $compra) {

            $exist = $this->MegaSena->query("SELECT * FROM `mega_senas`
                                    WHERE `email` = '".$compra['tests']['email']."'");

            if(!$exist[0]['mega_senas']['id'] || count($exist)==100) {

                $this->MegaSena->query("UPDATE `mega_senas` SET
                                       `email` = '".$compra['tests']['email']."'
                                        WHERE (`email` IS NULL OR `email` = '')
                                        ORDER BY id
                                        LIMIT 10");
            }
            $id = $compra['tests']['id'];
        }
        print_r($compras);
        echo '<meta http-equiv="refresh" content="2; url=http://www.universidadedoingles.com.br/portal/testes/vouchers_livro/'.(@$id).'">';
    }

    function vouchers_curso($id=0) {

        $this->autoRender = false;
        $this->loadModel('Test');
        $this->loadModel('MegaSena');
        $compras = $this->Test->query("SELECT *
                                       FROM `tests`
                                       WHERE `valor` > 999
                                       AND id > '".$id."'
                                       GROUP BY email
                                       ORDER BY id
                                       LIMIT 5");

        foreach($compras as $compra) {

            $exist = $this->MegaSena->query("SELECT * FROM `mega_senas`
                                    WHERE `email` = '".$compra['tests']['email']."'");

            if(!$exist[0]['mega_senas']['id'] || count($exist)==10) {

                $this->MegaSena->query("UPDATE `mega_senas` SET
                                       `email` = '".$compra['tests']['email']."'
                                        WHERE (`email` IS NULL OR `email` = '')
                                        ORDER BY id
                                        LIMIT 100");
            }
            $id = $compra['tests']['id'];
        }
        print_r($compras);
        echo '<meta http-equiv="refresh" content="2; url=http://www.universidadedoingles.com.br/portal/testes/vouchers_curso/'.(@$id).'">';
    }

    function vouchers_email($email='') {

        if($email=='') {
            echo 'Fim';
            exit();
        }

        $this->autoRender = false;
        $this->loadModel('MegaSena');
        $emails = $this->MegaSena->query("SELECT *
                                          FROM `mega_senas`
                                          WHERE `email` LIKE '%@%'
                                          AND `email` > '".$email."'
                                          GROUP BY `email`
                                          ORDER BY `email`
                                          LIMIT 10");
        foreach($emails as $email) {

            $cliente = $this->MegaSena->query("SELECT *
                                               FROM `mega_senas`
                                               WHERE `email` = '".$email['mega_senas']['email']."'
                                               ORDER BY `numeros`");
            $i = 0; $numeros = '';
            foreach($cliente as $c) {
                $numeros .= '<strong>' . str_pad(++$i, 3, 0, STR_PAD_LEFT) . ')</strong> '.$c['mega_senas']['numeros'].'<br />';
            }
            echo '<strong>'.$email['mega_senas']['email'].'</strong><br />'.$numeros.'<hr />';

            $this->Emailmanager->from = 'Indiana Jober Jones <indianajones@inglesfluenteonline.com.br>';
            $this->Emailmanager->to   = $email['mega_senas']['email'];
            //$this->Emailmanager->to   = 'jorge@conteudodinamico.com.br';
            $this->Emailmanager->subject  = 'Viagem para Disney com a Universidade do Inglês';
            $this->Emailmanager->template = 'vouchers';
            $this->Emailmanager->layout   = 'marketing';
            $this->set('numeros', $numeros);
            $this->Emailmanager->send();

            $proximo = $email['mega_senas']['email'];
        }

        echo '<meta http-equiv="refresh" content="2; url=http://www.universidadedoingles.com.br/portal/testes/vouchers_email/'.(@$proximo).'">';
    }


    function vouchers_sorteio() {

        $this->autoRender = false;
        $this->loadModel('MegaSena');
        $emails = $this->MegaSena->query("SELECT u.name, u.email, m.numeros
                                          FROM `mega_senas` m
                                          INNER JOIN `users` u ON m.email = u.email
                                          GROUP BY m.`email`
                                          ORDER BY rand( )
                                          LIMIT 3 ");
        header("Content-type:text/xml");
        $xml  = '<?xml version="1.0" encoding="utf-8"?>
                 <NomesSorteio>';

        foreach($emails as $email) {

            $email['u']['email'] = substr(strstr($email['u']['email'], '@', true), 0, -3).'xxx@xxxxx.xxx.xx';


            $xml .= '<item numero="'.$email['m']['numeros'].'" nome="'.$email['u']['name'].'" email="'.$email['u']['email'].'" />';
        }

        $xml .= '</NomesSorteio>';
        echo $xml;
    }

    function vouchers_sorteio_rodrigo() {

        $this->autoRender = false;
        header("Content-type:text/xml");
        $xml  = '<?xml version="1.0" encoding="utf-8"?>
                 <NomesSorteio>';

        $xml .= '<item numero="24-24-24-24-24-24" nome="Rodrigo BIGODE Corrêa" email="rodrigo.correa@universidadedoingles.com.br" />';

        $xml .= '</NomesSorteio>';
        echo $xml;
    }

    public function beforeFilter() {
    	$this->Auth->allow('post', 'email', 'infusion');
    }
}
?>
