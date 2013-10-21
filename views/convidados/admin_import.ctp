<div class="convidados site-form">
    <h2>Evento: <?php echo $evento['Evento']['nome'] ?></h2>
    <?php echo $this->Form->create('Convidado', array('type' => 'file')); ?>
    <fieldset>        
        <legend><?php __('Importar Convidados'); ?></legend>
        <?php
        echo $this->Form->input('evento_id', array('type' => 'hidden'));
        echo $this->Form->input('arquivo', array('type'=>'file'));
        ?>
        <h5>Dicas:</h5>
        <p>
            Se você já possui uma base de contatos que contém as informações das pessoas que deseja convidar, utilize o campo abaixo para fazer o upload do(s) arquivo(s). Você pode enviar arquivos no formato <strong>.csv</strong>.
        </p>
        <p>
            Em seu software de planilhas, localize a opção Arquivo > Salvar como > Texto CSV. Na caixa de diálogo exibida a seguir, selecione "," como delimitador de campos.
        </p>
        <p>
            A sua planilha deve conter as colunas: Nome, Email, Celular e Quantidade de Acompanhantes. 
        </p>
        <p>
            <a href="<?php echo $this->Html->url('/docs/convidados.xlsx', true); ?>" target="_blank">Clique aqui para baixar um arquivo de Exemplo.</a>
        </p>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>