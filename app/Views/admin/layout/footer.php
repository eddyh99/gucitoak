        
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
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <!-- Main JS -->
        <script src="<?= BASE_URL?>assets/js/main.js"></script>

        <!-- Telephone Code -->
        <script src="<?= BASE_URL?>assets/vendor/libs/intl-tel-input-master/build/js/intlTelInput.js"></script>
        
        <!-- Format Price -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.8.2/autoNumeric.js"></script>

        <!-- Page JS -->
        <script src="<?= BASE_URL?>assets/js/dashboards-analytics.js"></script>
        <script src="<?= BASE_URL?>assets/js/ui-toasts.js"></script>

        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <?php
            if (@isset($extra)) {
                echo view(@$extra);
            }
        ?>

        <script>
            $(".price-input").autoNumeric('init', {
                aSep: ',',
                aDec: '.',
                aForm: true,
                vMax: '99999999999',
                vMin: '0'
            });

            $(".disc-input").autoNumeric('init', {
                aSep: ',',
                aDec: '.',
                aForm: true,
                vMax: '9.999',
                vMin: '0'
            });
        </script>

    </body>
</html>
