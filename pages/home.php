<?php 
	use App\Table\Article;
	use App\Table\Categorie;
?>

<div class="row">
	<div class="col-md-8">
		<?php 
			foreach (Article::getLast() as $post):
		?>

			<h2>
				<a href="<?= $post->url; ?>">
					<?= $post->titre; ?>
				</a>
			</h2>
			<p><em>
				<?= $post->categorie ?>
			</em></p>

			<?= $post->extrait; ?>



		<?php 
			endforeach; 
		?>
	</div>
	<div class="col-md-4">
		<ul>
			<?php foreach(Categorie::all() as $categorie): ?>
				<li>
					<a href="<?= $categorie->url; ?>">
						<?= $categorie->titre; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
