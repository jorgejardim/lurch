<h2 style="margin:0;padding:0;color:#666">Olá, <?php echo $formatacao->formata_nome($convidado['nome']); ?>.</h2>
<br>
<div>
    <p style="line-height:20px;color:#666">Venha participar do <?php echo $evento['nome']; ?> no dia <?php echo substr($formatacao->data_brasileira($evento['inicio']),0,16); ?>h.</p>
    <p style="line-height:20px;color:#666">Clique no link abaixo para saber mais informações e confirmar a sua presença:</p>
    <p style="line-height:20px;color:#666"><a target="_blank" style="color:#F60" href="<?php echo $html->url('/convidados/confirmar/'.$id, true); ?>"><?php echo $html->url('/convidados/confirmar/'.$id, true); ?></a></p>  
</div>