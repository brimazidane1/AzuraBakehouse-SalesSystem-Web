 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Tambah Menu</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Menu</a></li>
                         <li class="breadcrumb-item active">Tambah Menu</li>
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
                             <h3 class="card-title">Form Menu</h3>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form action="<?= base_url($users['role'] . '/tambah_menu'); ?>" method="post">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="menu">Nama Menu</label>
                                     <input type="text" class="form-control" id="menu" name="menu" placeholder="Masukkan nama menu..." value="<?= set_value('menu'); ?>">
                                     <?= form_error('menu', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                             </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                 <a class="btn btn-secondary" href="<?= base_url($users['role'] . '/kelola_menu') ?>">
                                     <span class="fas fa-angle-left"></span>
                                 </a>
                                 <button type="submit" class="btn btn-primary">Add</button>
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