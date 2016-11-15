<?= $this->Html->script('Site/home', ['block' => true]) ?>

<?= $this->cell('Navbar') ?>

<div class="offse-to-top"></div>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?= $this->element('Site/card_principal', ['posts' => [$posts->toArray()[0]]]) ?>		
		</div>
	</div>
</div>

<div class="grid">	    
	<?= $this->element('Site/card_principal', ['posts' => $posts]) ?>
</div>

<h1
	class="load-more"
	data-base-url="<?= $this->url->build(['controller' => 'Site', 'action' => 'loadMore']) ?>">
	Load More
</h1>	
