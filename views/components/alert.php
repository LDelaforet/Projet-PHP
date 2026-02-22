<?php
// Afficher les messages d'erreur
if (isset($_SESSION['error']) && !empty($_SESSION['error'])):
    $errorMessage = $_SESSION['error']['message'];
    $errorType = $_SESSION['error']['type'] ?? 'error';
    unset($_SESSION['error']);
?>
    <div class="alert alert-danger" role="alert">
        <div class="alert-close" onclick="this.parentElement.style.display='none';">&times;</div>
        <strong>Erreur !</strong> <?= htmlspecialchars($errorMessage) ?>
    </div>
<?php endif; ?>

<?php
// Afficher les messages de succès
if (isset($_SESSION['success']) && !empty($_SESSION['success'])):
    $successMessage = $_SESSION['success'];
    unset($_SESSION['success']);
?>
    <div class="alert alert-success" role="alert">
        <div class="alert-close" onclick="this.parentElement.style.display='none';">&times;</div>
        <strong>Succès !</strong> <?= htmlspecialchars($successMessage) ?>
    </div>
<?php endif; ?>

<style>
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    animation: slideIn 0.3s ease-in-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeaa7;
}

.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}

.alert-close {
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
    color: inherit;
    opacity: 0.5;
    transition: opacity 0.2s;
}

.alert-close:hover {
    opacity: 1;
}
</style>
