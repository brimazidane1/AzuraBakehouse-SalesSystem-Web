 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Tambah Submenu</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Kelola Submenu</a></li>
                         <li class="breadcrumb-item active">Tambah Submenu</li>
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
                             <h3 class="card-title">Form Submenu</h3>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form action="<?= base_url($users['role'] . '/tambah_submenu'); ?>" method="post">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="pilih_menu">Menu</label>
                                     <select class="custom-select" id="pilih_menu" name="pilih_menu">
                                         <option class="form-control form-control-user" value="<?= set_value('pilih_menu'); ?>"> -- Pilih Menu -- </option>
                                         <div class="form-control form-control-user" aria-labelledby="pilih_menu">
                                             <?php foreach ($daftar_menu as $d) : ?>
                                                 <option value="<?= $d['id'] ?> "><?= $d['menu'] ?> </option>
                                             <?php endforeach; ?>
                                     </select>
                                     <?= form_error('pilih_menu', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                                 <div class="form-group">
                                     <label for="judul">Judul Submenu</label>
                                     <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul submenu...." value="<?= set_value('judul'); ?>">
                                     <?= form_error('judul', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                                 <div class="form-group">
                                     <label for="url">URL</label>
                                     <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan url submenu...." value="<?= set_value('url'); ?>">
                                     <?= form_error('url', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>
                                 <div class="form-group">
                                     <label for="icon">Icon</label>
                                     <input type="text" class="form-control" id="icon" name="icon" placeholder="Masukkan icon submenu...." value="<?= set_value('icon'); ?>">
                                     <?= form_error('icon', '<small class="text-danger pl-3">', '</small>') ?>
                                 </div>

                             </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                 <a class="btn btn-secondary" href="<?= base_url($users['role'] . '/kelola_submenu') ?>">
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