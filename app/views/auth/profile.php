<?php require __DIR__ . '/../layout/header.php'; ?>

<?php if (!isset($_SESSION['user'])): ?>
    <p>Vous devez être connecté pour accéder à cette page.</p>
    <a href="index.php?controller=auth&action=login">Se connecter</a>
<?php else: ?>

<h2>Mon profil</h2>

<?php if (!empty($success)): ?>
    <p style="color: green;">
        <?= htmlspecialchars($success) ?>
    </p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color: red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<section>
    <h3>Informations personnelles</h3>

    <p><strong>Nom :</strong> <?= htmlspecialchars($_SESSION['user']['name']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
    <p><strong>Rôle :</strong> <?= htmlspecialchars($_SESSION['user']['role']) ?></p>
</section>

<hr>

<section>
    <h3>Modifier mes informations</h3>

    <form method="POST" action="index.php?controller=auth&action=updateProfile">
        <label>Nouveau nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['user']['name']) ?>" required>

        <label>Nouvel email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</section>

<hr>

<section>
    <h3>Changer mon mot de passe</h3>

    <form method="POST" action="index.php?controller=auth&action=updatePassword">
        <label>Mot de passe actuel :</label>
        <input type="password" name="current_password" required>

        <label>Nouveau mot de passe :</label>
        <input type="password" name="new_password" required>

        <button type="submit">Changer le mot de passe</button>
    </form>
</section>

<hr>

<section>
    <h3>Supprimer mon compte</h3>

    <form method="POST" action="index.php?controller=auth&action=deleteAccount"
          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
        <button type="submit" style="color: red;">
            Supprimer mon compte
        </button>
    </form>
</section>

<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>