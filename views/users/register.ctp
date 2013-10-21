<?php if($ok!='ok') { ?>

    <div id="login" class="site-form">
        <?php
            echo $this->Form->create(array('action' => 'register'));    
            echo $this->Form->input('name', array('label' => 'Nome'));
            echo $this->Form->input('email', array('label' => 'E-mail'));
            echo $this->Form->input('UsersPhone.number.C', array( 'label'=>'Celular',
                                                                  'class'=>'telefone',
                                                                  'div'=>array('class' => 'input text required')));
            echo $this->Form->input('password',array('label' => 'Senha', 'type'=>'password'));
            echo $this->Form->input('password_confirmation', array('label' => 'Confirmar Senha', 'type' => 'password', 'div'=>array('class' => 'input password required'))); 
            echo $this->Form->end('Enviar');
        ?>
    </div>
    
<?php } else { ?>
    
    <h2>Olá <?php echo $this->data['User']['name']; ?>.</h2>
    <?php echo $this->Form->create(null); ?>
            <p><strong>Sua conta foi criada com sucesso.</strong></p>
            <p>No entanto, precisamos que ela seja validada. Abra sua caixa de entrada e clique no link de ativação que enviamos no seu e-mail.</p>
    <?php echo $this->Form->end(null); ?> 
<?php } ?>