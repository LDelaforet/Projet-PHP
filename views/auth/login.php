<div class="auth-container">
    <div class="auth-card">
        <h2>Connexion</h2>
        <p class="auth-subtitle">Connectez-vous à votre compte</p>

        <form method="POST" action="../../public/index.php?page=login" class="auth-form">
            <div class="form-group">
                <label for="login">Email ou nom d'utilisateur :</label>
                <input type="text" id="login" name="login" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <div class="form-group checkbox">
                <label for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    Se souvenir de moi
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>

        <p class="auth-link">Pas encore de compte ? <a href="index.php?page=register">S'inscrire</a></p>
    </div>
</div>