<?= $this->Html->script('Site/home', ['block' => true]) ?>

<?= $this->cell('Navbar') ?>

<div class="offse-to-top"></div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<div class="grid">	    
				<?= $this->element('Site/card_principal', ['posts' => $posts]) ?>
			</div>
		</div>
		<div class="col-md-3" style="margin-left: -10px;">
			<?= $this->element('Site/card_small', ['posts' => $posts]) ?>
			<div id="load-more-small-container"></div>
			<h1
				class="load-more-small"
				data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMoreSmall']) ?>">
				Load More
			</h1>	

		</div>
	</div>
</div>

<h1
	class="load-more"
	data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore']) ?>">
	Load More
</h1>	
