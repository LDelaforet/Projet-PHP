<?php
$pageTitle = "Film";
$film = isset($film) ? $film : null;
$isEdit = $film !== null;
?>
<div class="admin-film-form">
    <div class="form-header">
        <a href="index.php?page=admin&action=films" class="btn btn-secondary">← Retour</a>
        <h1><?php echo $isEdit ? 'Modifier le film' : 'Ajouter un film'; ?></h1>
    </div>
    <form method="POST" class="form">
        <div class="form-group">
            <label for="name">Titre *</label>
            <input type="text" id="name" name="name" required value="<?php echo $isEdit ? htmlspecialchars($film['name']) : ''; ?>">
        </div>
        <div class="form-group">
            <label for="synopsis">Synopsis *</label>
            <textarea id="synopsis" name="synopsis" required rows="5"><?php echo $isEdit ? htmlspecialchars($film['synopsis']) : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="cover_url">URL image *</label>
            <input type="url" id="cover_url" name="cover_url" required value="<?php echo $isEdit ? htmlspecialchars($film['cover_url']) : ''; ?>">
            <?php if ($isEdit): ?>
                <div class="cover-preview"><img src="<?php echo htmlspecialchars($film['cover_url']); ?>" alt="Preview"></div>
            <?php
endif; ?>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"><?php echo $isEdit ? 'Mettre à jour' : 'Ajouter'; ?></button>
            <a href="index.php?page=admin&action=films" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
<style>
.admin-film-form { padding: 20px; max-width: 600px; margin: 0 auto; }
.form-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
.form-header h1 { margin: 0; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
.form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
.cover-preview { margin-top: 10px; max-width: 150px; }
.cover-preview img { max-width: 100%; border-radius: 4px; }
.form-actions { display: flex; gap: 10px; margin-top: 30px; }
.btn { padding: 10px 20px; border-radius: 4px; text-decoration: none; cursor: pointer; }
.btn-success { background: #28a745; color: white; border: none; }
.btn-secondary { background: #6c757d; color: white; }
</style>
