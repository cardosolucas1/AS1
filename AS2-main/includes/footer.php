    <!-- Footer Fixo -->
    <footer class="footer-fixed">
        <div class="container">
            <?php
            // Detecta se estamos em uma subpasta (admin ou login)
            $isAdmin = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
            $isLogin = strpos($_SERVER['PHP_SELF'], '/login/') !== false;
            $basePath = ($isAdmin || $isLogin) ? '../' : '';
            ?>
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2025 Inflatoy - Todos os direitos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="<?php echo $basePath; ?>index.php" class="me-3"><i class="bi bi-house"></i></a>
                    <a href="<?php echo $basePath; ?>form.php" class="me-3"><i class="bi bi-calendar-check"></i></a>
                    <a href="<?php echo $basePath; ?>about.php"><i class="bi bi-info-circle"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/login/') !== false) ? '../' : ''; ?>script/script.js"></script>
    
    <script>
        // Animação de scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        
        // Efeito de fade-in ao carregar
        window.addEventListener('load', function() {
            document.body.classList.add('animate-fade-in');
        });
    </script>
</body>
</html>

