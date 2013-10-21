<div>
    <p style="line-height:20px;color:#666">Nova confirmação de presença para <?php echo $evento['nome']; ?> no dia <?php echo substr($formatacao->data_brasileira($evento['inicio']),0,16); ?>h.</p>
    <p style="line-height:20px;color:#666">Abaixo, as informações da confirmação:</p>
    <p style="line-height:20px;color:#666">
        <strong>Nome:</strong> <?php echo $convidado['nome']; ?><br />
        <strong>E-mail:</strong> <?php echo $convidado['email']; ?><br />
        <strong>Celular:</strong> <?php echo $convidado['celular']; ?><br />
        <strong>Quantidade de Pessoas:</strong> <?php echo $convidado['qtd_confirmados']+1; ?> 
    </p>  
</div>