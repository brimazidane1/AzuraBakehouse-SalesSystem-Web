<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Akses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Akses</a></li>
                        <li class="breadcrumb-item active">Akses</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <?= $this->session->flashdata('message'); ?>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-tool" href="<?= base_url($users['role'] . '/kelola_akses') ?>">
                            <i class="fas fa-arrow-left"></i> Back</a>

                        <div class="card-tools">
                            <strong>Role: <?= $role['role']; ?></strong>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th>Akses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <td> <?= $no++; ?>.</td>
                                            <td><?= $m['menu'] ?></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?= cek_akses($role['id_role'], $m['id']); ?> data-role="<?= $role['id_role']; ?>" data-menu="<?= $m['id']; ?>">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
    //kelola hak akses ajax
    $('.form-check-input').on('click', function() {
        const idMenu = $(this).data('menu');
        const idRole = $(this).data('role');

        $.ajax({
            url: "<?= base_url($users['role'] . '/ganti_akses'); ?>",
            type: 'post',
            data: {
                idMenu: idMenu,
                idRole: idRole
            },
            success: function() {
                toastr.success('Akses telah berhasil diupdate.', 'Success!');
            }
        });
    });
</script>