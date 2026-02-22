<div class="reservation-form-container">
    <div class="reservation-form-card">
        <h2>Réserver une séance</h2>
        <p class="form-subtitle">Complétez votre réservation</p>

        <form method="POST" action="/public/index.php?page=reservations&action=create" class="reservation-form">
            <input type="hidden" name="screening_id" value="<?= htmlspecialchars($screening_id) ?>">

            <div class="form-group">
                <label for="seat">Numéro de siège :</label>
                <input type="number" id="seat" name="seat" min="1" max="50" value="1" class="form-input" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">✓ Confirmer la réservation</button>
                <a href="index.php?page=films" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
</div>