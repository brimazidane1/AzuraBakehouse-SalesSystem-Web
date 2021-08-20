<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Kelola Menu</li>
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
                        <h3 class="card-title">Daftar Menu</h3>
                        <a class="ml-2 btn btn-primary btn-xs" href="<?= base_url($users['role'] . '/tambah_menu') ?>">
                            <span class="fas fa-user-plus"></span> Tambah
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Menu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($get_menu as $m) : ?>
                                        <tr>
                                            <td> <?= $no++; ?>.</td>
                                            <td><?= $m['menu'] ?></td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="<?= base_url($users['role'] . '/edit_menu/' . $m['id']) ?>">
                                                    <span class="fas fa-pencil-alt"></span> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="<?= base_url($users['role'] . '/hapus_menu/' . $m['id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus menu ini?');">
                                                    <span class="fas fa-trash"></span> Delete

                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <th>#</th>
                                    <th>Nama Menu</th>
                                    <th>Aksi</th>
                                    </tr>
                                </tfoot>
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