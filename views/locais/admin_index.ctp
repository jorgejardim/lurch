<div class="locais site-form index">
    <table class="admin-table" cellpadding="0" cellspacing="0">
        <tr class="actions">
            <td colspan="5">
                <ul> 
                    <li><?php echo $this->Html->link('Novo Local', array('action' => 'add')); ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <th><?php echo $this->Paginator->sort(__('Nome', true), 'nome'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Bairro', true), 'bairro'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Cidade', true), 'cidade'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Estado', true), 'estado'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($locais as $locai):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
            ?>
            <tr class="up-line <?php echo $class; ?>">
                <td><?php echo $locai['Locai']['nome']; ?>&nbsp;</td>
                <td><?php echo $locai['Locai']['bairro']; ?>&nbsp;</td>
                <td><?php echo $locai['Locai']['cidade']; ?>&nbsp;</td>
                <td><?php echo $locai['Locai']['estado']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $locai['Locai']['id']), array('class' => 'edit')); ?>
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $locai['Locai']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $locai['Locai']['id']), array('class' => 'delete')); ?>
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