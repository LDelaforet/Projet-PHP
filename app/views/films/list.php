<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Films à l'affiche</h2>

<?php if (!empty($films)): ?>
    <ul>
        <?php foreach ($films as $film): ?>
            <li>
                <h3><?= htmlspecialchars($film['titre']) ?></h3>
                <p><?= htmlspecialchars($film['description']) ?></p>
                <a href="index.php?controller=film&action=show&id=<?= htmlspecialchars($film['id']) ?>">
                    Voir les séances
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun film disponible.</p>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>