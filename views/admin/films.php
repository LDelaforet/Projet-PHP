<?php
$pageTitle = "Films";
?>
<div class="admin-films">
    <div class="admin-header">
        <h1>Films</h1>
        <a href="index.php?page=admin&action=add-film" class="btn btn-success">Ajouter un film</a>
    </div>
    <table class="films-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Synopsis</th>
                <th>Couverture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($films as $film): ?>
                <tr>
                    <td><?php echo htmlspecialchars($film['name']); ?></td>
                    <td class="synopsis"><?php echo htmlspecialchars(substr($film['synopsis'], 0, 50)) . '...'; ?></td>
                    <td><img src="<?php echo htmlspecialchars($film['cover_url']); ?>" alt="Cover" class="film-thumbnail"></td>
                    <td>
                        <a href="index.php?page=admin&action=edit-film&id=<?php echo $film['id']; ?>" class="btn btn-sm btn-primary">Modifier</a>
                        <a href="index.php?page=admin&action=delete-film&id=<?php echo $film['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce film ?');">Supprimer</a>
                    </td>
                </tr>
            <?php
endforeach; ?>
        </tbody>
    </table>
</div>
<style>
.admin-films { padding: 20px; }
.admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
.admin-header h1 { margin: 0; }
.films-table { width: 100%; border-collapse: collapse; background: white; }
.films-table th, .films-table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
.films-table th { background-color: #f5f5f5; }
.synopsis { max-width: 200px; text-overflow: ellipsis; overflow: hidden; }
.film-thumbnail { width: 50px; height: 75px; object-fit: cover; border-radius: 4px; }
.btn { padding: 8px 12px; border-radius: 4px; text-decoration: none; display: inline-block; font-size: 13px; }
.btn-sm { padding: 6px 10px; font-size: 12px; }
.btn-success { background: #28a745; color: white; }
.btn-primary { background: #007bff; color: white; }
.btn-danger { background: #dc3545; color: white; }
</style>
