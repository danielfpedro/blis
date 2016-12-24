<nav class="navbar navbar-default navbar-static navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
                $image = $this->Html->image('logo.png', ['height' => 30, 'class' => 'brand'])
            ?>
            <?= $this->Html->link($image, [
                'controller' => 'Site',
                'action' => 'home'
            ],
            [
                'class' => 'navbar-brand',
                'title' => 'GoGoDog',
                'escape' => false
            ]) ?>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php foreach ($categories as $key => $category): ?>
                    <li>
                        <?= $this->Html->link(
                            $category->name,
                            [
                                'controller' => 'Site',
                                'action' => 'category',
                                'slug' => $category->slug
                            ])
                        ?>
                    </li>
                <?php endforeach ?>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-social-items">
                <li>
                    <a href="">
                        <span class="fa fa-facebook"></span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="fa fa-twitter"></span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="fa fa-youtube-play"></span>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>