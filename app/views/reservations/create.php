<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Réserver une séance</h2>

<form method="POST" action="index.php?controller=reservation&action=store">
    <input type="hidden" name="seance_id" value="<?= htmlspecialchars($seance_id) ?>">

    <label>Nombre de places :</label>
    <input type="number" name="nombre_places" min="1" required>

    <button type="submit">Confirmer la réservation</button>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>