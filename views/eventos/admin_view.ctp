<div class="eventos site-view view">
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['nome']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalhes:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo trim($evento['Evento']['detalhes']); ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Início:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo substr($formatacao->data_brasileira($evento['Evento']['inicio']),0,16); ?>h
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Término:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo substr($formatacao->data_brasileira($evento['Evento']['termino']),0,16); ?>h
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Local:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['local']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Endereço:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['endereco']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Número:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['numero']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Complemento:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['complemento']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('CEP:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['cep']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bairro:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['bairro']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cidade:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['cidade']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado:'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $evento['Evento']['estado']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $status[$evento['Evento']['status']]; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo substr($formatacao->data_brasileira($evento['Evento']['created']),0,16); ?>h
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo substr($formatacao->data_brasileira($evento['Evento']['modified']),0,16); ?>h
                &nbsp;
        </dd>
    </dl>
</div>
