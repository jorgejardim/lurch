<div class="users div-centro site-form">
    <?php echo $this->Form->create('User', array('type' => 'file', 'url' => '/'.$this->params['url']['url'])); ?>
    <fieldset>
        <legend>Meus Dados</legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('email', array('label'=>'E-mail'));
        echo $this->Form->input('password',array('label' => 'Senha', 'value' => ''));
        echo $this->Form->input('password_confirmation', array('label' => 'Confirmar Senha', 'type' => 'password', 'div'=>array('class' => 'input password required')));
        ?>        
        
        <legend>Telefones</legend>
        <?php
        echo $this->Form->input('UsersPhone.number.R', array(
            'label'=>'Telefone Residencial',
            'class'=>'telefone',
            'value'=>@$this->data['UsersPhone']['number']['R']));
        echo $this->Form->input('UsersPhone.number.C', array(
            'label'=>'Celular',
            'class'=>'telefone',
            'div'=>array('class' => 'input text required'),
            'value'=>@$this->data['UsersPhone']['number']['C']));
        ?>       
        
        <legend>Informações Pessoais</legend>
        <?php
        echo $this->Form->input('UsersData.birth', array('class'=>'nascimento', 'type'=>'text', 'label'=>'Aniversário', 'div'=>array('class' => 'input text required'))); 
        echo $this->Form->input('UsersData.sex', array('label'=>'Sexo', 'empty'=>true, 'options'=>array(
            'Masculino'=>'Masculino',
            'Feminino'=>'Feminino'))); 
        echo $this->Form->input('UsersData.civil_status', array('label'=>'Estado Civil', 'empty'=>true, 'options'=>array(
            'Solteiro'=>'Solteiro',
            'Casado'=>'Casado',
            'Divorciado'=>'Divorciado',
            'Viuvo'=>'Viúvo'))); 
        ?>
        
        <legend>Endereço</legend>
        <?php
        echo $this->Form->input('UsersAddress.zipcode', array('class'=>'cep')); 
        echo $this->Form->input('UsersAddress.address', array('class'=>'endereco'));
        echo $this->Form->input('UsersAddress.number');
        echo $this->Form->input('UsersAddress.complement', array('class'=>'estado'));
        echo $this->Form->input('UsersAddress.neighborhood', array('class'=>'bairro'));
        echo $this->Form->input('UsersAddress.city', array('class'=>'cidade'));
        //echo $this->Form->input('UsersAddress.state', array('class'=>'estado'));
        echo $this->Estados->select('UsersAddress.state');
        ?>

    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>