<?= $this->Html->script('Site/home', ['block' => true]) ?>

<?= $this->cell('Navbar') ?>

<div class="offse-to-top"></div>

<div class="horizontal-banner">
	
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<div class="" style="width: 100%">
				<a href="<?= $this->Url->build($mainPost->viewUrl) ?>" target="_blank">
					<div
						class="card-image"
						style="background-image: url(<?= $mainPost->imagePath ?>)">
					</div>
					<h3>
						<?= $mainPost->title ?>
					</h3>
					<p>
						<?= $mainPost->subtitle ?>
					</p>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-9 col-sm-9">
			<h2>Populares</h2>
			<?= $this->cell('MainPosts', ['notIn' => [(int)$mainPost->id]]) ?>
			<h1
				class="load-more"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore']) ?>"
				data-not-in="<?= (int)$mainPost->id ?>"
				data-page="2">
				Load More
			</h1>
		</div>

		<div class="col-md-3 col-sm-3" style="margin-left: -15px">
			<h2>
				Recentes
			</h2>
			<?= $this->cell('RecentPosts', ['notIn' => [(int)$mainPost->id]]) ?>
			<div id="load-more-small-container"></div>
			<h1
				class="load-more-small"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMoreSmall']) ?>"
				data-not-in="<?= (int)$mainPost->id ?>"
				data-page="2">
				Load More
			</h1>	

		</div>
	</div>
</div>
