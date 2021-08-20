<?= $this->session->flashdata('message'); ?>
<div class="card">
  <div class="card-body register-card-body">
    <p class="login-box-msg">Register a new user</p>

    <form class="register" method="post" action="<?= base_url($users['role'] . '/register'); ?>">
      <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
      <div class="input-group mb-3">
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama user" value="<?= set_value('nama'); ?>">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>

      </div>

      <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
      <div class="input-group mb-3">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>

      <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
      <div class="input-group mb-3">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>

      <?= form_error('repeat_password', '<small class="text-danger pl-3">', '</small>') ?>
      <div class="input-group mb-3">
        <input type="password" id="repeat_password" name="repeat_password" class="form-control" placeholder="Retype password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>

      <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>') ?>
      <div class="input-group mb-3">
        <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="No HP" value="<?= set_value('no_hp'); ?>">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-mobile-alt"></span>
          </div>
        </div>
      </div>

      <?= form_error('pilih_role', '<small class="text-danger pl-3">', '</small>') ?>
      <div class="input-group mb-3">
        <select class="custom-select" id="pilih_role" name="pilih_role">
          <option class="form-control form-control-user" value="<?= set_value('pilih_role'); ?>"> -- Pilih Role -- </option>
          <div class="form-control form-control-user" aria-labelledby="pilih_role">
            <?php foreach ($daftar_role as $d) : ?>
              <option value="<?= $d['id_role'] ?> "><?= $d['role'] ?> </option>
            <?php endforeach; ?>
        </select>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-award"></span>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-8">
          <a class="ml-2 btn btn-secondary" href="<?= base_url($users['role'] . '/kelola_user') ?>">
            <span class="fas fa-angle-left"></span>
          </a>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



  </div>
  <!-- /.form-box -->
</div><!-- /.card -->
</div>
<!-- /.register-box -->