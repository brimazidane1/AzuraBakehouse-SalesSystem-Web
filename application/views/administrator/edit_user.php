 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit Data User</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Kelola User</a></li>
                         <li class="breadcrumb-item active">Edit User</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <?= $this->session->flashdata('message'); ?>
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <!-- left column -->
                 <div class="col-md-6">
                     <!-- general form elements -->
                     <div class="card card-primary">
                         <div class="card-header">
                             <h3 class="card-title">Username: <?= $user['username']; ?></h3>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form action="<?= base_url($users['role'] . '/edit_user/') . $user['id']; ?>" method="post">
                             <div class="card-body">

                                 <div class="form-group">
                                     <label for="nama">Nama</label>
                                     <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama user" value="<?= $user['nama']; ?>">
                                     <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id']; ?>">
                                     <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                                 <div class="form-group">
                                     <label for="username">Username</label>
                                     <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" value="<?= $user['username']; ?>">
                                     <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                                 <div class="form-group">
                                     <label for="no_hp">No HP</label>
                                     <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan no_hp user" value="<?= $user['no_hp']; ?>">
                                     <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id']; ?>">
                                     <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>

                                 <div class="form-group">
                                     <label for="pilih_role">Role</label>
                                     <select class="custom-select" id="pilih_role" name="pilih_role">
                                         <?php foreach ($daftar_role as $d) : ?>
                                             <?php if ($d['id_role'] == $user['id_role']) {  ?>
                                                 <option value="<?= $d['id_role']; ?>" selected><?= $d['role']; ?></option>
                                             <?php } else { ?>
                                                 <option value="<?= $d['id_role']; ?>"><?= $d['role']; ?></option>
                                             <?php } ?>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
                             </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                 <a class="btn btn-secondary" href="<?= base_url($users['role'] . '/kelola_user') ?>">
                                     <span class="fas fa-angle-left"></span>
                                 </a>
                                 <button type="submit" class="btn btn-primary">Update</button>
                             </div>
                         </form>
                     </div>
                     <!-- /.card -->

                 </div>
                 <!--/.col (right) -->
             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->