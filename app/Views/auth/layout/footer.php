        
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="<?= BASE_URL ?>assets/vendor/libs/jquery/jquery.js"></script>
        <script src="<?= BASE_URL ?>assets/vendor/libs/popper/popper.js"></script>
        <script src="<?= BASE_URL ?>assets/vendor/js/bootstrap.js"></script>
        <script src="<?= BASE_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="<?= BASE_URL ?>assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="<?= BASE_URL ?>assets/js/main.js"></script>

        <!-- Page JS -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script>
            AOS.init();
        </script>

        
        <?php
            if (@isset($extra)) {
                echo view(@$extra);
            }
        ?>
    </body>
</html>
