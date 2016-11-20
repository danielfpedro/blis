<?php foreach ($posts as $key => $post): ?>
	<div class="grid-item">
		<div class="grid-item-wrap article-wrap">
			<!-- <a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank"> -->
			<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank">
				<img
					style="width: 100%; height: auto;"
					class="lazy"
					data-original="<?= $this->Url->build($post->imagePath) ?>" style="width: 100%; height: 100%;">
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