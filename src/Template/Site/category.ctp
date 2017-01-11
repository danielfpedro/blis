<?php
	$this->assign('title', $category->name . ' - Go go Dog!');

	echo $this->Html->meta(
		'description',
		'Mostra todos os artigos da categoria ' . $category->name,
		['block' => true]
	);
	echo $this->Html->meta(
		'keywords',
		$category->name,
		['block' => true]
	);
?>

<?= $this->cell('Navbar') ?>

<div class="offset-to-top"></div>

<!-- <div class="horizontal-banner">

</div> -->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2 class="title-category"><?= $category->name ?></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9 col-sm-9 hidden-xs">
			<div class="section-title">
				Populares
			</div>
			<?= $this->cell('MainPosts', ['notIn' => [], 'category' => (int)$category->id]) ?>

			<div
				class="load-more"
				data-category="<?= (int)$category->id ?>"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore']) ?>"
				data-page="2">
			</div>
		</div>
		<div class="col-xs-12 col-md-3 col-sm-3">
			<div class="section-title">
				Últimas
			</div>
			<div id="load-more-small-container">
				<?= $this->cell('RecentPosts', ['notIn' => [], 'category' => (int)$category->id]) ?>
			</div>

			<div
				class="load-more-small"
				data-category="<?= (int)$category->id ?>"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMoreSmall']) ?>"
				data-page="2">
			</div>

		</div>
	</div>
</div>
