<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Inscription</h2>

<form method="POST" action="index.php?controller=auth&action=register">
    <label>Nom :</label>
    <input type="text" name="name" required>

    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Mot de passe :</label>
    <input type="password" name="password" required>

    <button type="submit">S'inscrire</button>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>