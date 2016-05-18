<?php $this->assign('title','Login')?>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->Form->create('User',array('class'=>'form-signin','inputDefaults'=>array(
                'label'=>false
            ))); ?>
            <?=
            $this->Flash->render();
            $this->Flash->render('auth');
            ?>
            <h2>Admin login : </h2>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <?php  echo $this->Form->input('email',array('class'=>'form-control ')); ?>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <?php echo $this->Form->input('password',array('class'=>'form-control')); ?>
            </div>

            <div class="form-group">
                <?= $this->Form->button(__('Login'),array('class'=>'btn ')) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>

