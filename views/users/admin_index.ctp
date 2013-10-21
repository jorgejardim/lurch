<div class="users site-form index">
    <table class="admin-table actions" cellpadding="0" cellspacing="0">
        <tr class="actions">
            <td colspan="6">
                <ul> 
                    <li><?php echo $this->Html->link(__('New', true) . ' ' . __('User', true), array('action' => 'add')); ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <th><?php echo $this->Paginator->sort(__('Grupo', true), 'group_id'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Name', true), 'name'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Email', true), 'email'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Ativo', true), 'active'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($users as $user):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
            ?>
            <tr class="up-line <?php echo $class; ?>">
                <td><?php echo $user['Group']['name']; ?></td>
                <td><?php echo $user['User']['name']; ?>&nbsp;</td>
                <td><?php echo $user['User']['email']; ?>&nbsp;</td>
                <td class="text-center"><?php echo $user['User']['active']?'Sim':'Não'; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link($this->Html->image('icons/icon-view.png', array(
                                                    'alt' => 'Visualizar', 'title' => 'Visualizar', 'class' => 'tooltip')
                                               ), array(
                                                    'controller' => 'users',
                                                    'action' => 'view',
                                                    $user['User']['id']
                                               ), array(
                                                    'escape' => false,
                                               )); ?>
                    <?php echo $this->Html->link($this->Html->image('icons/icon-edit.png', array(
                                                    'alt' => 'Editar', 'title' => 'Editar', 'class' => 'tooltip')
                                               ), array(
                                                    'controller' => 'users',
                                                    'action' => 'edit',
                                                    $user['User']['id']
                                               ), array(
                                                    'escape' => false,
                                               )); ?>
                    <?php echo $this->Html->link($this->Html->image('icons/icon-delete.png', array(
                                                    'alt' => 'Excluir', 'title' => 'Excluir', 'class' => 'tooltip')
                                               ), array(
                                                    'controller' => 'users',
                                                    'action' => 'delete',
                                                    $user['User']['id']
                                               ), array(
                                                    'escape' => false,
                                                    'confirm' => 'Term certeza que quer excluir?'
                                               )); ?>
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