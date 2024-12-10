<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h2>Form Login</h2>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url(); ?>Auth" method="post">
                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" id="username" name="username"
                        value="<?= set_value('username'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password"
                        value="<?= set_value('password'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="row mt-2">
                <div class="col">
                    <a class="btn btn-sm btn-primary btn-block" href="<?= base_url() ?>Home"><i class="fas fa-home"></i>
                        Home</a>
                </div>
                <div class="col">
                    <a class="btn btn-info btn-sm dropdown-toggle btn-block" data-toggle="dropdown" href="#"><i
                            class="fas fa-registered"></i> Register
                    </a>
                    <div class="dropdown-menu">
                        <a href="<?= base_url() ?>Auth/registerUser" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>User
                        </a>
                        <!-- <a href="<?= base_url() ?>Auth/registerAdmin" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i>Admin
                    </a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->