<?php

/**
 * Vue : Mon compte utilisateur
 * Affiche les informations personnelles et la bibliothèque de l'utilisateur
 * Variables attendues :
 *   - $user : tableau des infos utilisateur
 *   - $userBooks : tableau des livres de l'utilisateur
 *   - $errors, $success : messages éventuels
 */
$title = "Page mon compte";
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}
$user = isset($user) ? $user : $_SESSION['user'];

// Helper pour récupérer une propriété utilisateur (supporte objet User ou tableau)
function user_get($user, $key)
{
    if (is_object($user)) {
        switch ($key) {
            case 'avatar': return $user->getAvatar();
            case 'pseudo': return $user->getPseudo();
            case 'email': return $user->getEmail();
            case 'creation_date': return $user->getCreationDate();
            case 'id': return $user->getId();
            default: return null;
        }
    }
    return $user[$key] ?? null;
}

// Fonction pour calculer la durée d'adhésion
function getMemberDuration($creation_date)
{
    $date = new DateTime($creation_date);
    $now = new DateTime();
    $interval = $date->diff($now);

    if ($interval->y >= 1) {
        return $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
    } elseif ($interval->m >= 1) {
        return $interval->m . ' mois';
    } elseif ($interval->days < 31) {
        return 'moins d\'un mois';
    }
    return '';
}
?>

<!-- Contenu principal de la page compte utilisateur -->
<div class="content-account">
    <h1>Mon compte</h1>
    <!-- Informations et formulaire utilisateur -->
    <div class="account-infos-group">
        <!-- Section infos utilisateur -->
        <section class="account-infos">
            <img src="<?php echo htmlspecialchars(user_get($user,'avatar') ?? 'assets/users/default.png'); ?>" alt="Avatar de <?php echo htmlspecialchars(user_get($user,'pseudo') ?? ''); ?>" class="avatar-account">
            <button type="button" id="change-photo-btn">modifier</button>
            <h2><?php echo htmlspecialchars(user_get($user,'pseudo') ?? ''); ?></h2>
            <p class="account-during">Membre depuis <?php echo getMemberDuration(user_get($user,'creation_date') ?? date('Y-m-d H:i:s')); ?></p>
            <h3>bibliothèque</h3>
            <p class="books-numbers"><i class="fa-solid fa-book"></i> <?php echo count($userBooks); ?> livre<?php echo count($userBooks) > 1 ? 's' : ''; ?></p>
        </section>
        <!-- Section formulaire de modification -->
        <section class="personal-infos">
            <p>Vos informations personnelles</p>
            <form action="index.php?page=updateAccount" method="post" enctype="multipart/form-data" id="account-form">
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars(user_get($user,'email') ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="photo-upload" style="display:none;">Avatar</label>
                    <input type="file" name="avatar" id="photo-upload" accept="image/*" style="display:none;">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" value="" placeholder="************">
                    <small class="infos-password">Laisser vide pour ne pas modifier le mot de passe</small>
                </div>
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" value="<?php echo htmlspecialchars(user_get($user,'pseudo') ?? ''); ?>" required>
                </div>
                <?php if (!empty($errors)): ?>
                    <div class="error">
                        <?php foreach ($errors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="success">
                        <p><?= htmlspecialchars($success) ?></p>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn">Enregistrer</button>
            </form>

        </section>
    </div>
    <!-- Liste des livres de l'utilisateur (cartes) -->
    <section class="account-books-list">
        <?php if (!empty($userBooks)): ?>
            <?php foreach ($userBooks as $book): ?>
                <div class="account-book-card">
                    <div class="account-book-infos">
                        <img src="<?= htmlspecialchars($book->getCover() ?? 'assets/books/default.png') ?>" alt="couverture du livre">
                        <div class="account-book-details">
                            <p><?= htmlspecialchars($book->getTitle()) ?></p>
                            <p><?= htmlspecialchars($book->getAuthor()) ?></p>
                            <?php /* debug: <?php // var_dump($book->getAvailability()); ?> */ ?>
                            <div class="tag<?= (strtolower($book->getAvailability() ?? '') === 'indisponible') ? ' tag-red' : '' ?>">
                                <?= htmlspecialchars($book->getAvailability() ?? 'Disponible') ?>
                            </div>
                        </div>
                    </div>
                    <p><?= htmlspecialchars($book->getDescription() ?? '') ?></p>
                    <div class="account-book-actions">
                        <a href="index.php?page=book_edit&id=<?= $book->getId() ?>" class="account-book-edit">&Eacute;diter</a>
                        <a href="#" class="account-book-delete">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun livre dans la bibliothèque.</td>
            </tr>
        <?php endif; ?>
    </section>
    <!-- Tableau des livres de l'utilisateur -->
    <section class="account-books-table">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($userBooks)): ?>
                    <?php foreach ($userBooks as $book): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($book->getCover() ?? 'assets/books/default.png') ?>" alt="couverture du livre 1" width="80"></td>
                            <td><?= htmlspecialchars($book->getTitle()) ?></td>
                            <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                            <td class="description-cell">
                                <?= htmlspecialchars($book->getDescription() ?? '') ?>
                            </td>
                            <td><span class="tag<?= (strtolower($book->getAvailability() ?? '') === 'indisponible') ? ' tag-red' : '' ?>"><?= htmlspecialchars($book->getAvailability() ?? 'Disponible') ?></span></td>
                            <td>
                                <a href="index.php?page=book_edit&id=<?= $book->getId() ?>" class="account-book-edit">&Eacute;diter</a>
                                <a href="index.php?page=book_delete&id=<?= $book->getId() ?>" class="account-book-delete">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun livre dans votre bibliothèque.</p>
                <?php endif; ?>
            </tbody>
        </table>

    </section>
</div>

<!-- Script JS pour la gestion de l'upload de photo -->
<script>
    document.getElementById('change-photo-btn').addEventListener('click', function() {
        document.getElementById('photo-upload').click();
    });
    document.getElementById('photo-upload').addEventListener('change', function() {
        document.getElementById('account-form').submit();
    });
</script>