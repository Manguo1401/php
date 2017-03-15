<?php

	use App\Table\Article;
	use App\Table\Categorie;
	use App\App;

	$category = Categorie::find($_GET['id']);

	if($category === false) {
		App::notFound();
	}

	$articles = Article::lastByCategory($_GET['id']);

	$categories = Categorie::all();

?>

<h1><?= $category->titre; ?></h1>

<div class="row">
	<div class="col-md-8">
		<?php 
			foreach ($articles as $post):
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
			<?php foreach($categories as $categorie): ?>
				<li>
					<a href="<?= $categorie->url; ?>">
						<?= $categorie->titre; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
