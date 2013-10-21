<div class="conteudos site-form index">
    <table class="admin-table" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort(__('Página', true), 'pass'); ?></th>
            <th><?php echo $this->Paginator->sort(__('Bloco', true), 'block'); ?></th>            
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($conteudos as $conteudo):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = 'altrow';
            }
            ?>
            <tr class="up-line <?php echo $class; ?>">
                <td><?php echo $formatacao->formata_nome($conteudo['Conteudo']['pass'], 'completo'); ?>&nbsp;</td>
                <td><?php echo $formatacao->formata_nome($conteudo['Conteudo']['block'], 'completo'); ?>&nbsp;</td>                
                <td class="actions">
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $conteudo['Conteudo']['id']), array('class' => 'edit')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>