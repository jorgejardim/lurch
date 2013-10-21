<div class="groups index">
    <h2><?php __('Groups'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort(__('Name', true), 'name'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Reference', true), 'reference'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Adm', true), 'adm'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($groups as $group):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
            ?>
            <tr class="up-line <?php echo $class; ?>">
                <td><?php echo $group['Group']['name']; ?>&nbsp;</td>
                <td><?php echo $group['Group']['reference']; ?>&nbsp;</td>
                <td><?php echo $group['Group']['adm']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View', true), array('action' => 'view', $group['Group']['id']), array('class' => 'view')); ?>
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $group['Group']['id']), array('class' => 'edit')); ?>
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id']), array('class' => 'delete')); ?>
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
        <li><?php echo $this->Html->link(__('New', true) . ' ' . __('Group', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List', true) . ' ' . __('Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New', true) . ' ' . __('User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Permissions', true), array('controller' => 'acl_caching', 'action' => 'acl')); ?> </li>
    </ul>
</div>