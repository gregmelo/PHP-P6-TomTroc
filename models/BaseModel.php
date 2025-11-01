<?php

// BaseModel centralise l'accès à la connexion PDO pour tous les modèles
require_once __DIR__ . '/../config/Database.php';

class BaseModel
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * BaseModel constructor.
     * @param PDO|null $pdo
     */
    public function __construct($pdo = null)
    {
        $this->pdo = $pdo ?: Database::getInstance();
    }
}
