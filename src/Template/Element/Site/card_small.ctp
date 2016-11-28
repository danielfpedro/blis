<?php if ($posts): ?>
	<?php foreach ($posts as $key => $post): ?>
		<div class="media">
			<div class="media-left">
				<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank">
					<div
						class="card-image-small-async-wrap">
						<img
							class="media-object card-image-async card-image-small"
							data-base-url="<?= $this->request->webroot ?>"
							src="<?= $this->Url->build('/img/1px.png') ?>"
							data-original-src="<?= $this->Url->build($post->small_post_image) ?>">
					</div>
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
<?php endif ?>