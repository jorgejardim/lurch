<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_POST['enviar'])) {
    require_once('pagamento.php');
    $pag = new EnviaPagamentoMoIP;
    $res = $pag->envia();
    if($res['sucesso']==1) {
        echo $res['url'];
        exit;
        //header('location:conversao.php?url='.base64_encode($res['url']));
    } else {
        echo "<h1 style='color:#F00'>".$res['erro']."</h1>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
    <head>
        <title>PAGAMENTO MOIP</title>
        <meta name="author" lang="pt-br" content="Jorge Jardim" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://jquery-joshbush.googlecode.com/files/jquery.maskedinput-1.2.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#telefone").mask("(99)9999-9999",{placeholder:""});
                $("#cep").mask("99999-999",{placeholder:""});
            });
        </script>
    </head>
    <body>
        <form method="post" >

        <input type="hidden" name="recebedor[login]" value="jorgejardim" />
        <input type="hidden" name="forma_pagamento[forma]" value="boleto" />
        <input type="hidden" name="forma_pagamento[args][dias_expiracao][tipo]" value="Corridos" />

        <table width="400" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#999999">
            <tr>
                <td>Serviço:</td>
                <td><input name="razao" type="text" size="50" value="Servicos de Consultoria em Nutricao" /></td>
            </tr>
            <tr>
                <td>Valor:</td>
                <td><input name="valor" type="text" size="15" />(9.999,99)</td>
            </tr>
            <tr>
                <td>Vencimento:</td>
                <td><input name="forma_pagamento[args][dias_expiracao][dias]" type="text" size="4" maxlength="2" value="7" /> Qtd. de dias para vencimento do Boleto</td>
            </tr>
            <tr>
                <td nowrap="nowrap">Nome do Cliente:</td>
                <td><input name="pagador[nome]" type="text" size="35" /></td>
            </tr>
            <tr>
                <td nowrap="nowrap">E-mail do Cliente:</td>
                <td><input name="pagador[email]" type="text" size="40" /></td>
            </tr>
            <tr>
                <td nowrap="nowrap">Telefone do Cliente:</td>
                <td><input name="pagador[endereco][telefone]" id="telefone" type="text" size="15" maxlength="13" /> ((99)9999-9999)</td>
            </tr>
            <tr>
                <td>Endereço: </td>
                <td><input name="pagador[endereco][logradouro]" type="text" size="45" /></td>
            </tr>
            <tr>
                <td>Número:</td>
                <td><input name="pagador[endereco][numero]" type="text" size="5" /></td>
            </tr>
            <tr>
                <td>Bairro:</td>
                <td><input name="pagador[endereco][bairro]" type="text" value="" size="15" /></td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td><input name="pagador[endereco][cidade]" type="text" value="São Paulo" size="15" /></td>
            </tr>
            <tr>
                <td>UF:</td>
                <td><input name="pagador[endereco][estado]" type="text" value="SP" size="3" maxlength="2" /></td>
            </tr>
            <tr>
                <td>CEP:</td>
                <td><input name="pagador[endereco][cep]" id="cep" type="text" size="12" /> (99999-99)</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Enviar" name="enviar" /></td>
            </tr>
        </table>
        </form>
    </body>
</html>