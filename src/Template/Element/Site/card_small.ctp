<?php foreach ($posts as $key => $post): ?>
	<div class="media">
		<div class="media-left">
			<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank">
				<img
					style="width: 60px; height: 60px;"
					class="card-image-async"
					src="<?= $this->Url->build($post->small_post_image_lr) ?>" class="media-object card-small-image"
					data-original-src="<?= $this->Url->build($post->small_post_image) ?>" class="media-object card-small-image">
			</a>
		</div>
		<div class="media-body">
			<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank" class="article-title-small">
				<h1 class="media-heading">
					<?= $post['title'] ?>
				</h1>
			</a>
		</div>
	</div>
<?php endforeach ?>	