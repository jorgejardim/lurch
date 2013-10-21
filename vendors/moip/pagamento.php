<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

//define('TOKEN',    'LBEBVGIIFPWRPBLKDSTMLGIXD7YP46NB');
//define('KEY',      'WKDR1CVFWPQU2Z9IDS69XXEUCWUKDC3HPPEM0VD2');
//define('AMBIENTE', 'sandbox'); // producao

define('TOKEN',    '4CGSGRVO8NCDXMNRFO22WDQIYZZSALEV');
define('KEY',      '6CCVL1RV2SEZBWM1TLHPNHECJBUJUUUAWCDEXBJY');
define('AMBIENTE', 'producao'); // producao

require_once('api/MoIP.php');

class EnviaPagamentoMoIP {

    public function envia($data, $id_proprio=null) {

        //$uniqid = md5(uniqid(rand(), true));
        $uniqid = strrev(substr(uniqid(),-10));
        if(!$id_proprio) $id_proprio = $uniqid;
        $id_proprio = substr(str_replace('{id}', $uniqid, $id_proprio),0,32);
            
        $this->format();

        $moip = new MoIP();
        $moip->setCredenciais(array('key'=>KEY,'token'=>TOKEN));
        $moip->setAmbiente(AMBIENTE);
        $moip->setIDProprio($id_proprio);
        
        $moip->setValor($data['valor']);
        $moip->setRazao($data['razao']);

        if(isset($data['url_notificacao'])) {
            $moip->setUrlNotificacao($data['url_notificacao']);
        }
        if(isset($data['url_retorno'])) {
            $moip->setUrlRetorno($data['url_retorno']);
        }        
        if(isset($data['pagador'])) {
            $moip->setPagador($data['pagador']);
        }
        if(isset($data['recebedor'])) {
            $moip->setRecebedor($data['recebedor']);
        } 
        if(isset($data['comissoes'])) {
            $moip->setComissoes($data['comissoes']);
        }

        if(isset($data['forma_pagamento']['forma'])) {
            $moip->addFormaPagamento($data['forma_pagamento']['forma'],$data['forma_pagamento']['args']);
        }

        $moip->valida();
        $moip->envia();

        if($moip->getResposta()->sucesso==1) {

            $return['id_proprio'] = $id_proprio;
            $return['id']         = $moip->getResposta()->id;
            $return['url']        = $moip->getResposta()->url_pagamento;
            $return['xml']        = $moip->getResposta()->xml;
            $return['sucesso']    = 1;

        } else {

            $return['xml']     = $moip->getResposta()->xml;
            $return['erro']    = $moip->getResposta()->erro;
            $return['sucesso'] = 0;
        }
        return $return;
    }

    private function format() {
        $this->formatValor();
        $this->formatTelefone();
        $this->formatTelefone('celular');
        $this->formatCEP();
    }

    private function formatValor() {
        if(!isset($data['valor'])) return false;
        $v = $data['valor'];
        $v = str_replace('.', '', $v);
        $v = str_replace(',', '.', $v);
        $data['valor'] = $v;
    }

    private function formatCEP() {
        if(!isset($data['pagador']['endereco']['cep'])) return false;
        $v = $data['pagador']['endereco']['cep'];
        $v = preg_replace("/[^0-9]/e",'',$v);
        $a = substr($v,0,5);
        $b = substr($v,5,3);
        $data['pagador']['endereco']['cep'] = "$a-$b";
    }

    private function formatTelefone($l='telefone') {
        if(!isset($data['pagador']['endereco'][$l])) return false;
        $v = $data['pagador']['endereco'][$l];
        $v = preg_replace("/[^0-9]/e",'',$v);
        $a = substr($v,0,2);
        $b = substr($v,2,4);
        $c = substr($v,6,4);
        $data['pagador']['endereco'][$l] = "($a)$b-$c";
    }
}

/*
** EXEMPLO

//Dados do Pagador
$data['pagador']['nome']                    = 'Jose da Silva';
$data['pagador']['email']                   = 'jose@silva.com';
$data['pagador']['celular']                 = '(34)3434-3434';
$data['pagador']['apelido']                 = 'zeh';
$data['pagador']['identidade']              = '111.111.111-11';
$data['pagador']['endereco']['logradouro']  = 'Rua do Zé';
$data['pagador']['endereco']['numero']      = '34';
$data['pagador']['endereco']['complemento'] = 's';
$data['pagador']['endereco']['bairro']      = 'santana';
$data['pagador']['endereco']['cidade']      = 'São Paulo';
$data['pagador']['endereco']['estado']      = 'SP';
$data['pagador']['endereco']['pais']        = 'Brasil';
$data['pagador']['endereco']['cep']         = '04814180';
$data['pagador']['endereco']['telefone']    = '(34)3434-3434';

//Dados do Recebedor
$data['recebedor']['login'] = 'testepengo1';

//Dados dos Comissionados
$data['comissoes'][0]['login']      = 'testepengo1';
$data['comissoes'][0]['percentual'] = '30.0';
$data['comissoes'][1]['login']      = 'testepengo2';
$data['comissoes'][1]['percentual'] = '40.0';
$data['comissoes'][2]['login']      = 'testepengo3';
$data['comissoes'][2]['percentual'] = '30.0';

//Para Forma de Pagamento apenas com Boleto
$data['forma_pagamento']['forma']                          = 'boleto';
$data['forma_pagamento']['args']['dias_expiracao']['dias'] = 35;
$data['forma_pagamento']['args']['dias_expiracao']['tipo'] = 'Corridos';

//Descrição da Compra
$data['razao'] = 'Teste do MoIP-PHP';

//Valor da Compra
$data['valor'] = '1234.56';

//Envia Compra
$pag = new EnviaPagamentoMoIP;
$res = $pag->envia($data);
echo '<br><a href="'.$res['url'].'" target="_blank">link</a>'
*/
?>