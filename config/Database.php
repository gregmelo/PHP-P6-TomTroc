<?php
/**
 * Classe utilitaire pour gérer la connexion PDO
 * Utilise le pattern singleton pour réutiliser une seule connexion
 */
class Database
{
    /** @var PDO|null */
    private static $instance = null;

    private function __construct()
    {
        // Constructeur privé pour empêcher qu'on fasse new Database() de l'extérieur.
        //Sans constructeur privé la classe serait instanciable par n'importe qui.
    }

    /**
     * Retourne l'instance PDO unique
     * @return PDO
     * @throws PDOException
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);
        }
        return self::$instance;
    }

    private function __clone()
    {
        //empêche qu'on clone l'instance (clone $db). Sans __clone privé, on pourrait dupliquer l'instance et casser l'unicité.
        
    }

    public function __wakeup()
    {
        // Empêche la désérialisation de l'instance
        throw new \Exception('Cannot unserialize Database');
    }
}
