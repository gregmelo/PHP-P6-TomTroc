<?php $title = "Page de connexion"; ?>

<!-- Formulaire de connexion -->
<div class="content-login">
    <section class="connexion">
        <h2>Connexion</h2>
        <form action="index.php?page=process_login" method="post">
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
            <button type="btn" class="btn">Se connecter</button>
            <p>Pas encore de compte ? <a href="index.php?page=register">Inscrivez-vous</a></p>
        </form>
    </section>
    <section class="illustration-connexion">
        <img src="./assets/connexion/illustration_connexion.jpg" alt="Illustration de connexion">
    </section>
</div>