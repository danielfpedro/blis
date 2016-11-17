<?php foreach ($posts as $key => $post): ?>
	<div class="media">
		<div class="media-left">
			<a href="<?= $this->Url->build($post->viewUrl) ?>">
				<img src="<?= $post->squaredImagePath ?>" class="media-object card-small-image">
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