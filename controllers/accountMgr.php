<?php
require_once __DIR__ . '/../models/userDBMgr.php';
require_once __DIR__ . '/../models/validation.php';

function createAccount($username, $mail, $password)
{
    $emailValidation = validateEmail($mail);
    if (!$emailValidation['valid']) {
        throw new ValidationException($emailValidation['error']);
    }

    $passwordValidation = validatePassword($password);
    if (!$passwordValidation['valid']) {
        throw new ValidationException($passwordValidation['error']);
    }

    $nameValidation = validateName($username);
    if (!$nameValidation['valid']) {
        throw new ValidationException($nameValidation['error']);
    }

    if (emailExists($mail)) {
        throw new ValidationException("Cet email est déjà utilisé.");
    }

    addUser($username, $mail, $password);
}

function login($loginInput, $password, $rememberMe = false)
{
    if (!checkPassword($loginInput, $password)) {
        throw new ValidationException("Email, nom d'utilisateur ou mot de passe incorrect.");
    }

    $user = getUserByEmailOrName($loginInput);
    if (!$user) {
        throw new ValidationException("Utilisateur non trouvé.");
    }

    $token = createToken($loginInput);

    if ($rememberMe) {
        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
    }

    return $user;
}

function updateProfile($userId, $name, $email, $newPassword = null)
{
    $nameValidation = validateName($name);
    if (!$nameValidation['valid']) {
        throw new ValidationException($nameValidation['error']);
    }

    $emailValidation = validateEmail($email);
    if (!$emailValidation['valid']) {
        throw new ValidationException($emailValidation['error']);
    }

    $existingUser = getUserByEmail($email);
    if ($existingUser && $existingUser['id'] != $userId) {
        throw new ValidationException("Cet email est déjà utilisé par un autre utilisateur.");
    }

    if (!empty($newPassword)) {
        $passwordValidation = validatePassword($newPassword);
        if (!$passwordValidation['valid']) {
            throw new ValidationException($passwordValidation['error']);
        }
    }

    updateUser($userId, $name, $email, $newPassword);

    return ['success' => true, 'message' => 'Profil mis à jour avec succès.'];
}

function deleteAccount($userId)
{
    $result = deleteUser($userId);
    if (!$result) {
        throw new DatabaseException("Erreur lors de la suppression du compte.");
    }
    return ['success' => true, 'message' => 'Compte supprimé avec succès.'];
}

function getUserFromToken($token)
{
    return getUserByToken($token);
}