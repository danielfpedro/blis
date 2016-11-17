<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,700|Rubik:400,500,700" rel="stylesheet">

    <?= $this->Html->css('../lib/bootstrap/dist/css/bootstrap.min') ?>

    <?= $this->Html->css('style') ?>
    <?= $this->Html->css('../lib/font-awesome/css/font-awesome.min') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>
    <?= $this->fetch('content') ?>

    <?= $this->Html->script('../lib/jquery/dist/jquery.min') ?>
    <?= $this->Html->script('../lib/masonry/dist/masonry.pkgd.min') ?>

    <?= $this->fetch('script') ?>

</body>
</html>
