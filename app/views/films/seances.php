<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Séances - <?= htmlspecialchars($film['titre']) ?></h2>

<?php if (!empty($seances)): ?>
    <ul>
        <?php foreach ($seances as $seance): ?>
            <li>
                <?= htmlspecialchars($seance['date']) ?> à 
                <?= htmlspecialchars($seance['heure']) ?>

                <?php if (isset($_SESSION['user'])): ?>
                    <a href="index.php?controller=reservation&action=create&id=<?= htmlspecialchars($seance['id']) ?>">
                        Réserver
                    </a>
                <?php else: ?>
                    <span>Connectez-vous pour réserver</span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune séance disponible.</p>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>