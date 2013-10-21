<div class="convidados site-form">
    <?php echo $this->Form->create('Convidado'); ?>
    <fieldset>        
        <legend><?php __('Incluir Novo Convidado'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('evento_id', array('type' => 'hidden', 'value'=>$this->params['pass'][1]));
        echo $this->Form->input('nome');
        echo $this->Form->input('email');
        echo $this->Form->input('celular', array('class' => 'telefone'));
        echo $this->Form->input('qtd_convidados', array('label' => 'Quantidade de Acompanhantes', 'class' => 'numeric2'));
        echo $this->Form->input('status', array('options'=>array('Aguardando', 'Confirmado', 'Não Vai', 'Talvez')));
        echo $this->Form->input('qtd_confirmados', array('label' => 'Quantidade de Acompanhantes Confirmados', 'class' => 'numeric2'));
        echo $this->Form->input('confirmados', array('label' => 'Nomes dos Acompanhantes (um por linha)'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>