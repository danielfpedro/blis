<?php foreach ($posts as $key => $post): ?>
	<div class="grid-item">
		<div class="grid-item-wrap">
			<a href="<?= $post['url'] ?>" target="_blank">
				<div
					class="card-image"
					style="background-image: url(<?= $post['img'] ?>)">
				</div>
				<h3>
					<?= $post['title'] ?>
				</h3>
				<h5>
					<?= $post['subtitle'] ?>
				</h5>
			</a>
		</div>
	</div>
	<div style="clear: both;"></div>
<?php endforeach ?>	