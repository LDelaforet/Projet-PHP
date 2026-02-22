<?php
function validateEmail($email)
{
    if (empty($email))
        return ['valid' => false, 'error' => 'L\'email est requis'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return ['valid' => false, 'error' => 'Format d\'email invalide'];
    return ['valid' => true];
}

function validatePassword($password)
{
    if (empty($password))
        return ['valid' => false, 'error' => 'Le mot de passe est requis'];
    if (strlen($password) < 8)
        return ['valid' => false, 'error' => 'Le mot de passe doit contenir au moins 8 caractères'];
    return ['valid' => true];
}

function validateName($name)
{
    if (empty($name))
        return ['valid' => false, 'error' => 'Le nom est requis'];
    if (strlen($name) < 2 || strlen($name) > 255)
        return ['valid' => false, 'error' => 'Le nom doit contenir entre 2 et 255 caractères'];
    return ['valid' => true];
}

function validateSeat($seat, $min = 1, $max = 50)
{
    if (!is_numeric($seat))
        return ['valid' => false, 'error' => 'Le numéro de siège doit être un nombre'];
    $seat = (int)$seat;
    if ($seat < $min || $seat > $max)
        return ['valid' => false, 'error' => "Le siège doit être entre $min et $max"];
    return ['valid' => true];
}

function validateScreeningDate($timestamp)
{
    if (!is_numeric($timestamp))
        return ['valid' => false, 'error' => 'La date doit être un timestamp valide'];
    if ((int)$timestamp < time())
        return ['valid' => false, 'error' => 'La date de la séance doit être dans le futur'];
    return ['valid' => true];
}

function validateRoom($room, $min = 1, $max = 10)
{
    if (!is_numeric($room))
        return ['valid' => false, 'error' => 'Le numéro de salle doit être un nombre'];
    $room = (int)$room;
    if ($room < $min || $room > $max)
        return ['valid' => false, 'error' => "La salle doit être entre $min et $max"];
    return ['valid' => true];
}

function validateId($id)
{
    if (!is_numeric($id) || $id <= 0)
        return ['valid' => false, 'error' => 'ID invalide'];
    return ['valid' => true];
}

function sanitizeString($string)
{
    return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
}

function validateUrl($url)
{
    if (empty($url))
        return ['valid' => false, 'error' => 'L\'URL est requise'];
    if (!filter_var($url, FILTER_VALIDATE_URL))
        return ['valid' => false, 'error' => 'Format d\'URL invalide'];
    return ['valid' => true];
}
