<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user']) && !empty($_SESSION['user']);
$isAdmin = $isLoggedIn && isset($_SESSION['user']['isAdmin']) && $_SESSION['user']['isAdmin'] == 1;
$userName = $isLoggedIn ? htmlspecialchars($_SESSION['user']['name'] ?? '') : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Cinéma - Réservations') ?></title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <a href="/public/index.php?page=films" class="navbar-logo">
                    🎬 Cinéma Réservations
                </a>
            </div>

            <input type="checkbox" id="navbar-toggle" class="navbar-toggle-checkbox" />
            <label for="navbar-toggle" class="navbar-toggle-label">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <nav class="navbar-menu">
                <a href="/public/index.php?page=films" class="navbar-link">
                    Films
                </a>

                <?php if ($isAdmin): ?>
                    <a href="/public/index.php?page=admin" class="navbar-link navbar-link-primary">
                        ⚙️ Administration
                    </a>
                <?php endif; ?>

                <?php if ($isLoggedIn): ?>
                    <a href="/public/index.php?page=reservations" class="navbar-link">
                        Mes réservations
                    </a>
                <?php endif; ?>

                <div class="navbar-auth">
                    <?php if ($isLoggedIn): ?>
                        <div class="navbar-user-menu">
                            <span class="navbar-user-name">
                                👤 <?php echo $userName; ?>
                            </span>
                            <a href="/public/index.php?page=profile" class="navbar-link navbar-link-secondary">
                                Profil
                            </a>
                            <a href="/public/index.php?page=logout" class="navbar-link navbar-link-danger">
                                Déconnexion
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="/public/index.php?page=login" class="navbar-link navbar-link-secondary">
                            Connexion
                        </a>
                        <a href="/public/index.php?page=register" class="navbar-link navbar-link-primary">
                            Inscription
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <main class="container">
        <?php include __DIR__ . '/../components/alert.php'; ?>
