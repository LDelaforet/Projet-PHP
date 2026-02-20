<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user']) && !empty($_SESSION['user']);
$isAdmin = $isLoggedIn && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
$userName = $isLoggedIn ? htmlspecialchars($_SESSION['user']['name'] ?? '') : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Cinéma - Réservations') ?></title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/assets/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php" class="navbar-logo">
                    Cinéma Réservations
                </a>
            </div>

            <input type="checkbox" id="navbar-toggle" class="navbar-toggle-checkbox" />
            <label for="navbar-toggle" class="navbar-toggle-label">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <nav class="navbar-menu">
                <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=film&action=index" class="navbar-link">
                    Films
                </a>

                <?php if ($isLoggedIn): ?>
                    <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=reservation&action=myReservations" class="navbar-link">
                        Mes réservations
                    </a>
                <?php endif; ?>

                <?php if ($isAdmin): ?>
                    <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=admin&action=dashboard" class="navbar-link navbar-link-admin">
                        Administration
                    </a>
                <?php endif; ?>

                <div class="navbar-auth">
                    <?php if ($isLoggedIn): ?>
                        <div class="navbar-user-menu">
                            <span class="navbar-user-name">
                                <?php echo $userName; ?>
                            </span>
                            <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=auth&action=profile" class="navbar-link navbar-link-secondary">
                                Profil
                            </a>
                            <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=auth&action=logout" class="navbar-link navbar-link-danger">
                                Déconnexion
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=auth&action=login" class="navbar-link navbar-link-secondary">
                            Connexion
                        </a>
                        <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=auth&action=register" class="navbar-link navbar-link-primary">
                            Inscription
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <main class="container">
