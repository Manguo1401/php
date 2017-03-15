<?php

namespace App\Table;

use App\App;

class Table {

	protected static $table;

	/**
	 * static permet d'appeler la class où la fonction est appelée. Exemple : Article::getTable() appellera Article et pas Table. self::getTable() appelerai Table
	 */

	private static function getTable() {
		if(static::$table === null) {
			$class_name = explode('\\', get_called_class());
			static::$table = strtolower(end($class_name)) . 's';
		}
		return static::$table;
	}

	/**
	 * Permet de charger les méthodes de cette classe dans les appeler en tant que fonction mais en tant que varialbe cimpe : exemple : transforme getURL() en url. Ou getExtrait() en extrait
	 * @param  [type] $key Permet de stocker la méthode pour quelle soit appelée qu'une seule fois
	 * @return [type]      [description]
	 */
	public function __get($key) {
		$method = 'get' . ucfirst($key);
		//Pour appeler la méthode qu'une seule fois
		$this->$key = $this->$method();
		return $this->$key;
	}

	public static function all() {
		return App::getDb()->query("
			SELECT * 
			FROM " . static::$table,
			get_called_class()
		);
	}

	/**
	 * Fonction permettant de créer l'url pour les arcticles
	 */
	
	public function getURL() {
		return 'index.php?p=article&id=' . $this->id;
	}

	public static function find($id) {
		return static::query("
			SELECT * 
			FROM " . static::$table . " 
			WHERE id = " . $id,
			[$id],
			true
		);
	}

	public static function query($statement, $attrs = null, $one = false) {
		if($attrs) {
			return App::getDb()->prepare($statement, $attrs, get_called_class(), $one);
		} else {
			return App::getDb()->query($statement, get_called_class(), $one);
		}
			
	}
}