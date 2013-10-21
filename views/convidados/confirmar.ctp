<div class="eventos site-view view col-info">
    <h2><?php __('Informações do Evento'); ?></h2>
    <p><strong>Evento:</strong> <?php echo $evento['Evento']['nome']; ?></p>
    <p><?php echo trim($evento['Evento']['detalhes']); ?></p>
    <p>
        <strong>Data:</strong> 
        <?php echo substr($formatacao->data_brasileira($evento['Evento']['inicio']),0,16); ?>h até
        <?php echo substr($formatacao->data_brasileira($evento['Evento']['termino']),0,16); ?>h
    </p>
    <p>
        <strong>Local:</strong> 
        <?php echo $evento['Evento']['local']; ?><br />
        <?php echo $evento['Evento']['endereco']; ?>, <?php echo $evento['Evento']['numero']; ?>
        <?php echo $evento['Evento']['complemento']?' - '.$evento['Evento']['complemento']:''; ?><br />
        CEP: <?php echo $evento['Evento']['cep']; ?> -
        <?php echo $evento['Evento']['bairro']; ?><br />
        <?php echo $evento['Evento']['cidade']; ?> -
        <?php echo $evento['Evento']['estado']; ?>
    </p>
</div>

<div class="convidados site-form col-confirme">    
    <?php echo $this->Form->create('Convidado'); ?>
    <fieldset>        
        <legend><?php __('Confirme sua Presença'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('confirmar', array('type' => 'hidden', 'value'=>1));
        echo $this->Form->input('email', array('label' => 'Digite seu E-mail:'));
        echo $this->Form->input('celular', array('label' => 'Digite seu Celular:', 'class' => 'telefone'));
        echo $this->Form->input('status', array('label' => 'Vai ao Evento?', 'options'=>array('1'=>'Sim', '2'=>'Não', 3=>'Talvez')));
        echo $this->Form->input('qtd_confirmados', array('label' => 'Qual a quantidade de Acompanhantes?', 'class' => 'numeric2'));
        echo $this->Form->input('confirmados', array('label' => 'Digite os nomes dos Acompanhantes (um por linha)'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="cleared">
        </div>