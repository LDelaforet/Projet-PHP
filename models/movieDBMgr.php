<?php
require_once __DIR__ . '/db.php';
function addMovie($name, $synopsis, $coverUrl)
{
    global $pdo;
    $pdo->prepare("INSERT INTO movies (name, synopsis, cover_url) VALUES (?, ?, ?)")->execute([$name, $synopsis, $coverUrl]);
}
function getAllMovies()
{
    global $pdo;
    return $pdo->query("SELECT * FROM movies")->fetchAll(PDO::FETCH_ASSOC);
}
function getMovieById($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function isMovieHaveScreenings($movieId)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM screenings WHERE movieId = ?");
    $stmt->execute([$movieId]);
    return $stmt->fetchColumn() > 0;
}
function deleteMovie($id)
{
    global $pdo;
    return $pdo->prepare("DELETE FROM movies WHERE id = ?")->execute([$id]);
}
function updateMovie($id, $name, $synopsis, $coverUrl)
{
    global $pdo;
    return $pdo->prepare("UPDATE movies SET name = ?, synopsis = ?, cover_url = ? WHERE id = ?")->execute([$name, $synopsis, $coverUrl, $id]);
}