<div class="groups form">
<?php echo $this->Form->create('Group');?>
	<fieldset>
		<legend><?php __('Admin Add'); ?> <?php __('Group'); ?></legend>
	<?php
		echo $this->Form->input('name', array('class'=>'no-upper'));
		echo $this->Form->input('reference', array('class'=>'no-upper'));
		echo $this->Form->input('adm');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List', true).' '.__('Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List', true).' '.__('Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New', true).' '.__('User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>