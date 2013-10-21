<div class="locais site-form">
    <?php echo $this->Form->create('Locai'); ?>
    <fieldset>
        <legend><?php __('Admin Add'); ?> <?php __('Local'); ?></legend>
        <?php
        echo $this->Form->input('nome', array('label'=>'Nome do Estabelecimento', 'placeholder'=>'por exemplo: D.O.M. Restaurante'));
        //echo $this->Form->input('detalhes', array('type'=>'textarea','placeholder'=>'Adicione mais informações sobre o evento.', 'class'=>'ckeditor'));
        ?>
        <legend>Dados da pessoa de contato no local</legend>
        <?php
        echo $this->Form->input('contato_nome', array('label'=>'Nome do Responsável'));
        echo $this->Form->input('contato_email', array('label'=>'E-mail do Responsável'));
        echo $this->Form->input('contato_telefone', array('label'=>'Telefone do Responsável', 'class'=>'telefone'));
        ?>
        <legend>Endereço</legend>
        <?php
        echo $this->Form->input('cep', array('class'=>'cep'));
        echo $this->Form->input('endereco', array('class'=>'endereco'));
        echo $this->Form->input('numero', array('class'=>'numero'));
        echo $this->Form->input('complemento');        
        echo $this->Form->input('bairro', array('class'=>'bairro'));
        echo $this->Form->input('cidade', array('class'=>'cidade'));
        echo $this->Estados->select('estado');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>