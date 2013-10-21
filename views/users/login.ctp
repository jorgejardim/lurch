<div class="site-form">
<?php
echo $this->Form->create(
        'User',
        array(
            'url' => array(
            'controller' => 'users',
            'action'     => 'login'
        )
    )
);
echo $this->Form->input('email');
echo $this->Form->input('password',array('label' => 'Senha', 'type'=>'password'));
echo $this->Form->end('Login');
?>
</div>
<div class="actions">
    <?php
    echo $this->Html->link('Esqueceu a sua senha?', '/users/remember_password', array('class'=>'remember'));
    //echo $this->Html->link('Cadastre-se', '/users/register', array('class'=>'register'));
    ?>
</div>
