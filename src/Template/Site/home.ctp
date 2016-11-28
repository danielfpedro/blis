<?php
	$this->assign('title', 'Blizz - Descubra os melhores conteúdos sobre a Cultura Pop');
	echo $this->Html->meta(
		'description',
		'Descubra os melhores conteúdos sobre a Cultura Pop. Jogos, Cinema e Televisão (Séries).',
		['block' => true]
	);
	echo $this->Html->meta(
		'keywords',
		'Cultura Pop, Jogos, Cinema, Televisão, Séries, Melhor Conteúdo',
		['block' => true]
	);
?>

<?= $this->Html->script('Site/home', ['block' => true]) ?>

<?= $this->cell('Navbar') ?>

<div class="offset-to-top"></div>

<!-- <div class="horizontal-banner">
	
</div> -->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-9 col-sm-9">
			<div class="section-title">
				Populares
			</div>
			<?= $this->cell('MainPosts') ?>

			<div
				class="load-more"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore', 'populars']) ?>"
				data-category=""
				data-page="2">
			</div>
		</div>
		<div class="col-md-3 col-sm-3 col-small">
			<div class="section-title">
				Últimas
			</div>
			<div id="load-more-small-container">
				<?= $this->cell('RecentPosts') ?>
			</div>

			<div
				class="load-more-small"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore', 'recents']) ?>"
				data-page="2">
			</div>	

		</div>
	</div>
</div>