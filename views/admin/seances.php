<?php
$pageTitle = "Séances";
?>
<div class="admin-seances">
    <div class="admin-header">
        <h1>Séances</h1>
        <a href="index.php?page=admin&action=add-seance" class="btn btn-success">Ajouter une séance</a>
    </div>
    <?php if (empty($seances)): ?>
        <div class="no-data"><p>Aucune séance.</p></div>
    <?php
else: ?>
        <table class="seances-table">
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Salle</th>
                    <th>Date & Heure</th>
                    <th>Réservations</th>
                    <th>Capacité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($seances as $seance): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($seance['movie_name']); ?></td>
                        <td><?php echo htmlspecialchars($seance['room']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($seance['date'])); ?></td>
                        <td><span class="badge badge-info"><?php echo $seance['reservations_count']; ?>/50</span></td>
                        <td>
                            <div class="capacity-bar">
                                <div class="capacity-fill" style="width: <?php echo($seance['reservations_count'] / 50) * 100; ?>%"></div>
                            </div>
                        </td>
                        <td>
                            <a href="index.php?page=admin&action=delete-seance&id=<?php echo $seance['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette séance ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php
    endforeach; ?>
            </tbody>
        </table>
    <?php
endif; ?>
</div>
<style>
.admin-seances { padding: 20px; }
.admin-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; }
.admin-header h1 { margin: 0; }
.no-data { text-align: center; padding: 40px; color: #999; }
.seances-table { width: 100%; border-collapse: collapse; background: white; border-radius: 4px; overflow: hidden; }
.seances-table th, .seances-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
.seances-table thead { background: #f5f5f5; }
.badge { display: inline-block; padding: 4px 8px; border-radius: 3px; font-size: 12px; font-weight: bold; }
.badge-info { background: #d1ecf1; color: #0c5460; }
.capacity-bar { width: 100px; height: 12px; background: #e9ecef; border-radius: 6px; overflow: hidden; }
.capacity-fill { height: 100%; background: #28a745; transition: width 0.3s ease; }
.btn { padding: 8px 12px; border-radius: 4px; text-decoration: none; display: inline-block; font-size: 13px; }
.btn-success { background: #28a745; color: white; }
.btn-sm { padding: 6px 10px; font-size: 12px; }
.btn-danger { background: #dc3545; color: white; }
</style>
