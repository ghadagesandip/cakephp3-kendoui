<div class="row">
    <div class="col-lg-2">
        <h2>Actions</h2>
        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'index'))?>" class="btn"> List Users</a>
    </div>
    <div class="col-lg-10 fieldlist">
        <?= $this->Form->create($user); ?>

            <legend><?= __('Add User') ?></legend>
            <div class="form-group">
                <?php echo $this->Form->input('email',array('class'=>'form-control')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('password',array('class'=>'form-control')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('confirm_password',array('class'=>'form-control')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('first_name',array('class'=>'form-control')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->input('last_name',array('class'=>'form-control')); ?>
            </div>

            <div class="form-group">
                <input type="radio" name="data[User][gender]" id="engine1" class="k-radio" checked="checked">
                <label class="k-radio-label" for="engine1">Male</label>

                <input type="radio" name="data[User][gender]" id="engine2" class="k-radio">
                <label class="k-radio-label" for="engine2">Female</label>

            </div>

            <div class="form-group">
                <input type="submit" value="Add user" class="btn k-primary"/>
            </div>

            <?= $this->Form->end() ?>

    </div>
</div>
