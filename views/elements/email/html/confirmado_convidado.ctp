<h2 style="margin:0;padding:0;color:#666">Olá, <?php echo $formatacao->formata_nome($convidado['nome']); ?>.</h2>
<br>
<div>
    <p style="line-height:20px;color:#666">Recebemos sua confirmação de presença para <?php echo $evento['nome']; ?> no dia <?php echo substr($formatacao->data_brasileira($evento['inicio']),0,16); ?>h.</p>
    <p style="line-height:20px;color:#666">Abaixo, as informações da confirmação:</p>
    <p style="line-height:20px;color:#666">
        <strong>Nome:</strong> <?php echo $convidado['nome']; ?><br />
        <strong>E-mail:</strong> <?php echo $convidado['email']; ?><br />
        <strong>Celular:</strong> <?php echo $convidado['celular']; ?><br />
        <strong>Quantidade de Pessoas:</strong> <?php echo $convidado['qtd_confirmados']+1; ?> 
    </p>  
</div>