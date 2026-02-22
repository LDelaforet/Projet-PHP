<div class="auth-container">
    <div class="auth-card">
        <h2>Inscription</h2>
        <form method="POST" action="/public/index.php?page=register" class="auth-form">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-input" required minlength="8">
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirmation :</label>
                <input type="password" id="password_confirm" name="password_confirm" class="form-input" required minlength="8">
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
        <p class="auth-link">Déjà un compte ? <a href="index.php?page=login">Se connecter</a></p>
    </div>
</div>