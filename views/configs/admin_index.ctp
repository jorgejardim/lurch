<div class="groups site-form">
<?php echo $this->Form->create('Config');?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('limite_convidados', array('class'=>'no-upper'));
		echo $this->Form->input('value', array('class'=>'no-upper numeric', 'label'=>'Limite de Convidados'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>