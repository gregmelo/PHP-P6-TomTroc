<?php

/**
 * Vue : Modification d'un livre
 * Affiche le formulaire d'édition d'un livre
 * Variables attendues :
 *   - $book : tableau des infos du livre à modifier
 */
$title = "Page de modification du livre";
?>

<!-- Contenu principal de la page édition livre -->
<div class="content-book-edit">
    <!-- Navigation retour vers le compte -->
    <a href="index.php?page=account">
        <section class="book-edit-navigation"><i class="fa fa-arrow-left"></i> retour</section>
    </a>
    <!-- Formulaire d'édition du livre -->
    <div class="content-book-edit-form">
        <h1>Modifier les informations</h1>
        <form action="index.php?page=book_update&id=<?= $book['id'] ?>" method="post" enctype="multipart/form-data" id="book-edit-form">
            <!-- Section image du livre -->
            <div class="form-group form-group-img">
                <label for="photo-edit-upload">Photo</label>
                <img src="<?= htmlspecialchars($book['cover']) ?>" alt="couverture du livre <?= htmlspecialchars($book['title'] ?? '') ?>">
                <button type="button" id="book-edit-photo-btn">Modifier la photo</button>
                <input type="file" accept="image/*" style="display:none;" id="photo-edit-upload">
            </div>
            <!-- Champs du formulaire -->
            <div class="form-group-fields">
                <div class="form-group" style="display: none;">
                    <label for="cover-upload" style="display:none;">Couverture</label>
                    <input type="file" name="cover" id="cover-upload" accept="image/*" style="display:none;">
                </div>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="author">Auteur</label>
                    <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <textarea id="commentaire" name="commentaire" required>
                        <?= htmlspecialchars($book['description'] ?? '') ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="status">Statut</label>
                    <div class="select-wrapper">
                        <select class="select-custom" id="status" name="status">
                            <option value="disponible" <?= ($book['availability'] ?? '') === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                            <option value="indisponible" <?= ($book['availability'] ?? '') === 'Indisponible' ? 'selected' : '' ?>>Indisponible</option>
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
                <button type="submit" class="btn">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Script JS pour la gestion de l'upload de photo -->
<script>
    document.getElementById('book-edit-photo-btn').addEventListener('click', function() {
        document.getElementById('cover-upload').click();
    });
    document.getElementById('cover-upload').addEventListener('change', function() {
        document.getElementById('book-edit-form').submit();
    });
</script>