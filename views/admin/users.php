<?php
$pageTitle = "Utilisateurs";
?>
<div class="admin-users">
    <div class="admin-header">
        <h1>Utilisateurs</h1>
    </div>
    <table class="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <span class="role-badge <?php echo $user['isAdmin'] ? 'admin' : 'user'; ?>">
                            <?php echo $user['isAdmin'] ? 'Administrateur' : 'Utilisateur'; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                            <a href="index.php?page=admin&action=delete-user&id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a>
                        <?php
    else: ?>
                            <span class="text-muted">(Vous)</span>
                        <?php
    endif; ?>
                    </td>
                </tr>
            <?php
endforeach; ?>
        </tbody>
    </table>
</div>
<style>
.admin-users { padding: 20px; }
.admin-header { margin-bottom: 30px; }
.admin-header h1 { margin: 0; color: #333; }
.users-table { width: 100%; border-collapse: collapse; background: white; border-radius: 4px; overflow: hidden; }
.users-table th, .users-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
.users-table thead { background: #f5f5f5; }
.role-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
.role-badge.admin { background: #fff3cd; color: #856404; }
.role-badge.user { background: #d1ecf1; color: #0c5460; }
.btn { padding: 8px 12px; border-radius: 4px; text-decoration: none; display: inline-block; font-size: 13px; }
.btn-sm { padding: 6px 10px; font-size: 12px; }
.btn-danger { background: #dc3545; color: white; }
.text-muted { color: #999; }
</style>
