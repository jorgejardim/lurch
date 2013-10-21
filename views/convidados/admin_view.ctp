<div class="convidados site-view view">
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Evento'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->Html->link($convidado['Evento']['nome'], array('controller' => 'eventos', 'action' => 'view', $convidado['Evento']['id'])); ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $convidado['Convidado']['nome']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $convidado['Convidado']['email']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Celular'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $convidado['Convidado']['celular']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantidade de Acompanhantes'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $convidado['Convidado']['qtd_convidados']; ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $status[$convidado['Convidado']['status']]; ?>
                &nbsp;
        </dd>
        <?php if($convidado['Convidado']['status']==1) { ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantidade de Acompanhantes Confirmados'); ?>:</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $convidado['Convidado']['qtd_confirmados']; ?>
                    &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Convidados Acompanhantes:'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo nl2br($convidado['Convidado']['confirmados']); ?>
                    &nbsp;
            </dd>
        <?php } ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $formatacao->data_brasileira($convidado['Convidado']['created']); ?>
                &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?>:</dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $formatacao->data_brasileira($convidado['Convidado']['modified']); ?>
                &nbsp;
        </dd>
    </dl>
</div>