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

	// Twitter
	echo $this->Html->meta(
		'twitter:card',
		$this->Url->build($mainPost->view_post_image, ['fullBase' => true]),
		['block' => true]
	);
	echo $this->Html->meta(
		'twitter:site',
		'@gogodogplease',
		['block' => true]
	);
	echo $this->Html->meta(
		'twitter:title',
		$mainPost->title,
		['block' => true]
	);
	echo $this->Html->meta(
		'twitter:description',
		$mainPost->subtitle,
		['block' => true]
	);
	echo $this->Html->meta(
		'twitter:creator',
		'@gogodogplease',
		['block' => true]
	);
	echo $this->Html->meta(
		'twitter:image',
		$this->Url->build($mainPost->view_post_image, ['fullBase' => true]),
		['block' => true]
	);
	echo $this->Html->meta(
		'twitter:domain',
		'gogodog.com.br',
		['block' => true]
	);
	// Facebook
	echo $this->Html->meta(
		'og:url',
		$this->Url->build($mainPost->postUrl, ['fullBase' => true]),
		['block' => true]
	);
	echo $this->Html->meta(
		'og:type',
		'website',
		['block' => true]
	);
	echo $this->Html->meta(
		'og:title',
		$mainPost->title,
		['block' => true]
	);
	echo $this->Html->meta(
		'og:description',
		$mainPost->subtitle,
		['block' => true]
	);
	echo $this->Html->meta(
		'og:image',
		$this->Url->build($mainPost->view_post_image, ['fullBase' => true]),
		['block' => true]
	);
?>

<?= $this->cell('Navbar') ?>

<div class="offset-to-top"></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<div class="" style="width: 100%">
				<a href="<?= $this->Url->build($mainPost->viewUrl) ?>" target="_blank">
					<div
						class="card-image"
						style="margin-bottom: 15px;height: 350px; background-image: url(<?= $this->Url->build($mainPost->view_post_image) ?>)">
					</div>
					<a
						href="<?= $this->Url->build($mainPost->viewUrl) ?>"
						class="main-post-title"
						target="_blank">
						<h1>
							<?= $mainPost->title ?>
						</h1>
					</a>
					<div class="text-center" style="margin-top: 20px;">
						<a
							href="https://www.facebook.com/sharer/sharer.php?u=<?= $this->Url->build($mainPost->postUrl, ['fullBase' => true]) ?>"
							target="_blank"
							class="btn btn-primary">
							<span class="fa fa-facebook"></span> Compartilhar no Facebook
						</a>
						<a
							via="gogodogplease"
							href="https://twitter.com/intent/tweet?text=<?= urlencode('Acabei de ler em -')?>&via=gogodogplease&url=<?= urlencode($this->Url->build($mainPost->postUrl, ['fullBase' => true])) ?>"
							target="_blank"
							class="btn btn-info">
							<span class="fa fa-twitter"></span> Compartilhar Twitter
						</a>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<!-- <div class="horizontal-banner">
	
</div> -->

<div class="container-fluid" style="margin-top: 100px;">
	<div class="row">
		<div class="col-xs-12 col-md-9 col-sm-9 hidden-xs">
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
		<div class="col-xs-12 col-md-3 col-sm-3">
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