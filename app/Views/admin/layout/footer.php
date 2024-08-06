        
            </div>
        </div>

        <!-- Core JS -->
        <script src="<?= BASE_URL?>assets/vendor/libs/jquery/jquery.js"></script>
        <script src="<?= BASE_URL?>assets/vendor/libs/popper/popper.js"></script>
        <script src="<?= BASE_URL?>assets/vendor/js/bootstrap.js"></script>
        <script src="<?= BASE_URL?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="<?= BASE_URL?>assets/vendor/js/menu.js"></script>
        <!-- endbuild -->
        
        <!-- Vendors JS -->
        <script src="<?= BASE_URL?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
        
        <!-- Datatables JS -->
        <!-- <script src="<?= BASE_URL?>assets/js/tables-datatables-basic.js"></script>
        <script src="<?= BASE_URL?>assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script> -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <!-- Main JS -->
        <script src="<?= BASE_URL?>assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="<?= BASE_URL?>assets/js/dashboards-analytics.js"></script>
        <script src="<?= BASE_URL?>assets/js/ui-toasts.js"></script>

        <?php
            if (@isset($extra)) {
                echo view(@$extra);
            }
        ?>

    </body>
</html>
