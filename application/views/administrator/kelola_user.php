<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Kelola User</li>
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
                        <h3 class="card-title">Daftar User</h3>
                        <a class="ml-2 btn btn-primary btn-xs" href="<?= base_url($users['role'] . '/register') ?>">
                            <span class="fas fa-user-plus"></span> Tambah
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Username</th>
                                        <th>No HP</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($get_users as $u) : ?>
                                        <tr>
                                            <td> <?= $no++; ?>.</td>
                                            <td><?= $u['nama'] ?></td>
                                            <td><?= $u['username'] ?></td>
                                            <td><?= $u['no_hp'] ?></td>
                                            <td><?= $u['role'] ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="<?= base_url($users['role'] . '/reset_user/' . $u['id']) ?>">
                                                    <span class="fas fa-user-lock"></span> Reset
                                                </a>
                                                <a class="btn btn-info btn-sm" href="<?= base_url($users['role'] . '/edit_user/' . $u['id']) ?>">
                                                    <span class="fas fa-pencil-alt"></span> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Username</th>
                                        <th>No HP</th>
                                        <th>Role</th>
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