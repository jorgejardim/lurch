<div class="menus form">
<?php echo $this->Form->create('Menu');?>
	<fieldset>
		<legend><?php __('Admin Add Menu'); ?></legend>
	<?php
		echo $this->Form->input('group_id', array('options'=>$groups, 'selected' => $session->read('group_selected')));
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

		<li><?php echo $this->Html->link(__('List Menus', true), array('action' => 'index'));?></li>
	</ul>
</div>