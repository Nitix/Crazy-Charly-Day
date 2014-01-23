<?php

include ('database.php');
/**
 * Gere la connection avec la bdd 
 */
class Base {
	
	/**
	 * Connection en cours
	 */
	public static $db;
	
	/**
	 * Retourne la connection, en crée une si besoin
	 * @return PDO connexion
	 */
	static public function getConnection() {
		if (isset($db)) {
			return $db;
		} else {
			try {
				$database = new Database();
				$dsn = "mysql:host=".Database::$host.";dbname=".Database::$database;
				$db = new PDO($dsn, Database::$user, Database::$password, array(PDO::ATTR_ERRMODE => true, PDO::ERRMODE_EXCEPTION => true, PDO::ATTR_PERSISTENT => true));
				$db -> exec("SET CHARACTER SET utf8");
				return $db;
			} catch(PDOException $e) {
				echo $e -> getMessage();
				exit();
			}
		}

	}

}
