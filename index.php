<?php
session_start();

require_once 'models/db.php';
require_once 'models/errorHandler.php';
require_once 'models/validation.php';
require_once 'models/movieDBMgr.php';
require_once 'models/screeningDBMgr.php';
require_once 'models/reservationDBMgr.php';
require_once 'models/userDBMgr.php';

require_once 'controllers/accountMgr.php';
require_once 'controllers/reservationMgr.php';
require_once 'controllers/filmMgr.php';

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
            header('Location: index.php?page=films');
            exit;

        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $user = login($email, $password);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user;
                header('Location: index.php?page=films');
                exit;
            }
            break;

        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                createAccount($_POST['username'] ?? '', $_POST['email'] ?? '', $_POST['password'] ?? '');
                header('Location: index.php?page=login');
                exit;
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
            if (!isset($_SESSION['user_id']) || !isset($_SESSION['user']['isAdmin']) || $_SESSION['user']['isAdmin'] != 1) {
                throw new Exception("Accès non autorisé.");
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($action === 'add-film') {
                    createFilm($_POST['name'] ?? '', $_POST['synopsis'] ?? '', $_POST['cover_url'] ?? '');
                    header('Location: index.php?page=admin&action=films');
                    exit;
                }
                elseif ($action === 'edit-film' && $id) {
                    updateFilm($id, $_POST['name'] ?? '', $_POST['synopsis'] ?? '', $_POST['cover_url'] ?? '');
                    header('Location: index.php?page=admin&action=films');
                    exit;
                }
                elseif ($action === 'add-seance') {
                    createSeance($_POST['movie_id'] ?? '', $_POST['date'] ?? '', $_POST['room'] ?? '');
                    header('Location: index.php?page=admin');
                    exit;
                }
            }
            if ($action === 'delete-film' && $id) {
                deleteFilm($id);
                header('Location: index.php?page=admin&action=films');
                exit;
            }
            break;
    }

    include 'views/layout/header.php';

    switch ($page) {
        case 'login':
            include 'views/auth/login.php';
            break;
        case 'register':
            include 'views/auth/register.php';
            break;
        case 'profile':
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?page=login');
                exit;
            }
            include 'views/auth/profile.php';
            break;
        case 'films':
            $films = listFilms();
            include 'views/films/list.php';
            break;
        case 'film-details':
            if (!$id) {
                header('Location: index.php?page=films');
                exit;
            }
            $film = getFilmDetails($id);
            $seances = getFilmScreenings($id);
            if (!$film)
                throw new Exception("Film non trouvé.");
            include 'views/films/seances.php';
            break;
        case 'reservations':
            if ($action === 'create') {
                if (!$id) {
                    header('Location: index.php?page=films');
                    exit;
                }
                $screening_id = $id;
                include 'views/reservations/create.php';
            }
            else {
                $reservations = getReservationsByUser($_SESSION['user_id']);
                include 'views/reservations/my_reservations.php';
            }
            break;
        case 'admin':
            if ($action === 'films') {
                $films = listFilms();
                include 'views/admin/films.php';
            }
            elseif ($action === 'add-film' || ($action === 'edit-film' && $id)) {
                if ($action === 'edit-film') {
                    $film = getFilmDetails($id);
                    if (!$film)
                        throw new Exception("Film non trouvé.");
                }
                include 'views/admin/film-form.php';
            }
            elseif ($action === 'add-seance') {
                $films = listFilms();
                include 'views/admin/seance-form.php';
            }
            else {
                include 'views/admin/dashboard.php';
            }
            break;
        default:
            header('Location: index.php?page=films');
            exit;
    }
}
catch (Exception $e) {
    handleException($e);
}

include 'views/layout/footer.php';
