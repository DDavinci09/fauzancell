<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="<?= base_url('assets'); ?>/index3.html" class="navbar-brand">
            <img src="<?= base_url('assets'); ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Fauzan Cell</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= base_url() ?>Home/index" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>Home/shop" class="nav-link">Shop</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>Keranjang/index" class="nav-link">Cart</a>
                </li>
                <li class="nav-item">
                    <a href="index3.html" class="nav-link">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="index3.html" class="nav-link">Contact</a>
                </li>

                <!-- Search form -->
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0" action="<?= base_url(); ?>home/Pencarian" method="get">
                        <div class="input-group">
                            <input class="form-control mr-sm-2" type="search" name="keyword"
                                placeholder="Search products..." aria-label="Search" required>
                            <div class="input-group-append">
                                <a class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </li>
                <?php if ($this->session->userdata('level') != 'user') { ?>
                <li class="nav-item mx-2 mb-2">
                    <!-- Tombol Login -->
                    <a class="btn btn-success" href="<?= base_url(); ?>Auth">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                <li class="nav-item dropdown mx-2">
                    <!-- Tombol Dropdown Registrasi -->
                    <a class="btn btn-warning  dropdown-toggle" data-toggle="dropdown" href="#" id="registerDropdown">
                        <i class="fas fa-registered"></i> Register
                    </a>

                    <!-- Isi Dropdown -->
                    <div class="dropdown-menu" aria-labelledby="registerDropdown">
                        <a href="<?= base_url() ?>Auth/registerUser" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>User
                        </a>
                        <a href="<?= base_url() ?>Auth/registerAlumni" class="dropdown-item">
                            <i class="fas fa-user-graduate mr-2"></i>Alumni
                        </a>
                    </div>
                </li>
                <?php } else { ?>
                <li class="nav-item submenu dropdown mx-2">
                    <a href="#" class="nav-link dropdown-toggle btn btn-primary text-light" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                        <span><?= $user['nama']; ?></span> <!-- Nama pengguna -->
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>User/MyProfile">
                                <i class="fas fa-user"></i> My Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-check"></i> Activity Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- /.navbar -->