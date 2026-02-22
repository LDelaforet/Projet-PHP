# Projet-PHP

Application web de réservation de films - Système de gestion de cinéma

## 📋 Description

Plateforme de réservation de films avec gestion administrative complète :
- 🎬 Catalogue de films avec synopsis et couvertures
- 🎟️ Système de réservation de places
- 👤 Authentification utilisateurs
- 🔐 Panel administrateur pour la gestion des films et séances

## 🚀 Installation et Démarrage

### Prérequis
- **XAMPP** (Apache + MySQL + PHP)
- PHP 7.0 ou supérieur
- MySQL

### Étapes d'installation

1. **Cloner/placer le projet dans htdocs**
   ```bash
   C:\xampp\htdocs\Projet-PHP
   ```

2. **Démarrer XAMPP**
   - Ouvrir XAMPP Control Panel
   - Démarrer **Apache** et **MySQL**

3. **Créer la base de données**
   - Accéder à **phpMyAdmin** : http://localhost/phpmyadmin
   - Créer une nouvelle base de données nommée `php-project`
   - Exécuter le script SQL fourni (voir section SQL ci-dessous)

4. **Accéder à l'application**
   ```
   http://localhost/Projet-PHP/public/index.php
   ```

## 🗄️ Base de Données

Importez le fichier `php-project.sql` fourni dans le projet :

1. Ouvrir **phpMyAdmin** : http://localhost/phpmyadmin
2. Créer une nouvelle base de données nommée `php-project`
3. Aller à l'onglet **Importer**
4. Sélectionner le fichier [php-project.sql](php-project.sql)
5. Cliquer sur **Exécuter**

## 📁 Structure du Projet

```
Projet-PHP/
├── controllers/          # Contrôleurs
│   ├── accountMgr.php
│   ├── filmMgr.php
│   └── reservationMgr.php
├── models/              # Modèles et accès BD
│   ├── db.php
│   ├── errorHandler.php
│   ├── movieDBMgr.php
│   ├── reservationDBMgr.php
│   ├── screeningDBMgr.php
│   ├── userDBMgr.php
│   └── validation.php
├── views/               # Templates HTML
│   ├── admin/          # Interface administrateur
│   ├── auth/           # Authentification
│   ├── films/          # Catalogue et séances
│   ├── reservations/   # Gestion des réservations
│   ├── components/     # Composants réutilisables
│   └── layout/         # En-têtes et pieds de page
├── public/             # Point d'entrée web
│   ├── index.php
│   ├── test-data.php
│   └── assets/
│       └── css/
│           └── style.css
├── php-project.sql     # Script de création BD
└── README.md           # Ce fichier
```

## 👤 Accès Administrateur

- Accédez au panel administrateur après création d'un compte admin
- Les utilisateurs admin peuvent :
  - Gérer les films
  - Ajouter/modifier les séances
  - Consulter les réservations
  - Gérer les utilisateurs

## 📝 Fonctionnalités Principales

- ✅ Authentification et gestion des comptes
- ✅ Catalogue de films avec recherche
- ✅ Réservation de places pour les séances
- ✅ Page profil utilisateur
- ✅ Panel administrateur complet
- ✅ Gestion des erreurs et validation des données