<?php 

require '../app/Autoloader.php';

App\Autoloader::register();


/**
 * Conditionnelle permettant de rediriger sur la page que l'on met en get (dans l'url).
 * Si la variable donne un nom de page on va sur cette page sinon on va sur home et on donne la valeur 'home' à $p
 * @var  $p string représente le nom de la page que l'on cherche
 * ob_start() et ob_get_clean permette de stocker tout ce qui se passe dans une variable entre les 2
 */

ob_start();
if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

/**
 * [$p description]
 * @var [type]
 */
if($p == 'home') {
	require '../pages/home.php';
} elseif ($p == 'article') {
	require '../pages/single.php';
} elseif ($p === 'categorie') {
	require '../pages/categorie.php';
}
$content = ob_get_clean();

/**
 * Une fois que l'on a chopper le contenu de la page ciblée on peut l'injecter dans le templat principal
 */

require '../pages/templates/default.php';