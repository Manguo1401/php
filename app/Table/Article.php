<?php

namespace App\Table;

use App\App;

class Article extends Table {

	protected static $table = 'articles';

	public static function find($id) {
		return self::query("
			SELECT articles.id, articles.titre, articles.contenu, categories.titre as categorie
			FROM articles 
			LEFT JOIN categories ON category_id = categories.id
			WHERE articles.id = " . $id,
			[$id],
			true
		);
	}

	/**
	 * récupére les derniers articles
	 * @return [type] [description]
	 */
	public static function getLast() {
		return self::query("
			SELECT articles.id as id, articles.titre as titre, articles.contenu as contenu, categories.titre as categorie 
			FROM articles 
			LEFT JOIN categories ON category_id = categories.id
		");
	}

	/**
	 * Fonction permettant de créer l'url pour les arcticles
	 */
	
	public function getURL() {
		return 'index.php?p=article&id=' . $this->id;
	}

	/**
	 * Fonction pour récupérer l'extrait 
	 */
	
	public function getExtrait() {
		$html =  '<p>' . substr($this->contenu, 0, 100) . ' ...</p>';
		$html .= '<p><a href="' . $this->getURL() . '">Voir la suite</a></p>';
		return $html;
	}


	public static function lastByCategory($category_id) {
		return self::query("
			SELECT articles.id as id, articles.titre as titre, articles.contenu as contenu, categories.titre as categorie 
			FROM articles 
			LEFT JOIN categories ON category_id = categories.id
			WHERE category_id = " . $category_id,
			[$category_id]
		);
	}
}