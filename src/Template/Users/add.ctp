<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bookmarks'), ['controller' => 'Bookmarks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bookmark'), ['controller' => 'Bookmarks', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>

        <legend><?= __('Add User') ?></legend>

        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('confirm_password',array('type'=>'password'));
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('gender',array('label'=>'Male'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit',array('class'=>'kbutton'))) ?>
    <?= $this->Form->end() ?>

    <input id="datepicker" />
    <p>Animal: <input id="animal" /></p>

</div>
