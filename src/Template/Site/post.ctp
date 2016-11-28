<?php
	$this->assign('title', $mainPost->title . ' - Blizz');
	echo $this->Html->meta(
		'description',
		$mainPost->subtitle,
		['block' => true]
	);
	echo $this->Html->meta(
		'keywords',
		$mainPost->tags,
		['block' => true]
	);
?>

<?= $this->Html->script('Site/home', ['block' => true]) ?>

<?= $this->cell('Navbar') ?>

<div class="offset-to-top"></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="" style="width: 100%">
				<a href="<?= $this->Url->build($mainPost->viewUrl) ?>" target="_blank">
					<div
						class="card-image"
						style="height: 250px; background-image: url(<?= $this->Url->build($mainPost->view_post_image) ?>)">
					</div>
					<a
						href="<?= $this->Url->build($mainPost->viewUrl) ?>"
						class="main-post-title"
						target="_blank">
						<h1>
							<?= $mainPost->title ?>
						</h1>
					</a>
					<!-- <p>
						<?= $mainPost->subtitle ?>
					</p> -->
				</a>
			</div>
		</div>
	</div>
</div>

<div class="offset-to-top"></div>
<div class="offset-to-top"></div>
<div class="offset-to-top"></div>
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
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore']) ?>"
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
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMoreSmall']) ?>"
				data-page="2">
			</div>	

		</div>
	</div>
</div>