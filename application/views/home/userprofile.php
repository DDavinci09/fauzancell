<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">My Profile</h1>
                </div>
                <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('message'); ?>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <!-- Data Profil -->
                        <div class="col-md-5">
                            <form action="<?= base_url('User/editProfile'); ?>" method="post">
                                <h4>Update Data</h4>
                                <div class="form-group">
                                    <label for="nama">Nama :</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        value="<?= $user['nama'] ?>" placeholder="Masukkan stok produk" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        value="<?= $user['email'] ?>" placeholder="Masukkan stok produk" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No Telp :</label>
                                    <input type="text" name="no_telp" class="form-control" id="no_telp"
                                        value="<?= $user['no_telp'] ?>" placeholder="Masukkan stok produk" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <textarea class="form-control" id="alamat" name="alamat"
                                        placeholder="Masukkan alamat"><?= $user['alamat'] ?></textarea>
                                </div>
                                <!-- Tombol Edit -->
                                <div class="d-flex justify-content-center">
                                    <!-- Menambahkan class d-flex dan justify-content-center -->
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <form action="<?= base_url('User/editUsernamePassword'); ?>" method="post">
                                <h4>Change Username & Password</h4>
                                <div class="form-group">
                                    <label for="username">Username :</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="<?= $user['username']; ?>" placeholder="Username" required>
                                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password1">Password Baru :</label>
                                    <input type="password" class="form-control" name="password1" id="password1"
                                        placeholder="Password Baru" required>
                                    <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password2">Ulangi Password Baru :</label>
                                    <input type="password" class="form-control" name="password2" id="password2"
                                        placeholder="Ulangi Password Baru" required>
                                    <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <!-- Tombol Edit -->
                                <div class="d-flex justify-content-center">
                                    <!-- Menambahkan class d-flex dan justify-content-center -->
                                    <button class="btn btn-danger" type="submit">Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->