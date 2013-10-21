<div class="menus form">
<?php echo $this->Form->create('Menu');?>
	<fieldset>
		<legend><?php __('Admin Edit Menu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id', array('options'=>$groups));
		echo $this->Form->input('parent_id', array('options'=>$parents, 'empty' => '(raiz)'));
		echo $this->Form->input('name');
		echo $this->Form->input('link');
		//echo $this->Form->input('lft');
		//echo $this->Form->input('rght');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Menu.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Menu.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('action' => 'index'));?></li>
	</ul>
</div>