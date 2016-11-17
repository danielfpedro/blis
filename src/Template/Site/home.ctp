<?= $this->assign('title', 'Blis - Descubra os melhores conteúdos sobre a Cultura Pop') ?>
<?= $this->Html->script('Site/home', ['block' => true]) ?>

<?= $this->cell('Navbar') ?>

<div class="offset-to-top"></div>

<!-- <div class="horizontal-banner">
	
</div> -->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-9 col-sm-9">
			<h2 class="section-title">Populares</h2>
			<?= $this->cell('MainPosts') ?>

			<div
				class="load-more"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore']) ?>"
				data-page="2">
			</div>
		</div>
		<div class="col-md-3 col-sm-3" style="margin-left: -15px">
			<h2 class="section-title">
				Últimas
			</h2>
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