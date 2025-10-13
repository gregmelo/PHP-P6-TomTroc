# TomTroc

## Menu
- [Introduction](#introduction)
- [Utilisation du projet](#utilisation-du-projet)
- [Installation de la base de données](#installation-de-la-base-de-données)
- [Lancement du projet](#lancement-du-projet)
- [Identifiants de test](#identifiants-de-test)
- [Problèmes courants](#problèmes-courants)
- [Auteur](#auteur)
- [Copyright](#copyright)

## Introduction
TomTroc est une plateforme d’échange de livres entre particuliers. Elle permet aux utilisateurs de proposer leurs livres à l’échange, de consulter le catalogue, de contacter d’autres membres et de gérer leur compte. Le projet est réalisé en PHP avec une architecture MVC.

## Utilisation du projet
- Accédez à la page d’accueil pour voir les livres disponibles.
- Utilisez la barre de recherche pour filtrer les livres par titre.
- Créez un compte ou connectez-vous pour proposer vos livres ou contacter d’autres membres.
- Consultez les détails d’un livre en cliquant sur sa fiche.

## Installation de la base de données
1. Créez une base de données MySQL (ex : `tomtroc`).
2. Importez le fichier SQL fourni (ex : `database.sql`) pour créer les tables et insérer les données de test.
3. Configurez les accès à la base dans `config/_config.php` :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tomtroc');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

## Lancement du projet
- Placez le dossier du projet dans le répertoire web de votre serveur (ex : `htdocs` pour XAMPP).
- Lancez Apache et MySQL via XAMPP.
- Accédez à l’URL : `http://localhost/PHP-P6-TomTroc/index.php`

## Identifiants de test
Voici quelques comptes de test pour vous connecter :

| Pseudo          | Mot de passe |
|-----------------|--------------|
| Alexlecture     | Alex2024!    |
| Nathalire       | Nath1234#    |
| Sas634          | SasPass!7    |
| CamilleClubLit  | CamilleCL1$  |
| Hugo1990_12     | Hugo1990@    |
| Juju1432        | Juju!432     |
| Christiane75014 | Chris7501#   |
| Hamzalecture    | HamzaLect!   |
| Lou&Ben50       | LouBen50$    |
| Lolobzh         | LoloBZH12!   |
| ML95            | MLpass95#    |
| AnnikaBrahms    | AnnikaB!24   |
| Victoirefabr912 | VicFabr912$  |
| Lotrfanclub67   | LotrFan67!   |

## Problèmes courants
- **Page blanche ou erreur 500** : Vérifiez la configuration de la base de données et les droits d’accès.
- **Impossible de se connecter** : Vérifiez les identifiants et la casse.
- **Images non affichées** : Vérifiez le chemin des fichiers dans le dossier `assets/books`.
- **Recherche non fonctionnelle** : Assurez-vous que le paramètre `page=books` est bien transmis dans le formulaire.

## Auteur
Grégory Véricel - [LinkedIn](https://www.linkedin.com/in/gregory-vericel/) - gregoryvericel6@gmail.com

N’hésite pas à contribuer ou à poser des questions !

## Copyright
© 2025 Projet utilisé dans le cadre d'une formation Openclassrooms.
