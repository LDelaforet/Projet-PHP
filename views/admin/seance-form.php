<?php
$pageTitle = "Ajouter une Séance";
?>
<div class="admin-seance-form">
    <div class="form-header">
        <a href="index.php?page=admin&action=seances" class="btn btn-secondary">← Retour</a>
        <h1>Ajouter une séance</h1>
    </div>
    <form method="POST" class="form">
        <div class="form-group">
            <label for="movie_id">Film *</label>
            <select id="movie_id" name="movie_id" required>
                <option value="">-- Choisir un film --</option>
                <?php foreach ($films as $film): ?>
                    <option value="<?php echo $film['id']; ?>"><?php echo htmlspecialchars($film['name']); ?></option>
                <?php
endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date et heure *</label>
            <input type="datetime-local" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="room">Salle *</label>
            <input type="text" id="room" name="room" required placeholder="Ex: Salle 1">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Ajouter</button>
            <a href="index.php?page=admin&action=seances" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
<style>
.admin-seance-form { padding: 20px; max-width: 600px; margin: 0 auto; }
.form-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
.form-header h1 { margin: 0; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
.form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
.form-actions { display: flex; gap: 10px; margin-top: 30px; }
.btn { padding: 10px 20px; border-radius: 4px; text-decoration: none; cursor: pointer; }
.btn-success { background: #28a745; color: white; border: none; }
.btn-secondary { background: #6c757d; color: white; }
</style>
