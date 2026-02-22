<?php
require_once __DIR__ . '/db.php';

function addUser($name, $email, $password)
{
    global $pdo;
    $salt = bin2hex(random_bytes(16));
    $hashedPassword = hash('sha256', $password . $salt);
    $pdo->prepare("INSERT INTO users (name, email, password, salt, isAdmin) VALUES (?, ?, ?, ?, 0)")->execute([$name, $email, $hashedPassword, $salt]);
    return $pdo->lastInsertId();
}

function checkPassword($emailOrUsername, $password)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT password, salt FROM users WHERE email = ? OR name = ?");
    $stmt->execute([$emailOrUsername, $emailOrUsername]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return hash_equals(hash('sha256', $password . $user['salt']), $user['password']);
    }
    return false;
}

function createToken($emailOrUsername)
{
    global $pdo;
    $token = bin2hex(random_bytes(16));
    $pdo->prepare("UPDATE users SET token = ? WHERE email = ? OR name = ?")->execute([$token, $emailOrUsername, $emailOrUsername]);
    return $token;
}

function getUserByToken($token)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function isAdmin($email)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT isAdmin FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user && $user['isAdmin'] == 1;
}

function logout($token)
{
    global $pdo;
    $pdo->prepare("UPDATE users SET token = NULL WHERE token = ?")->execute([$token]);
}

function getUserById($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, email, isAdmin FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserByEmail($email)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, email, isAdmin FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserByEmailOrName($emailOrUsername)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, name, email, isAdmin FROM users WHERE email = ? OR name = ?");
    $stmt->execute([$emailOrUsername, $emailOrUsername]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($id, $name, $email, $password = null)
{
    global $pdo;
    if ($password) {
        $salt = bin2hex(random_bytes(16));
        return $pdo->prepare("UPDATE users SET name = ?, email = ?, password = ?, salt = ? WHERE id = ?")->execute([$name, $email, hash('sha256', $password . $salt), $salt, $id]);
    }
    return $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?")->execute([$name, $email, $id]);
}

function deleteUser($id)
{
    global $pdo;
    try {
        $pdo->beginTransaction();
        $pdo->prepare("DELETE FROM reservations WHERE userId = ?")->execute([$id]);
        $result = $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
        $pdo->commit();
        return $result;
    }
    catch (PDOException $e) {
        $pdo->rollBack();
        throw new DatabaseException("Erreur lors de la suppression du compte.");
    }
}

function emailExists($email)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}

function getAllUsers()
{
    global $pdo;
    return $pdo->query("SELECT id, name, email, isAdmin FROM users")->fetchAll(PDO::FETCH_ASSOC);
}