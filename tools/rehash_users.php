<?php

/**
 * Script pour régénérer les mots de passe hashés des utilisateurs existants
 * À lancer une seule fois puis supprimer pour la sécurité
 * Utilise les identifiants en clair pour mettre à jour la base
 */

require_once __DIR__ . '/../config/_config.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tableau des utilisateurs et mots de passe en clair
    $users = [
        ['pseudo' => 'Alexlecture', 'password' => 'Alex2024!'],
        ['pseudo' => 'Nathalire', 'password' => 'Nath1234#'],
        ['pseudo' => 'Sas634', 'password' => 'SasPass!7'],
        ['pseudo' => 'CamilleClubLit', 'password' => 'CamilleCL1$'],
        ['pseudo' => 'Hugo1990_12', 'password' => 'Hugo1990@'],
        ['pseudo' => 'Juju1432', 'password' => 'Juju!432'],
        ['pseudo' => 'Christiane75014', 'password' => 'Chris7501#'],
        ['pseudo' => 'Hamzalecture', 'password' => 'HamzaLect!'],
        ['pseudo' => 'Lou&Ben50', 'password' => 'LouBen50$'],
        ['pseudo' => 'Lolobzh', 'password' => 'LoloBZH12!'],
        ['pseudo' => 'ML95', 'password' => 'MLpass95#'],
        ['pseudo' => 'AnnikaBrahms', 'password' => 'AnnikaB!24'],
        ['pseudo' => 'Victoirefabr912', 'password' => 'VicFabr912$'],
        ['pseudo' => 'Lotrfanclub67', 'password' => 'LotrFan67!'],
    ];

    foreach ($users as $user) {
        $hash = password_hash($user['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE user SET password = :password WHERE pseudo = :pseudo");
        $stmt->execute(['password' => $hash, 'pseudo' => $user['pseudo']]);
        echo "Utilisateur " . $user['pseudo'] . " mis à jour.<br>";
    }
    echo "Terminé !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
