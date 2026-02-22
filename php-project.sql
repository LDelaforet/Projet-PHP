-- phpMyAdmin SQL Dump
-- Structure uniquement (sans données)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `php-project` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;
USE `php-project`;

-- --------------------------------------------------------
-- Table `movies`
-- --------------------------------------------------------

CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `cover_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table `screenings`
-- --------------------------------------------------------

CREATE TABLE `screenings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movieId` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movieId` (`movieId`),
  CONSTRAINT `screenings_ibfk_1`
    FOREIGN KEY (`movieId`) 
    REFERENCES `movies` (`id`) 
    ON DELETE CASCADE
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table `reservations`
-- --------------------------------------------------------

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `screeningId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `seat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `screeningId` (`screeningId`),
  KEY `userId` (`userId`),
  CONSTRAINT `reservations_ibfk_1`
    FOREIGN KEY (`screeningId`) 
    REFERENCES `screenings` (`id`) 
    ON DELETE CASCADE,
  CONSTRAINT `reservations_ibfk_2`
    FOREIGN KEY (`userId`) 
    REFERENCES `users` (`id`) 
    ON DELETE CASCADE
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci;

COMMIT;