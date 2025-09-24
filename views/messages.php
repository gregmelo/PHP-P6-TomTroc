<div class="messages-container">
    <aside class="messages-list">
        <h1>Messagerie</h1>
        <div class="message-card" data-conversation="1">
            <img src="assets/users/Alexlecture.jpg" alt="Photo de profil de l'utilisateur">
            <div class="message-infos">
                <div class="message-details">
                    <p class="message-username">Alexlecture</p>
                    <p class="message-time">15:43</p>
                </div>
                <p class="last-message">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <hr>
        <div class="message-card" data-conversation="2">
            <img src="assets/users/Nathalire.jpg" alt="Photo de profil de l'utilisateur">
            <div class="message-infos">
                <div class="message-details">
                    <p class="message-username">Nathalire</p>
                    <p class="message-time">20:08</p>
                </div>
                <p class="last-message">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <hr>
        <div class="message-card" data-conversation="3">
            <img src="assets/users/Sas634.jpg" alt="Photo de profil de l'utilisateur">
            <div class="message-infos">
                <div class="message-details">
                    <p class="message-username">Sas634</p>
                    <p class="message-time">15:08</p>
                </div>
                <p class="last-message">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
        <hr>
    </aside>
    <section class="conversation-content">
        <!-- Conversation sélectionnée s'affichera ici -->
        <!--<div class="conversation-placeholder">Sélectionnez une conversation</div>-->

        <button class="btn-retour"><i class="fa fa-arrow-left"></i> retour</button>

        <div class="conversation-details">
            <div class="conversation-header">
                <img src="assets/users/Alexlecture.jpg" alt="Photo de profil de l'utilisateur">
                <p class="conversation-username">Alexlecture</p>
            </div>
            <div class="conversation-messages">
                <div class="conversation-recipient">
                    <p class="conversation-time">21.08 15:44</p>
                    <p class="conversation-message">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="conversation-sender">
                    <div class="sender">
                        <img src="assets/users/Alexlecture.jpg" alt="Photo de profil de l'utilisateur">
                        <p class="conversation-time"> 21.08 15:44</p>
                    </div>
                    <p class="conversation-message">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <form class="message-form">
                <input type="text" placeholder="Écrire un message..." />
                <button type="submit" class="btn">Envoyer</button>
            </form>


        </div>
    </section>
</div>


<script>
    // Récupère le HTML de la conversation statique
    const conversationHTML = document.querySelector('.conversation-content').innerHTML;

    document.querySelectorAll('.message-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelector('.conversation-content').innerHTML = conversationHTML;
            document.querySelector('.messages-list').style.display = 'none';
            document.querySelector('.conversation-content').style.display = 'block';
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-retour')) {
            document.querySelector('.messages-list').style.display = 'block';
            document.querySelector('.conversation-content').style.display = 'none';
        }
    });
</script>