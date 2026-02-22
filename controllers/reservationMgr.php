<?php
require_once __DIR__ . '/../models/reservationDBMgr.php';
function createReservation($screeningId, $userId, $seat)
{
    if (isSeatTaken($screeningId, $seat)) {
        throw new ValidationException("Le siège $seat est déjà réservé pour cette séance.");
    }
    if (isScreeningFull($screeningId)) {
        throw new ValidationException("Cette séance est complète.");
    }
    addReservation($screeningId, $userId, $seat);
}