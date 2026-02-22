<?php
// Fichier de test permettant de vérifier que les pages fonctionnent avec des données de test

// Données de test
if (!function_exists('listFilms')) {
    function listFilms() {
        return [
            ['id' => 1, 'titre' => 'Dune: Part Two', 'description' => 'Un epic de science-fiction mettant en scène Paul Atreides.'],
            ['id' => 2, 'titre' => 'Oppenheimer', 'description' => 'La vie du père de la bombe atomique, basée sur la biographie de M. Smith.'],
            ['id' => 3, 'titre' => 'Barbie', 'description' => 'Barbie et Ken naviguent dans le monde réel.'],
            ['id' => 4, 'titre' => 'Killers of the Flower Moon', 'description' => 'Un drame historique sur une tragédie Osage.'],
            ['id' => 5, 'titre' => 'Napoleon', 'description' => 'L\'épopée de Napoléon Bonaparte.'],
            ['id' => 6, 'titre' => 'Poor Things', 'description' => 'Un conte fantastique étrange et merveilleux.'],
        ];
    }
}

if (!function_exists('getFilmDetails')) {
    function getFilmDetails($id) {
        $films = listFilms();
        foreach ($films as $film) {
            if ($film['id'] == $id) {
                return $film;
            }
        }
        return null;
    }
}

if (!function_exists('getFilmScreenings')) {
    function getFilmScreenings($filmId) {
        return [
            ['id' => 1, 'date' => '2026-02-21', 'heure' => '14:00', 'salle' => 1],
            ['id' => 2, 'date' => '2026-02-21', 'heure' => '17:00', 'salle' => 2],
            ['id' => 3, 'date' => '2026-02-22', 'heure' => '19:30', 'salle' => 1],
        ];
    }
}

if (!function_exists('getReservationsByUser')) {
    function getReservationsByUser($userId) {
        return [
            ['id' => 1, 'titre' => 'Dune: Part Two', 'date' => '2026-02-21', 'heure' => '14:00', 'nombre_places' => 2],
            ['id' => 2, 'titre' => 'Oppenheimer', 'date' => '2026-02-25', 'heure' => '19:30', 'nombre_places' => 1],
        ];
    }
}

// Inclure les fonctions des contrôleurs réels si elles existent
if (file_exists(__DIR__ . '/controllers/filmMgr.php')) {
    require_once __DIR__ . '/controllers/filmMgr.php';
}
