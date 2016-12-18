<div class="hidden-xs">
	<?= $this->element('Site/card_small', ['posts' => $posts]) ?>
</div>
<div class="visible-xs">
	<?= $this->element('Site/card_principal', ['posts' => $posts]) ?>
</div>