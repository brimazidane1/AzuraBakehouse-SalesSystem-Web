<footer class="main-footer text-sm">
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= base_url() ?>">AZURA BAKEHOUSE | Inventory & Sales System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modaltitle" id="logoutModalLabel">Apakah anda yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Jika tidak, pilih batal.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-success" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    /*Resolve conflict in jQuery UI tooltip with Bootstrap tooltip */
    $.widget.bridge('uibutton', $.ui.button)

    $(document).ready(function() {
        var table = $('#example1').DataTable({
            fixedHeader: true
        });
    });
</script>
</body>

</html>