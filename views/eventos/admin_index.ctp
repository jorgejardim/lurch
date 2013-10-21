<div class="eventos site-form index">
    <table class="admin-table" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort(__('Nome', true), 'nome'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Inicio', true), 'inicio'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Status', true), 'status'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php if(!$eventos) { ?>
        <tr>
            <td class="vazio" colspan="4">Nenhum evento cadastrado.</td>
        </tr>
        <?php
        } else {
        $i = 0;
        foreach ($eventos as $evento) {
            $class = null;
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
            ?>
            <tr class="up-line <?php echo $class; ?>">
                <td><?php echo $evento['Evento']['nome']; ?>&nbsp;</td>
                <td class="text-center"><?php echo substr($formatacao->data_brasileira($evento['Evento']['inicio']),0,16); ?>h</td>
                <td class="text-center"><?php echo $status[$evento['Evento']['status']]; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link($this->Html->image('icons/icon-view.png', array(
                                                    'alt' => 'Visualizar', 'title' => 'Visualizar', 'class' => 'tooltip')
                                               ), array(
                                                    'controller' => 'eventos',
                                                    'action' => 'view',
                                                    $evento['Evento']['id']
                                               ), array(
                                                    'escape' => false,
                                               )); ?>
                    <?php echo $this->Html->link($this->Html->image('icons/icon-edit.png', array(
                                                    'alt' => 'Editar', 'title' => 'Editar', 'class' => 'tooltip')
                                               ), array(
                                                    'controller' => 'eventos',
                                                    'action' => 'edit',
                                                    $evento['Evento']['id']
                                               ), array(
                                                    'escape' => false,
                                               )); ?>
                    <?php echo $this->Html->link($this->Html->image('icons/icon-people.png', array(
                                                    'alt' => 'Convidados', 'title' => 'Convidados', 'class' => 'tooltip')
                                               ), array(
                                                    'controller' => 'convidados',
                                                    'action' => 'add',
                                                    $evento['Evento']['id']
                                               ), array(
                                                    'escape' => false,
                                               )); ?>
                    <?php echo $this->Html->link($this->Html->image('icons/icon-delete.png', array(
                                                    'alt' => 'Excluir', 'title' => 'Excluir', 'class' => 'tooltip')
                                               ), array(
                                                    'controller' => 'eventos',
                                                    'action' => 'delete',
                                                    $evento['Evento']['id']
                                               ), array(
                                                    'escape' => false,
                                                    'confirm' => 'Term certeza que quer excluir?'
                                               )); ?>
                </td>
            </tr>
        <?php }} ?>
    </table>
    <br />
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
        | 	<?php echo $this->Paginator->numbers(); ?>
        |
        <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
</div>