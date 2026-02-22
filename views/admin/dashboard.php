<?php
$pageTitle = "Administration";
$statsData = isset($statsData) ? $statsData : ['films' => 0, 'users' => 0, 'reservations' => 0];
?>

<div class="admin-dashboard">
    <div class="dashboard-header">
        <h1>Panel d'Administration</h1>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">🎥</div>
            <div class="stat-content">
                <h3>Films</h3>
                <p class="stat-number"><?php echo $statsData['films']; ?></p>
                <a href="index.php?page=admin&action=films">Voir les films</a>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>Utilisateurs</h3>
                <p class="stat-number"><?php echo $statsData['users']; ?></p>
                <a href="index.php?page=admin&action=users">Gérer les utilisateurs</a>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🎟️</div>
            <div class="stat-content">
                <h3>Réservations</h3>
                <p class="stat-number"><?php echo $statsData['reservations']; ?></p>
                <a href="index.php?page=admin&action=reservations">Voir les réservations</a>
            </div>
        </div>
    </div>

    <div class="admin-menu">
        <section class="admin-card">
            <h3>Films et Séances</h3>
            <div class="card-actions">
                <a href="index.php?page=admin&action=films" class="btn btn-primary">Gérer les films</a>
                <a href="index.php?page=admin&action=seances" class="btn btn-secondary">Voir les séances</a>
                <a href="index.php?page=admin&action=add-seance" class="btn btn-success">Ajouter une séance</a>
            </div>
        </section>
        <section class="admin-card">
            <h3>Utilisateurs</h3>
            <div class="card-actions">
                <a href="index.php?page=admin&action=users" class="btn btn-primary">Gérer les utilisateurs</a>
            </div>
        </section>
        <section class="admin-card">
            <h3>Réservations</h3>
            <div class="card-actions">
                <a href="index.php?page=admin&action=reservations" class="btn btn-primary">Voir les réservations</a>
            </div>
        </section>
    </div>
</div>

<style>
.admin-dashboard { padding: 20px; max-width: 1200px; margin: 0 auto; }
.dashboard-header { margin-bottom: 40px; text-align: center; }
.dashboard-header h1 { margin: 0; color: #333; font-size: 2.5em; }
.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
.stat-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px; padding: 20px; display: flex; align-items: center; gap: 20px; }
.stat-card:nth-child(2) { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.stat-card:nth-child(3) { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
.stat-icon { font-size: 3em; min-width: 80px; text-align: center; }
.stat-content h3 { margin: 0 0 10px 0; font-size: 1.2em; }
.stat-number { margin: 0 0 10px 0; font-size: 2.5em; font-weight: bold; }
.stat-card a { color: white; text-decoration: none; font-weight: bold; }
.admin-menu { margin-top: 40px; }
.admin-card { background: white; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
.admin-card h3 { margin: 0 0 15px 0; color: #333; }
.card-actions { display: flex; gap: 10px; flex-wrap: wrap; }
.btn { padding: 10px 15px; border-radius: 4px; text-decoration: none; font-size: 14px; transition: all 0.3s ease; }
.btn-primary { background: #667eea; color: white; }
.btn-secondary { background: #6c757d; color: white; }
.btn-success { background: #28a745; color: white; }
</style>
