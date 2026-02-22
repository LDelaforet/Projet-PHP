<?php
$pageTitle = "Réservations";
?>
<div class="admin-reservations">
    <div class="admin-header">
        <h1>Réservations</h1>
    </div>
    <?php if (empty($reservations)): ?>
        <div class="no-data"><p>Aucune réservation.</p></div>
    <?php
else: ?>
        <table class="reservations-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Film</th>
                    <th>Utilisateur</th>
                    <th>Siège</th>
                    <th>Salle</th>
                    <th>Date & Heure</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reservation['id']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($reservation['user_name']); ?></strong><br>
                            <small><?php echo htmlspecialchars($reservation['email']); ?></small>
                        </td>
                        <td><?php echo htmlspecialchars($reservation['seat']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['room']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($reservation['date'])); ?></td>
                        <td>
                            <a href="index.php?page=admin&action=delete-reservation&id=<?php echo $reservation['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Annuler cette réservation ?');">Annuler</a>
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
.admin-reservations { padding: 20px; }
.admin-header { margin-bottom: 30px; }
.admin-header h1 { margin: 0; color: #333; }
.no-data { text-align: center; padding: 40px; color: #999; }
.reservations-table { width: 100%; border-collapse: collapse; background: white; border-radius: 4px; overflow: hidden; }
.reservations-table th, .reservations-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
.reservations-table thead { background: #f5f5f5; }
.btn { padding: 8px 12px; border-radius: 4px; text-decoration: none; display: inline-block; font-size: 13px; }
.btn-sm { padding: 6px 10px; font-size: 12px; }
.btn-danger { background: #dc3545; color: white; }
small { display: block; color: #999; }
</style>
