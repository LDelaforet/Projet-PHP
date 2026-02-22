<div class="films-container">
    <h2 class="page-title">Films à l'affiche</h2>

    <?php if (!empty($films)): ?>
        <div class="films-grid">
            <?php foreach ($films as $film): ?>
                <div class="film-card">
                    <div class="film-header">
                        <h3 class="film-title"><?= htmlspecialchars($film['name']) ?></h3>
                    </div>
                    <div class="film-body">
                        <p class="film-description"><?= htmlspecialchars($film['synopsis']) ?></p>
                    </div>
                    <div class="film-footer">
                        <a href="index.php?page=film-details&id=<?= htmlspecialchars($film['id']) ?>" class="btn btn-secondary">
                            Voir les séances →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>Aucun film disponible pour le moment.</p>
        </div>
    <?php endif; ?>
</div>