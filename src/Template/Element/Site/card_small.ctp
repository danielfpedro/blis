<?php foreach ($posts as $key => $post): ?>
	<div class="media">
		<div class="media-left">
			<a href="#">
				<img src="<?= $post['img'] ?>" class="media-object" width="140">
			</a>
		</div>
		<div class="media-body">
			<a href="<?= $post['url'] ?>" target="_blank">
				<h4 class="media-heading">
					<?= $post['title'] ?>
				</h4>
			</a>
		</div>
	</div>
<?php endforeach ?>	