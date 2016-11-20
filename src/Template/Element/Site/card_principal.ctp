<?php foreach ($posts as $key => $post): ?>
	<div class="grid-item">
		<div class="grid-item-wrap article-wrap">
			<!-- <a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank"> -->
			<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank">
				<!-- <div
					class="card-image"
					style="background-image: url(<?= $this->Url->build($post->imagePath) ?>)">
				</div> -->
				<div style="background-color: red; height: auto; min-height: 150px;">
					<img
						style="width: 100%; height: 100%;"
						class="card-image-async"
						src="<?= $this->Url->build($post->main_post_image_lr) ?>"
						data-original-src="<?= $this->Url->build($post->main_post_image) ?>">
				</div>
			</a>
			<div class="article-body">
				<?php if ($showCategoryName): ?>
					<?= $this->Html->link($post->category->name, [
						'controller' => 'Site',
						'action' => 'category',
						'slug' => $post->category->slug
					], [
						'class' => 'article-category'
					]) ?>
				<?php endif ?>
				<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank" class="article-title">
					<h1>
						<?= $post['title'] ?>
					</h1>
				</a>
				<p class="article-subtitle">
					<?= $post['subtitle'] ?>
				</p>
			</div>
		</div>
		<br style="clear: both;">
	</div>
<?php endforeach ?>	