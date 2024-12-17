<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="#" class="navbar-brand">
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
                <?php if ($this->session->userdata('level') == 'user') { ?>
                <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">History</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>Keranjang/Orders">Orders</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>Keranjang/recentProduk">Recent
                                Products</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">About Us</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>Home/AboutUs">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>Home/Contact">Contact</a></li>
                    </ul>
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
            </ul>

            <!-- Right navbar links (Login, Register, User Profile, etc.) -->
            <ul class="navbar-nav ml-auto">
                <!-- Cart Icon with item count -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('keranjang'); ?>">
                        <i class="fas fa-shopping-cart"></i>
                        <?php $jumlah_keranjang = $this->session->userdata('keranjang') ? count($this->session->userdata('keranjang')) : 0; ?>
                        <span class="text-danger font-weight-bold">
                            <?= $jumlah_keranjang; ?>
                        </span>
                    </a>
                </li>
                <!-- Add ml-auto here to align to the right -->
                <?php if ($this->session->userdata('level') != 'user') { ?>
                <li class="nav-item mx-2 mb-2">
                    <!-- Tombol Login -->
                    <a class="btn btn-success" href="<?= base_url(); ?>Auth">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                <li class="nav-item mx-2 mb-2">
                    <!-- Tombol Register -->
                    <a class="btn btn-warning" href="<?= base_url() ?>Auth/registerUser">
                        <i class="fas fa-registered"></i> Register
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item dropdown mx-2">
                    <a href="#" class="dropdown-toggle btn btn-primary text-light" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span><?= $user['nama']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>User/index">
                                <i class="fas fa-user"></i> My Profile
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