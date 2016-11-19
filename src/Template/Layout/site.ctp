<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif:400,500,700" rel="stylesheet">

    <?= $this->Html->css('../lib/bootstrap/dist/css/bootstrap.min') ?>

    <?= $this->Html->css('style') ?>
    <?= $this->Html->css('../lib/font-awesome/css/font-awesome.min') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>
    <?= $this->fetch('content') ?>

    <?= $this->Html->script('../lib/jquery/dist/jquery.min') ?>
    <?= $this->Html->script('../lib/bootstrap/dist/js/bootstrap.min') ?>

    <?= $this->Html->script('../lib/masonry/dist/masonry.pkgd.min') ?>

    <?= $this->fetch('script') ?>

</body>
</html>
