<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Connexion</h2>

<form method="POST" action="index.php?controller=auth&action=login">
    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Mot de passe :</label>
    <input type="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>