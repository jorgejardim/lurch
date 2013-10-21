<div class="convidados index">
    <h2><?php __('Convidados'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort(__('Evento Id', true), 'evento_id'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Nome', true), 'nome'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Email', true), 'email'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Celular', true), 'celular'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Qtd Acompanhantes', true), 'qtd_convidados'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Status', true), 'status'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Qtd Confirmados', true), 'qtd_confirmados'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Confirmados', true), 'confirmados'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Created', true), 'created'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Modified', true), 'modified'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($convidados as $convidado):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
            ?>
            <tr class="up-line <?php echo $class; ?>">
                <td>
                    <?php echo $this->Html->link($convidado['Evento']['id'], array('controller' => 'eventos', 'action' => 'view', $convidado['Evento']['id'])); ?>
                </td>
                <td><?php echo $convidado['Convidado']['nome']; ?>&nbsp;</td>
                <td><?php echo $convidado['Convidado']['email']; ?>&nbsp;</td>
                <td><?php echo $convidado['Convidado']['celular']; ?>&nbsp;</td>
                <td><?php echo $convidado['Convidado']['qtd_convidados']; ?>&nbsp;</td>
                <td><?php echo $convidado['Convidado']['status']; ?>&nbsp;</td>
                <td><?php echo $convidado['Convidado']['qtd_confirmados']; ?>&nbsp;</td>
                <td><?php echo $convidado['Convidado']['confirmados']; ?>&nbsp;</td>
                <td class="text-center"><?php echo $formatacao->data_brasileira($convidado['Convidado']['created']); ?>&nbsp;</td>
                <td class="text-center"><?php echo $formatacao->data_brasileira($convidado['Convidado']['modified']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View', true), array('action' => 'view', $convidado['Convidado']['id']), array('class' => 'view')); ?>
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $convidado['Convidado']['id']), array('class' => 'edit')); ?>
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $convidado['Convidado']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $convidado['Convidado']['id']), array('class' => 'delete')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br />
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
        ));
        ?>    </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
        | 	<?php echo $this->Paginator->numbers(); ?>
        |
        <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New', true) . ' ' . __('Convidado', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List', true) . ' ' . __('Eventos', true), array('controller' => 'eventos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New', true) . ' ' . __('Evento', true), array('controller' => 'eventos', 'action' => 'add')); ?> </li>
    </ul>
</div>