<?php
require_once __DIR__ . '/db.php';
function addScreening($movieId, $date, $room)
{
    global $pdo;
    $pdo->prepare("INSERT INTO screenings (movieId, date, room) VALUES (?, ?, ?)")->execute([$movieId, $date, $room]);
}
function getScreeningsByMovie($movieId)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM screenings WHERE movieId = ?");
    $stmt->execute([$movieId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getScreeningById($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM screenings WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function deleteScreening($id)
{
    global $pdo;
    return $pdo->prepare("DELETE FROM screenings WHERE id = ?")->execute([$id]);
}
function isScreeningHasReservations($screeningId)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE screeningId = ?");
    $stmt->execute([$screeningId]);
    return $stmt->fetchColumn() > 0;
}
function isScreeningFull($screeningId, $totalSeats = 50)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE screeningId = ?");
    $stmt->execute([$screeningId]);
    return $stmt->fetchColumn() >= $totalSeats;
}
function getAllScreenings()
{
    global $pdo;
    return $pdo->query("SELECT s.id, s.movieId, s.date, s.room, m.name as movie_name, (SELECT COUNT(*) FROM reservations WHERE screeningId = s.id) as reservations_count FROM screenings s JOIN movies m ON s.movieId = m.id ORDER BY s.date DESC")->fetchAll(PDO::FETCH_ASSOC);
}