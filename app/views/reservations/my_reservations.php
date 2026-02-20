<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Mes réservations</h2>

<?php if (!empty($reservations)): ?>
    <ul>
        <?php foreach ($reservations as $reservation): ?>
            <li>
                Film : <?= htmlspecialchars($reservation['titre']) ?><br>
                Date : <?= htmlspecialchars($reservation['date']) ?><br>
                Heure : <?= htmlspecialchars($reservation['heure']) ?><br>
                Places : <?= htmlspecialchars($reservation['nombre_places']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune réservation trouvée.</p>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>