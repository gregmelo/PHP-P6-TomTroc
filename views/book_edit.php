<div class="content-book-edit">
    <a href="index.php?page=account">
        <section class="book-edit-navigation"><i class="fa fa-arrow-left"></i> retour</section>
    </a>
    <div class="content-book-edit-form">
        <h1>Modifier les informations</h1>
        <form action="">
            <div class="form-group form-group-img">
                <label for="title">Photo</label>
                <img src="assets/books/book01.jpg" alt="couverture du livre 1">
                <button href="#" id="book-edit-photo-btn">Modifier la photo</button>
                <input type="file" accept="image/*" style="display:none;" id="photo-edit-upload">
            </div>
            <div class="form-group-fields">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="The Kinfolk Table" required>
            </div>
            <div class="form-group">
                <label for="author">Auteur</label>
                <input type="text" id="author" name="author" value="Nathan Williams" required>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea id="commentaire" name="commentaire" required>
J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table.

Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité.

Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers.

'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.</textarea>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <div class="select-wrapper">
                    <select class="select-custom" id="status" name="status">
                        <option value="available" selected>Disponible</option>
                        <option value="unavailable">Indisponible</option>
                    </select>
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <button type="submit" class="btn">Enregistrer</button>
            </div>
        </form>
    </div>
</div>