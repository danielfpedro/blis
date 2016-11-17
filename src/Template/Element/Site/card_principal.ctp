<?php foreach ($posts as $key => $post): ?>
	<div class="grid-item">
		<div class="grid-item-wrap article-wrap">
			<!-- <a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank"> -->
			<a href="<?= $this->Url->build($post->viewUrl) ?>" target="_blank">
				<div
					class="card-image"
					style="background-image: url(<?= $post->imagePath ?>)">
				</div>
			</a>
			<div class="article-body">
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