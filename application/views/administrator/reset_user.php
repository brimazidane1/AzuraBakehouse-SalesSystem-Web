 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Reset Password</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Kelola User</a></li>
                         <li class="breadcrumb-item active">Reset Password</li>
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
                             <h3 class="card-title">Username: <?= $reset_user['username']; ?></h3>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form action="<?= base_url($users['role'] . '/reset_user/') . $reset_user['id']; ?>" method="post">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="passwordBaru1">Password Baru</label>
                                     <input type="password" class="form-control" id="passwordBaru1" name="passwordBaru1" placeholder="Masukkan password baru">
                                     <input type="hidden" class="form-control" id="id" name="id" value="<?= $reset_user['id']; ?>">
                                     <?= form_error('passwordBaru1', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                                 <div class="form-group">
                                     <label for="passwordBaru2">Ulangi Password</label>
                                     <input type="password" class="form-control" id="passwordBaru2" name="passwordBaru2" placeholder="Ulangi password baru">
                                     <?= form_error('passwordBaru2', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                             </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                 <a class="btn btn-secondary" href="<?= base_url($users['role'] . '/kelola_user') ?>">
                                     <span class="fas fa-angle-left"></span>
                                 </a>
                                 <button type="submit" class="btn btn-primary">Reset</button>
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