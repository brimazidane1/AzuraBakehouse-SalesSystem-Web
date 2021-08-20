<?= $this->session->flashdata('message'); ?>
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Login</p>

    <form class="login" action="<?= base_url('auth') ?>" method="post">
      <?= form_error('username', '<small class="text-danger pl-2">', '</small>') ?>
      <div class="input-group mb-3">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>

      <?= form_error('password', '<small class="text-danger pl-2">', '</small>') ?>
      <div class="input-group mb-3">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-8">

        </div>
        <!-- /.col -->


        <button type="submit" class="btn btn-success btn-block">Login</button>

        <!-- /.col -->
      </div>
    </form>

    <center>
      <p style="font-size:90%;" class="mt-1 mb-0">
        Lupa Password? Laporkan pada administrator.
      </p>
    </center>

  </div>
  <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->