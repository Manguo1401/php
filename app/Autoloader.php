<?php

namespace App;

class Autoloader {
	/**
	 * Enregistre notre autoloader
	 */
	static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	/**
	 * Inclue le fichier corrspondand à notre classe
	 * @param   $class string le nom de la classe à charger
	 *
	 * Explication : 
	 * - Si en début de l'arborescence du fichier de classe on trouve le nom du namespace courant on l'élimine de la chaine. 
	 * - On remplace les anti - slashs par des slashs pour rendre lisible notre arborescence
	 * - On appelle les classes demandées par l'autoload avec un le dossier parent __DIR__
	 */
	
	static function autoload($class) {
		if(strpos($class, __NAMESPACE__ . '\\') === 0) {
			$class = str_replace(__NAMESPACE__ . '\\', '', $class);
			$class = str_replace('\\', '/', $class);
			require __DIR__ . '/' . $class . '.php';
		}
	}
}