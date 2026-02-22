<div class="seances-container">
    <div class="seances-header">
        <a href="/public/index.php?page=films" class="btn btn-outline">← Retour aux films</a>
        <h2 class="page-title">Séances - <?= htmlspecialchars($film['name']) ?></h2>
    </div>

    <?php if (!empty($seances)): ?>
        <div class="seances-list">
            <?php foreach ($seances as $seance): ?>
                <div class="seance-card">
                    <div class="seance-info">
                        <span class="seance-date">📅 <?= htmlspecialchars($seance['date']) ?></span>
                        <span class="seance-room">🎭 Salle: <?= htmlspecialchars($seance['room']) ?></span>
                    </div>
                    <div class="seance-action">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="/public/index.php?page=reservations&action=create&screening_id=<?= htmlspecialchars($seance['id']) ?>" class="btn btn-primary">
                                Réserver une place
                            </a>
                        <?php else: ?>
                            <a href="/public/index.php?page=login" class="btn btn-secondary">
                                Connectez-vous pour réserver
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>Aucune séance disponible pour ce film.</p>
        </div>
    <?php endif; ?>
</div>