<div class="messages-container">
    <aside class="messages-list">
        <h1>Messagerie</h1>
        <?php if (!empty($conversations)): ?>
            <?php foreach ($conversations as $conv): ?>
                <a href="index.php?page=messages&with=<?= htmlspecialchars($conv['sender_id'] == $_SESSION['user']['id'] ? $conv['receiver_id'] : $conv['sender_id']) ?>" class="message-card" data-conversation="<?= htmlspecialchars($conv['sender_id'] == $_SESSION['user']['id'] ? $conv['receiver_id'] : $conv['sender_id']) ?>">
                    <img src="<?= htmlspecialchars($conv['avatar'] ?? 'assets/users/default.png') ?>" alt="Photo de profil de l'utilisateur">
                    <div class="message-infos">
                        <div class="message-details">
                            <p class="message-username"><?= htmlspecialchars($conv['pseudo']) ?></p>
                            <p class="message-time"><?= date('H:i', strtotime($conv['send_at'])) ?></p>
                        </div>
                        <p class="last-message"><?= htmlspecialchars($conv['content']) ?></p>
                        <?php if (isset($conv['message_read']) && !$conv['message_read'] && $conv['receiver_id'] == $_SESSION['user']['id']): ?>
                            <span class="unread-dot"></span>
                        <?php endif; ?>
                    </div>
                </a>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune conversation.</p>
        <?php endif; ?>
    </aside>
    <section class="conversation-content">
        <?php if (!empty($messages) || isset($_GET['with'])): ?>
            <button class="btn-retour"><i class="fa fa-arrow-left"></i> retour</button>
            <div class="conversation-details">
                <div class="conversation-header">
                    <img src="<?= htmlspecialchars($interlocuteur_avatar) ?>" alt="Photo de profil de l'utilisateur">
                    <p class="conversation-username"><?= htmlspecialchars($interlocuteur_pseudo) ?></p>
                </div>
                <div class="conversation-messages">
                    <?php foreach ($messages as $msg): ?>
                        <?php if ($msg['receiver_id'] == $_SESSION['user']['id']): ?>
                            <div class="conversation-sender">
                                <div class="sender">
                                    <img src="<?= htmlspecialchars($interlocuteur_avatar ?? 'assets/users/default.png') ?>" alt="Votre avatar">
                                    <p class="conversation-time"><?= date('d.m H:i', strtotime($msg['send_at'])) ?></p>
                                </div>
                                <p class="conversation-message"><?= htmlspecialchars($msg['content']) ?></p>
                            </div>
                        <?php else: ?>
                            <div class="conversation-recipient">
                                <p class="conversation-time"><?= date('d.m H:i', strtotime($msg['send_at'])) ?></p>
                                <p class="conversation-message"><?= htmlspecialchars($msg['content']) ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <form class="message-form" method="POST" action="index.php?page=messages_send">
                    <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($interlocuteur_id) ?>">
                    <input type="text" name="content" placeholder="Écrire un message..." required />
                    <button type="submit" class="btn">Envoyer</button>
                </form>
            </div>
        <?php else: ?>
            <div class="conversation-placeholder">Sélectionnez une conversation</div>
        <?php endif; ?>
    </section>
</div>


<script>
    // Responsive JS pour affichage des conversations
    const conversationHTML = document.querySelector('.conversation-content').innerHTML;

    function showConversation() {
        document.querySelector('.conversation-content').innerHTML = conversationHTML;
        if (window.matchMedia('(max-width: 1023px)').matches) {
            document.querySelector('.messages-list').style.display = 'none';
            document.querySelector('.conversation-content').style.display = 'block';
        } else {
            document.querySelector('.messages-list').style.display = 'block';
            document.querySelector('.conversation-content').style.display = 'block';
        }
    }

    document.querySelectorAll('.message-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (window.matchMedia('(max-width: 1023px)').matches) {
                e.preventDefault();
                showConversation();
            }
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-retour')) {
            if (window.matchMedia('(max-width: 1023px)').matches) {
                document.querySelector('.messages-list').style.display = 'block';
                document.querySelector('.conversation-content').style.display = 'none';
            } else {
                document.querySelector('.messages-list').style.display = 'block';
                document.querySelector('.conversation-content').style.display = 'block';
            }
        }
    });
</script>