<?php

	namespace App;
	
	use \PDO;

	class Database {

		/**
		 * On appelle nos différentes variables pour les paramètres de la la bdd
		 */
		private $db_name;
		private $db_user;
		private $db_pass;
		private $db_host;
		private $pdo;

		/**
		 * On lance le constructeur pour se connecter à la BDD
		 * @param string $db_name Nom de la base
		 * @param string $db_user Nom de l'admin
		 * @param string $db_pass Le pass de l'admin
		 * @param string $db_host L'host qui gère la base
		 */
		public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost') {
			$this->db_name = $db_name;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
			$this->db_host = $db_host;
		}

		/**
		 * On lance la connexion à la BDD en séparée par rapport au constructeur pour éviter de s'y connecter quand elle n'est pas appelée
		 */
		
		private function getPDO() {

			/**
			 * On verifie si on est déjà connecté à la base de données pour ne pas la relancer à chaque nouvelle requête (query)
			 */

			if($this->pdo === null) {
				/**
				 * Permet de lancer une nouvelle instance de PDO pour se connecter à la BDD
				 */
				$pdo = new PDO('mysql:dbname=tutopoo;host=localhost', 'root', '');

				/**
				 * Permet de voir les erreurs sql
				 */
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				/**
				 * $this->pdo créé une variable privée pour l'accès à la base de données
				 */
				$this->pdo = $pdo;
			}

			/**
			 * On lance la connexion à la BDD
			 */
			
			return $this->pdo;

		}

		public function query($statement, $class_name, $one = false) {

			/**
			 * Lance la requête pour récupérer le contenu d'une table en appelant la fonction pour la connexion à la BDD
			 * @var [type]
			 */

			$req = $this->getPDO()->query($statement);
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name); 
			/**
			 * Récupère toutes les données dans la query et nous les montre sous forme d'objets
			 */

			if($one === true) {
				$data = $req->fetch();
			} else {
				$data = $req->fetchAll();
			}
			return $data;
		}

		/**
		 * Pour éviter les injections sql on doit remplacer query par prepare
		 */
		
		public function prepare($statement, $attrs, $class_name, $one = false) {
			$req = $this->getPDO()->prepare($statement);
			$req->execute($attrs);
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name); 
			if($one === true) {
				$data = $req->fetch();
			} else {
				$data = $req->fetchAll();
			}
			
			return $data;
		}
	}