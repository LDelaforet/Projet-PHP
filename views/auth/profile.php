<div class="profile-container">
    <?php if (!isset($_SESSION['user'])): ?>
        <div class="auth-container">
            <div class="auth-card">
                <p>Vous devez être connecté pour accéder à cette page.</p>
                <a href="index.php?page=login" class="btn btn-primary">Se connecter</a>
            </div>
        </div>
    <?php else: ?>
        <div class="profile-card">
            <h2 class="page-title">👤 Mon profil</h2>

            <section class="profile-section">
                <h3>📋 Informations personnelles</h3>
                <div class="profile-info">
                    <p><strong>👤 Nom :</strong> <span><?= htmlspecialchars($_SESSION['user']['name'] ?? $_SESSION['user']['username'] ?? 'N/A') ?></span></p>
                    <p><strong>📧 Email :</strong> <span><?= htmlspecialchars($_SESSION['user']['email'] ?? 'N/A') ?></span></p>
                    <p><strong>🔐 Rôle :</strong> <span><?= htmlspecialchars($_SESSION['user']['isAdmin'] ? 'Administrateur' : 'Utilisateur') ?></span></p>
                </div>
            </section>

            <section class="profile-section">
                <h3>✏️ Modifier mon profil</h3>
                <form method="POST" action="/public/index.php?page=profile" class="profile-form">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['user']['name'] ?? $_SESSION['user']['username'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
                        <input type="password" id="password" name="password" placeholder="Entrez un nouveau mot de passe">
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirmez le mot de passe :</label>
                        <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmez le mot de passe">
                    </div>

                    <button type="submit" name="update_profile" class="btn btn-primary">💾 Enregistrer les modifications</button>
                </form>
            </section>

            <section class="profile-section danger-zone">
                <h3>⚠️ Zone de danger</h3>
                <p class="danger-warning">Attention: Cette action est irréversible. Elle supprimera votre compte et toutes vos réservations.</p>
                
                <form method="POST" action="/public/index.php?page=profile" class="delete-form" id="deleteForm" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer votre compte? Cette action est irréversible.');">
                    <div class="form-group">
                        <label for="confirm_delete">Tapez <strong>DELETE</strong> pour confirmer la suppression :</label>
                        <input type="text" id="confirm_delete" name="confirm_delete" placeholder="DELETE" required>
                    </div>
                    
                    <button type="submit" name="delete_account" class="btn btn-danger">🗑️ Supprimer mon compte</button>
                </form>
            </section>

            <div class="profile-actions">
                <a href="/public/index.php?page=reservations" class="btn btn-secondary">📅 Mes réservations</a>
                <a href="/public/index.php?page=logout" class="btn btn-danger">🚪 Déconnexion</a>
            </div>
        </div>
    <?php endif; ?>
</div>