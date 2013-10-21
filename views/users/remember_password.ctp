<div class="site-form">
<?php echo $this->Session->flash('email'); ?>
<?php if(!isset($ok)) { ?>
    <?php
    echo $this->Form->create(
            'User',
            array(
                'url' => array(
                'controller' => 'users',
                'action'     => 'remember_password'
            )
        )
    );
    echo $this->Form->input('email', array('label' => 'Digite seu E-mail'));
    echo $this->Form->end('Enviar');
    ?>  

<?php } else { ?>
    
    <?php echo $this->Form->create(null); ?>
            <p><strong>Enviamos um email para você.</strong></p>
            <p>Abra sua caixa de entrada para conferir a sua senha.</p>            
    <?php echo $this->Form->end(null); ?>
<?php } ?>
</div>