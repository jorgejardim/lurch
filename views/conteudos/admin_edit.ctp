<div class="conteudos site-form">
    <?php echo $this->Form->create('Conteudo'); ?>
    <fieldset>
        <legend><?php __('Admin Edit'); ?> <?php __('Conteúdo:'); ?> <?php echo $formatacao->formata_nome($this->data['Conteudo']['pass'], 'completo') ?> / <?php echo $formatacao->formata_nome($this->data['Conteudo']['block'], 'completo') ?></legend>
        <?php
        echo $this->Form->input('id');
        if(isset($campos['titulo']))
            echo $this->Form->input('titulo', array('div'=>array('class' => 'input text required')));
        if(isset($campos['texto']))
            echo $this->Form->input('texto', array('style'=>'width:695px', 'div'=>array('class' => 'input text required')));
        if(isset($campos['imagem']))
            echo $this->Form->input('imagem', array('div'=>array('class' => 'input text required')));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>