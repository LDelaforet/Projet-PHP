<?php
require_once __DIR__ . '/db.php';
function addReservation($screeningId, $userId, $seat)
{
    global $pdo;
    $pdo->prepare("INSERT INTO reservations (screeningId, userId, seat) VALUES (?, ?, ?)")->execute([$screeningId, $userId, $seat]);
}
function getReservationsByScreening($screeningId)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM reservations WHERE screeningId = ?");
    $stmt->execute([$screeningId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getReservationsByUser($userId)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT r.id, r.screeningId, r.userId, r.seat, s.date, s.room, m.name, m.cover_url FROM reservations r JOIN screenings s ON r.screeningId = s.id JOIN movies m ON s.movieId = m.id WHERE r.userId = ? ORDER BY s.date DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function isSeatTaken($screeningId, $seat)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE screeningId = ? AND seat = ?");
    $stmt->execute([$screeningId, $seat]);
    return $stmt->fetchColumn() > 0;
}
function getReservationById($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM reservations WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function deleteReservation($id)
{
    global $pdo;
    return $pdo->prepare("DELETE FROM reservations WHERE id = ?")->execute([$id]);
}
function getAvailableSeats($screeningId, $totalSeats = 50)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT seat FROM reservations WHERE screeningId = ?");
    $stmt->execute([$screeningId]);
    return array_diff(range(1, $totalSeats), $stmt->fetchAll(PDO::FETCH_COLUMN));
}
function getAllReservations()
{
    global $pdo;
    return $pdo->query("SELECT r.id, r.screeningId, r.userId, r.seat, s.date, s.room, m.name, u.name as user_name, u.email FROM reservations r JOIN screenings s ON r.screeningId = s.id JOIN movies m ON s.movieId = m.id JOIN users u ON r.userId = u.id ORDER BY s.date DESC")->fetchAll(PDO::FETCH_ASSOC);
}