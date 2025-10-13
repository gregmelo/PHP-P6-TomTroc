<?php

/**
 * Vue : Formulaire d'inscription
 * Affiche le formulaire pour créer un compte utilisateur
 * Variables attendues :
 *   - $errors : tableau des erreurs éventuelles
 */
$title = "page d'inscription";
?>

<!-- Formulaire d'inscription -->
<div class="content-login">
    <!-- Section formulaire -->
    <section class="connexion">
        <h2>Inscription</h2>
        <form action="index.php?page=process_register" method="post">
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <button type="btn" class="btn">S'inscrire</button>
            <p>Déjà inscrit ? <a href="index.php?page=login">Connectez-vous</a></p>
        </form>
    </section>
    <!-- Illustration à droite -->
    <section class="illustration-connexion">
        <img src="./assets/connexion/illustration_connexion.jpg" alt="Illustration de connexion">
    </section>
</div>