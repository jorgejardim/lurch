<h2 style="margin:0;padding:0;color:#666">Olá, <?php echo $name; ?>.</h2>
<br>
<div>
    <p style="line-height:20px;color:#666">Você ou outra pessoa usou seu endereço de e-mail para lembrar sua senha de acesso.</p>
    <p style="line-height:20px;color:#666">
        Seu e-mail de acesso: <strong><a target="_blank" style="color:#666;text-decoration:none;" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></strong><br />
        Sua senha: <strong><?php echo $password; ?></strong>
    </p>
    <?php if(empty($code)) { ?>
        <p style="line-height:20px;color:#666">Link: <a target="_blank" style="color:#F60" href="<?php echo $html->url('/', true); ?>"><?php echo $html->url('/', true); ?></a></p>    
    <?php } else { ?>
        <p style="line-height:20px;color:#666">Link: <a target="_blank" style="color:#F60" href="<?php echo $html->url('/c/'.$code, true); ?>"><?php echo $html->url('/c/'.$code, true); ?></a></p>    
    <?php } ?>
    <p style="line-height:20px;color:#666">Se você não solicitou este email, por favor, desconsidere.</p>
</div>