<?php foreach ($posts as $key => $post): ?>
	<div class="media">
		<div class="media-left">
			<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank">
				<div
					class="card-image-async-wrap"
					style="background-color: red; height: auto; min-height: 60px;">
					<img
						style="width: 60px; height: 60px;"
						class=""
						data-base-url="<?= $this->Url->build() ?>"
						class="media-object card-small-image"
						data-original-src="<?= $this->Url->build($post->small_post_image) ?>" class="media-object card-small-image">
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