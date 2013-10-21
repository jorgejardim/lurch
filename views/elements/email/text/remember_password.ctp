Olá, <?php echo $name; ?>.

Você ou outra pessoa usou seu endereço de e-mail para lembrar sua senha de acesso.

Seu e-mail de acesso: <?php echo $email; ?> 
Sua senha: <?php echo $password; ?> 

Link: 
<?php if(empty($code)) { ?>
    <?php echo $html->url('/', true); ?>
<?php } else { ?>
    <?php echo $html->url('/c/'.$code, true); ?>
<?php } ?>

Se você não solicitou este email, por favor, desconsidere. 