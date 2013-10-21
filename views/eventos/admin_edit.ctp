<div class="eventos site-form">
    <?php echo $this->Form->create('Evento'); ?>
    <fieldset>
        <legend>Dados do Evento</legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('nome', array('placeholder'=>'por exemplo: Festa de Amigo Secreto'));
        echo $this->Form->input('detalhes', array('type'=>'textarea','placeholder'=>'Adicione mais informações sobre o evento.', 'class'=>'ckeditor'));
        echo $this->Form->input('inicio', array('type'=>'text', 'class'=>'datatime','placeholder'=>'Data de início'));
        echo $this->Form->input('termino', array('type'=>'text', 'class'=>'datatime','placeholder'=>'Data de término'));
        echo $this->Form->input('rsvp', array('options'=>array('1'=>'Sim', '0'=>'Não'), 'label'=>'RSVP'));
        ?>
        <legend>Local do Evento</legend>
        <?php
        echo $this->Form->input('local_privado', array('options'=>array(0=>'Público', 1=>'Privado')));
        echo $this->Form->input('local', array('placeholder'=>'por exemplo: Parque do Ibirapuera'));
        echo $this->Form->input('cep', array('class'=>'cep'));
        echo $this->Form->input('endereco', array('class'=>'endereco'));
        echo $this->Form->input('numero', array('class'=>'numero'));
        echo $this->Form->input('complemento');        
        echo $this->Form->input('bairro', array('class'=>'bairro'));
        echo $this->Form->input('cidade', array('class'=>'cidade'));
        echo $this->Estados->select('estado');
        ?>
        <legend></legend>
        <?php
        echo $this->Form->input('status', 
                array('options'=>array(
                    '1' => 'Publicado',
                    '2' => 'Rascunho',
                    '0' => 'Cancelado'
                )));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>