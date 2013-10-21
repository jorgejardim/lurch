<div class="conteudos site-form">
    <?php echo $this->Form->create('Conteudo'); ?>
    <fieldset>
        <legend><?php __('Admin Add'); ?> <?php __('Conteudo'); ?></legend>
        <?php
        echo $this->Form->input('action');
        echo $this->Form->input('block');
        echo $this->Form->input('pass');
        echo $this->Form->input('titulo');
        echo $this->Form->input('texto');
        echo $this->Form->input('imagem');
        echo $this->Form->input('config');
        echo $this->Form->input('editor');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>