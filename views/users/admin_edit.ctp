<div class="users site-form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('group_id');
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>