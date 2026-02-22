<?php
session_start();

require_once '../models/db.php';
require_once '../models/errorHandler.php';
require_once '../models/validation.php';
require_once '../models/movieDBMgr.php';
require_once '../models/screeningDBMgr.php';
require_once '../models/reservationDBMgr.php';
require_once '../models/userDBMgr.php';

require_once '../controllers/accountMgr.php';
require_once '../controllers/reservationMgr.php';
require_once '../controllers/filmMgr.php';

define('SESSION_TIMEOUT', 1800);

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
    session_destroy();
    setcookie('remember_token', '', time() - 3600, '/');
    header('Location: index.php?page=films');
    exit;
}
$_SESSION['last_activity'] = time();

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $userInfo = getUserByToken($_COOKIE['remember_token']);
    if ($userInfo) {
        $_SESSION['user_id'] = $userInfo['id'];
        $_SESSION['user'] = $userInfo;
        $_SESSION['last_activity'] = time();
    }
}

$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'films';
$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : null;
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

try {
    if (isset($_SESSION['user_id']) && !isset($_SESSION['user'])) {
        $userInfo = getUserFromToken($_SESSION['user_id']);
        if ($userInfo) {
            $_SESSION['user'] = $userInfo;
        }
    }

    switch ($page) {
        case 'logout':
            $_SESSION = array();
            if (isset($_COOKIE[session_name()])) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_destroy();
            setcookie('remember_token', '', time() - 3600, '/');
            header('Location: index.php?page=films');
            exit;

        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $loginInput = $_POST['login'] ?? '';
                $password = $_POST['password'] ?? '';
                $rememberMe = isset($_POST['remember_me']);
                $user = login($loginInput, $password, $rememberMe);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user;
                $_SESSION['last_activity'] = time();
                header('Location: index.php?page=films');
                exit;
            }
            break;

        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $passwordConfirm = $_POST['password_confirm'] ?? '';
                if ($password !== $passwordConfirm) {
                    throw new ValidationException("Les mots de passe ne correspondent pas.");
                }
                createAccount($username, $email, $password);
                $_SESSION['success'] = "Compte créé avec succès! Veuillez vous connecter.";
                header('Location: index.php?page=login');
                exit;
            }
            break;

        case 'profile':
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?page=login');
                exit;
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['update_profile'])) {
                    $name = $_POST['name'] ?? '';
                    $email = $_POST['email'] ?? '';
                    $password = $_POST['password'] ?? '';
                    $passwordConfirm = $_POST['password_confirm'] ?? '';
                    if (!empty($password) && $password !== $passwordConfirm) {
                        throw new ValidationException("Les mots de passe ne correspondent pas.");
                    }
                    updateProfile($_SESSION['user_id'], $name, $email, !empty($password) ? $password : null);
                    $_SESSION['user'] = getUserById($_SESSION['user_id']);
                    $_SESSION['success'] = "Profil mis à jour avec succès!";
                    header('Location: index.php?page=profile');
                    exit;
                }
                elseif (isset($_POST['delete_account'])) {
                    if (($_POST['confirm_delete'] ?? '') !== 'DELETE') {
                        throw new ValidationException('Veuillez taper "DELETE" pour confirmer la suppression.');
                    }
                    deleteAccount($_SESSION['user_id']);
                    session_destroy();
                    setcookie('remember_token', '', time() - 3600, '/');
                    $_SESSION['success'] = "Compte supprimé avec succès.";
                    header('Location: index.php?page=films');
                    exit;
                }
            }
            break;

        case 'reservations':
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?page=login');
                exit;
            }
            if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                createReservation($_POST['screening_id'] ?? '', $_SESSION['user_id'], $_POST['seat'] ?? '');
                header('Location: index.php?page=reservations');
                exit;
            }
            break;

        case 'admin':
            if (!isset($_SESSION['user']) || !$_SESSION['user']['isAdmin']) {
                throw new AuthorizationException("Accès refusé.");
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($action === 'add-film') {
                    createFilm($_POST['name'] ?? '', $_POST['synopsis'] ?? '', $_POST['cover_url'] ?? '');
                    $_SESSION['success'] = "Film ajouté avec succès!";
                    header('Location: index.php?page=admin&action=films');
                    exit;
                }
                elseif ($action === 'edit-film' && $id) {
                    updateFilm($id, $_POST['name'] ?? '', $_POST['synopsis'] ?? '', $_POST['cover_url'] ?? '');
                    $_SESSION['success'] = "Film modifié avec succès!";
                    header('Location: index.php?page=admin&action=films');
                    exit;
                }
                elseif ($action === 'add-seance') {
                    createSeance($_POST['movie_id'] ?? '', $_POST['date'] ?? '', $_POST['room'] ?? '');
                    $_SESSION['success'] = "Séance ajoutée avec succès!";
                    header('Location: index.php?page=admin&action=seances');
                    exit;
                }
            }
            if ($action === 'delete-film' && $id) {
                deleteFilm($id);
                $_SESSION['success'] = "Film supprimé avec succès!";
                header('Location: index.php?page=admin&action=films');
                exit;
            }
            elseif ($action === 'delete-seance' && $id) {
                deleteSeance($id);
                $_SESSION['success'] = "Séance supprimée avec succès!";
                header('Location: index.php?page=admin&action=seances');
                exit;
            }
            elseif ($action === 'delete-user' && $id) {
                if ($id == $_SESSION['user_id']) {
                    throw new ValidationException("Vous ne pouvez pas supprimer votre propre compte.");
                }
                deleteUser($id);
                $_SESSION['success'] = "Utilisateur supprimé avec succès!";
                header('Location: index.php?page=admin&action=users');
                exit;
            }
            elseif ($action === 'delete-reservation' && $id) {
                deleteReservation($id);
                $_SESSION['success'] = "Réservation supprimée avec succès!";
                header('Location: index.php?page=admin&action=reservations');
                exit;
            }
            break;
    }

    include '../views/layout/header.php';

    switch ($page) {
        case 'login':
            include '../views/auth/login.php';
            break;
        case 'films':
            $films = listFilms();
            include '../views/films/list.php';
            break;
        case 'film-details':
            if (!$id) {
                header('Location: index.php?page=films');
                exit;
            }
            $film = getFilmDetails($id);
            $seances = getFilmScreenings($id);
            if (!$film) {
                throw new Exception("Film non trouvé.");
            }
            include '../views/films/seances.php';
            break;
        case 'reservations':
            if ($action === 'create') {
                $screening_id = isset($_GET['screening_id']) ? htmlspecialchars($_GET['screening_id']) : null;
                if (!$screening_id) {
                    throw new ValidationException("Screening ID manquant.");
                }
                include '../views/reservations/create.php';
            }
            else {
                $reservations = getReservationsByUser($_SESSION['user_id']);
                include '../views/reservations/my_reservations.php';
            }
            break;
        case 'admin':
            if (!$action) {
                $statsData = ['films' => count(getAllMovies()), 'users' => count(getAllUsers()), 'reservations' => count(getAllReservations())];
                include '../views/admin/dashboard.php';
            }
            elseif ($action === 'films') {
                $films = listFilms();
                include '../views/admin/films.php';
            }
            elseif ($action === 'add-film' || ($action === 'edit-film' && $id)) {
                if ($action === 'edit-film') {
                    $film = getFilmDetails($id);
                    if (!$film)
                        throw new NotFoundException("Film non trouvé.");
                }
                include '../views/admin/film-form.php';
            }
            elseif ($action === 'seances') {
                $seances = getAllScreenings();
                include '../views/admin/seances.php';
            }
            elseif ($action === 'add-seance') {
                $films = listFilms();
                include '../views/admin/seance-form.php';
            }
            elseif ($action === 'users') {
                $users = getAllUsers();
                include '../views/admin/users.php';
            }
            elseif ($action === 'reservations') {
                $reservations = getAllReservations();
                include '../views/admin/reservations.php';
            }
            break;
        case 'register':
            include '../views/auth/register.php';
            break;
        case 'profile':
            include '../views/auth/profile.php';
            break;
        default:
            header('Location: index.php?page=films');
            exit;
    }
}
catch (Exception $e) {
    handleException($e);
}

include '../views/layout/footer.php';
