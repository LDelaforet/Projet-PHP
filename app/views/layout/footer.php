    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3 class="footer-title">Cinéma Réservation</h3>
                <p class="footer-subtitle">Projet pédagogique - Architecture MVC</p>
            </div>

            <div class="footer-section">
                <h4 class="footer-heading">Liens Utiles</h4>
                <ul class="footer-links">
                    <li>
                        <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php" class="footer-link">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=film&action=index" class="footer-link">
                            Films
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo htmlspecialchars($_SERVER['BASE_URL'] ?? '') ?>public/index.php?controller=contact&action=index" class="footer-link">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer-section footer-copyright">
                <p>&copy; <?php echo htmlspecialchars(date('Y')); ?> Cinéma Réservation. Tous droits réservés.</p>
                <p class="footer-note">Projet pédagogique YNOV - PHP MVC</p>
            </div>
        </div>
    </footer>

</body>
</html>
