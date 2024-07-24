<footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                Copyright © Total Property <?php echo date("Y"); ?>
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
            <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank"></a> 
            </span>
        </div>
    </footer>
        </div>
    </div>
    <script src="<?= base_url('admin/static/js/components/dark.js') ?>"></script>
<script src="<?= base_url('admin/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>

<script src="<?= base_url('admin/compiled/js/app.js') ?>"></script>

<!-- Need: Apexcharts -->
<script src="<?= base_url('/admin/extensions/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('/admin/static/js/pages/dashboard.js') ?>"></script>
    <script src="<?= base_url('/admin/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js') ?>"></script>
    <script src="<?= base_url('/admin/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
    <script src="<?= base_url('/admin/static/js/pages/simple-datatables.js') ?>"></script>
<script src="<?= base_url('/admin/static/js/pages/quill.js') ?>"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure only numeric input
        document.querySelectorAll('input[type="number"]').forEach(function(input) {
            input.addEventListener('input', function() {
                // Remove non-numeric characters
                this.value = this.value.replace(/[^0-9.]/g, '');
            });
        });
    });
</script>
