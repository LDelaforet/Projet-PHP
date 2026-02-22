<div class="reservations-container">
    <h2 class="page-title">Mes réservations</h2>

    <?php if (!empty($reservations)): ?>
        <div class="reservations-list">
            <?php foreach ($reservations as $reservation): ?>
                <div class="reservation-card">
                    <div class="reservation-header">
                        <h3 class="reservation-title">🎬 <?= htmlspecialchars($reservation['name']) ?></h3>
                    </div>
                    <div class="reservation-details">
                        <p><strong>📅 Date :</strong> <?= htmlspecialchars($reservation['date']) ?></p>
                        <p><strong>🎭 Salle :</strong> <?= htmlspecialchars($reservation['room']) ?></p>
                        <p><strong>🎫 Siège :</strong> <?= htmlspecialchars($reservation['seat']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>Vous n'avez aucune réservation pour le moment.</p>
            <a href="index.php?page=films" class="btn btn-primary">Réserver un film</a>
        </div>
    <?php endif; ?>
</div>