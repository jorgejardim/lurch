<div class="menus index">
    <h2><?php __('Menus'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <?php if (isset($menus)) { ?>
            <tr>
                <th>Menu</th>		
                <th>ID</th>
                <th>Grupo</th>
                <th>Link</th>
                <th>Ativo</th>
                <th class="actions"><?php __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            foreach ($menus as $menu) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = 'altrow';
                }
                ?>
                <tr class="up-line <?php echo $class; ?>">
                    <td><?php echo $menu['Menu']['name']; ?>&nbsp;</td>
                    <td><?php echo $menu['Menu']['id']; ?>&nbsp;</td>		
                    <td><?php echo $menu['Group']['name']; ?>&nbsp;</td>
                    <td><?php echo $menu['Menu']['link']; ?>&nbsp;</td>
                    <td><?php echo $menu['Menu']['active']; ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('<', true), array('action' => 'moveup', $menu['Menu']['id'])); ?>
                        <?php echo $this->Html->link(__('>', true), array('action' => 'movedown', $menu['Menu']['id'])); ?>
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $menu['Menu']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $menu['Menu']['id'])); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $menu['Menu']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $menu['Menu']['id'])); ?>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <th colspan="6">Nenhum menu cadastrado para o Grupo</th>
            </tr>                                        
<?php } ?>
    </table>
</div>
<div class="actions">
    <h3><?php __('Groups'); ?></h3>
    <ul>
        <li>
            <?php
            echo $this->Form->input('groups', array('options' => $groups,
                'label' => false,
                'empty' => '',
                'selected' => $session->read('group_selected'),
                'onchange' => "javascript:location.href='" . $this->webroot . 'admin/' . $this->params['plugin'] . '/' . $this->params['controller'] . "/index/g:'+this.value"
            ));
            ?>
        </li>       
    </ul>    
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Menu', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Menus', true), array('controller' => 'menus', 'action' => 'index')); ?> </li>
    </ul>
</div>