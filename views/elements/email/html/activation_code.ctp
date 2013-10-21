<h2 style="margin:0;padding:0;color:#666">Olá, <?php echo $name; ?>.</h2>
<br>
<div>
    <p style="line-height:20px;color:#666">Para completar seu cadastro você deve clicar em CONFIRMAR CADASTRO, no link a seguir:</p>
    <p style="line-height:20px;color:#666"><a target="_blank" style="color:#F60" href="<?php echo $html->url('/c/'.$code, true); ?>">CONFIRMAR CADASTRO</a></p>
    <p style="line-height:20px;color:#666">Obrigado pela colaboração.</p>
</div>