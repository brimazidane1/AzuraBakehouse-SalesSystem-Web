<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Submenu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Kelola Submenu</li>
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
                        <h3 class="card-title">Daftar Submenu</h3>
                        <a class="ml-2 btn btn-primary btn-xs" href="<?= base_url($users['role'] . '/tambah_submenu') ?>">
                            <span class="fas fa-plus-square"></span> Tambah
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th>Judul Submenu</th>
                                        <th>Url</th>
                                        <th>Icon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($get_submenu as $s) : ?>
                                        <tr>
                                            <td> <?= $no++; ?>.</td>
                                            <td><?= $s['menu'] ?></td>
                                            <td><?= $s['judul'] ?></td>
                                            <td><?= $s['url'] ?></td>
                                            <td><?= $s['icon'] ?></td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="<?= base_url($users['role'] . '/edit_submenu/' . $s['id_sub']) ?>">
                                                    <span class="fas fa-pencil-alt"></span> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="<?= base_url($users['role'] . '/hapus_submenu/' . $s['id_sub']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Submenu ini?');">
                                                    <span class="fas fa-trash"></span> Delete

                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Judul Submenu</th>
                                    <th>Url</th>
                                    <th>Icon</th>
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