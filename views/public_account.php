<?php

/**
 * Vue : Profil public d'un utilisateur
 * Affiche les infos et la bibliothèque d'un autre utilisateur
 * Variables attendues :
 *   - $user : tableau des infos utilisateur
 *   - $books : tableau des livres de l'utilisateur
 */

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

// Helper pour récupérer une valeur d'un User (objet) ou d'un tableau
function user_get($user, $key, $default = '')
{
    if (is_object($user)) {
        // Convertit snake_case en method getXxx
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        if (method_exists($user, $method)) {
            return $user->{$method}();
        }
    }
    return is_array($user) && isset($user[$key]) ? $user[$key] : $default;
}
?>
<!-- Contenu principal du profil public -->
<div class="content-public-account">
    <!-- Infos utilisateur -->
    <div class="public-account-infos-group">
        <section class="public-account-infos">
            <img src="<?= htmlspecialchars(user_get($user, 'avatar', 'assets/users/default.png')) ?>" alt="Avatar de <?= htmlspecialchars(user_get($user, 'pseudo', '')) ?>" class="avatar-public-account">
            <hr>
            <h1><?= htmlspecialchars(user_get($user, 'pseudo', '')) ?></h1>
            <p class="public-account-during">Membre depuis <?php echo getMemberDuration(user_get($user, 'creation_date', '')); ?></p>
            <h2>bibliothèque</h2>
            <p class="books-numbers"><i class="fa-solid fa-book"></i> <?= count($books) ?> livres</p>
            <!--<button type="submit" class="btn">Écrire un message</button>-->
            <?php if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == user_get($user, 'id')): ?>
                <button type="button" class="btn btn-disabled">Écrire un message</button>
            <?php else: ?>
                <button type="button" onclick="location.href='index.php?page=messages&with=<?= user_get($user, 'id') ?>'" class="btn">Écrire un message</button>
            <?php endif; ?>
        </section>
    </div>
    <!-- Liste des livres de l'utilisateur (cartes) -->
    <section class="public-account-books-list">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="public-account-book-card">
                    <div class="public-account-book-infos">
                        <img src="<?= htmlspecialchars($book->getCover() ?? 'assets/books/default.png') ?>" alt="couverture du livre">
                        <div class="public-account-book-details">
                            <p><?= htmlspecialchars($book->getTitle() ?? '') ?></p>
                            <p><?= htmlspecialchars($book->getAuthor() ?? '') ?></p>
                        </div>
                    </div>
                    <p><?= nl2br(htmlspecialchars($book->getDescription() ?? '')) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun livre dans la bibliothèque.</td>
            </tr>
        <?php endif; ?>
    </section>
    <!-- Tableau des livres de l'utilisateur -->
    <section class="public-account-books-table">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($book->getCover() ?? 'assets/books/default.png') ?>" alt="couverture du livre" width="80"></td>
                            <td><?= htmlspecialchars($book->getTitle() ?? '') ?></td>
                            <td><?= htmlspecialchars($book->getAuthor() ?? '') ?></td>
                            <td class="description-cell">
                                <?= nl2br(htmlspecialchars($book->getDescription() ?? '')) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun livre dans la bibliothèque.</p>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</div>