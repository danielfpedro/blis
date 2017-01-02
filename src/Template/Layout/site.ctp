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
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif:400,500,700" rel="stylesheet">

    
    <?php if (filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN)): ?>
        <?= $this->Html->css('../assets_dev/css/style.css') ?>

        <?= $this->Html->css('../lib/font-awesome/css/font-awesome.min') ?>
        <?= $this->Html->css('../lib/bootstrap/dist/css/bootstrap.min') ?>
    <?php else: ?>

        <?= $this->Html->css('bundle.css') ?>

        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <?php endif ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>
    <?= $this->element('Site/google_analytics') ?>

    <?= $this->fetch('content') ?>

    <?php if (filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN)): ?>
        <?= $this->Html->script('../lib/jquery/dist/jquery.min') ?>
        <?= $this->Html->script('../lib/bootstrap/dist/js/bootstrap.min') ?>
        
        <?= $this->Html->script('../lib/masonry/dist/masonry.pkgd.min') ?>
    <?php else: ?>
        <!-- Jquery -->
        <script
          src="https://code.jquery.com/jquery-3.1.1.min.js"
          integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
          crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <?= $this->Html->script('../lib/masonry/dist/masonry.pkgd.min') ?>

    <?php endif ?>

    <?= $this->Html->script('bundle') ?>

    <?= $this->fetch('script') ?>


</body>
</html>
