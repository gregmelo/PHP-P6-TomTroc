<?php

$id_user = isset($_GET['id']) ? intval($_GET['id']) : null;
require_once __DIR__ . '/../config/_config.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/BooksModel.php';

$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$userModel = new UserModel($pdo);
$booksModel = new BooksModel($pdo);

$user = $id_user ? $userModel->getUserById($id_user) : null;
$books = $id_user ? $booksModel->getUserBooks($id_user) : [];

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
<div class="content-public-account">
    <div class="public-account-infos-group">
        <section class="public-account-infos">
            <img src="<?= htmlspecialchars($user['avatar'] ?? 'assets/users/default.png') ?>" alt="Avatar de <?= htmlspecialchars($user['pseudo'] ?? '') ?>" class="avatar-public-account">
            <hr>
            <h2><?= htmlspecialchars($user['pseudo'] ?? '') ?></h2>
            <p class="public-account-during">Membre depuis <?php echo getMemberDuration($user['creation_date']); ?></p>
            <h3>bibliothèque</h3>
            <p class="books-numbers"><i class="fa-solid fa-book"></i> <?= count($books) ?> livres</p>
            <button type="submit" class="btn">Écrire un message</button>
        </section>
    </div>
    <section class="public-account-books-list">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="public-account-book-card">
                    <div class="public-account-book-infos">
                        <img src="<?= htmlspecialchars($book['cover'] ?? 'assets/books/default.png') ?>" alt="couverture du livre">
                        <div class="public-account-book-details">
                            <p><?= htmlspecialchars($book['title'] ?? '') ?></p>
                            <p><?= htmlspecialchars($book['author'] ?? '') ?></p>
                        </div>
                    </div>
                    <p><?= nl2br(htmlspecialchars($book['description'] ?? '')) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre dans la bibliothèque.</p>
        <?php endif; ?>
    </section>
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
                            <td><img src="<?= htmlspecialchars($book['cover'] ?? 'assets/books/default.png') ?>" alt="couverture du livre" width="80"></td>
                            <td><?= htmlspecialchars($book['title'] ?? '') ?></td>
                            <td><?= htmlspecialchars($book['author'] ?? '') ?></td>
                            <td class="description-cell">
                                <?= nl2br(htmlspecialchars($book['description'] ?? '')) ?>
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