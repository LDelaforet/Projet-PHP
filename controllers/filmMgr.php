<?php
require_once __DIR__ . '/../models/movieDBMgr.php';
require_once __DIR__ . '/../models/screeningDBMgr.php';

function listFilms()
{
    return getAllMovies();
}

function getFilmScreenings($filmId)
{
    if (!is_numeric($filmId) || $filmId <= 0) {
        throw new ValidationException("ID de film invalide.");
    }
    return getScreeningsByMovie($filmId);
}

function getFilmDetails($filmId)
{
    if (!is_numeric($filmId) || $filmId <= 0) {
        throw new ValidationException("ID de film invalide.");
    }
    $films = getAllMovies();
    foreach ($films as $film) {
        if ($film['id'] == $filmId) {
            return $film;
        }
    }
    return null;
}

function createFilm($name, $synopsis, $coverUrl)
{
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['isAdmin']) || $_SESSION['user']['isAdmin'] != 1) {
        throw new ValidationException("Accès non autorisé.");
    }
    if (empty($name))
        throw new ValidationException("Le titre du film est requis.");
    if (empty($synopsis))
        throw new ValidationException("Le synopsis est requis.");
    if (empty($coverUrl))
        throw new ValidationException("L'URL de la couverture est requise.");
    addMovie($name, $synopsis, $coverUrl);
}

function updateFilm($filmId, $name, $synopsis, $coverUrl)
{
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['isAdmin']) || $_SESSION['user']['isAdmin'] != 1) {
        throw new ValidationException("Accès non autorisé.");
    }
    if (!is_numeric($filmId) || $filmId <= 0)
        throw new ValidationException("ID de film invalide.");
    if (empty($name))
        throw new ValidationException("Le titre du film est requis.");
    if (empty($synopsis))
        throw new ValidationException("Le synopsis est requis.");
    if (empty($coverUrl))
        throw new ValidationException("L'URL de la couverture est requise.");
    updateMovie($filmId, $name, $synopsis, $coverUrl);
}

function deleteFilm($filmId)
{
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['isAdmin']) || $_SESSION['user']['isAdmin'] != 1) {
        throw new ValidationException("Accès non autorisé.");
    }
    if (!is_numeric($filmId) || $filmId <= 0)
        throw new ValidationException("ID de film invalide.");
    if (isMovieHaveScreenings($filmId))
        throw new ValidationException("Impossible de supprimer ce film. Il a des séances planifiées.");
    deleteMovie($filmId);
}

function createSeance($movieId, $date, $room)
{
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['isAdmin']) || $_SESSION['user']['isAdmin'] != 1) {
        throw new ValidationException("Accès non autorisé.");
    }
    if (!is_numeric($movieId) || $movieId <= 0)
        throw new ValidationException("ID de film invalide.");
    if (empty($date))
        throw new ValidationException("La date est requise.");
    if (empty($room))
        throw new ValidationException("La salle est requise.");
    if (!getMovieById($movieId))
        throw new ValidationException("Film non trouvé.");
    addScreening($movieId, $date, $room);
}

function deleteSeance($screeningId)
{
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['isAdmin']) || $_SESSION['user']['isAdmin'] != 1) {
        throw new ValidationException("Accès non autorisé.");
    }
    if (!is_numeric($screeningId) || $screeningId <= 0)
        throw new ValidationException("ID de séance invalide.");
    if (isScreeningHasReservations($screeningId))
        throw new ValidationException("Impossible de supprimer cette séance. Elle a des réservations.");
    deleteScreening($screeningId);
}
