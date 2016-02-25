<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('../bower_components/bootstrap/dist/css/bootstrap.min') ?>
    <?= $this->Html->css('../styles/kendo.common.min') ?>
    <?= $this->Html->css('../styles/kendo.default.min') ?>
    <?= $this->Html->css('../styles/kendo.default.mobile.min') ?>
    <?= $this->Html->css('../styles/kendo.flat.min') ?>
    <?= $this->Html->css('style') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>
<div class="container-fluid">
    <?php echo $this->element('nav')?>
    <?=
    $this->Flash->render();
    $this->Flash->render('auth');
    ?>
    <?= $this->fetch('content') ?>
</div>
<footer class="footer">
    <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
    </div>
</footer>
<?= $this->Html->script('jquery.min') ?>
<?= $this->Html->script('config') ?>
<?= $this->Html->script('kendo.all.min') ?>
<?= $this->Html->script('../bower_components/bootstrap/dist/js/bootstrap.min') ?>
<?= $this->Html->script('myscript') ?>
<?php
if(file_exists(WWW_ROOT.'js'.DS.'pageJs'.DS.$this->request->controller.'.js')){
    echo $this->Html->script('pageJs/'.$this->request->controller.'.js');
}
?>
<?= $this->fetch('scriptBottom') ?>
</body>
</html>
