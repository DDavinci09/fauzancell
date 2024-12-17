<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">HOME</h1>
                </div>
                <div class="card-body">
                    <img src="<?= base_url('assets/dist/img/fauzancell.jpg'); ?>"
                        class="d-block border border-3 border-primary rounded" alt="..."
                        style="aspect-ratio: 16/9; width: 100%; overflow: hidden;">
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Produk Terbaru</h1>
                </div>
                <div class="card-body">
                    <div id="carouselKategori" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php 
        $isActive = true;
        $counter = 0;
        $itemsPerSlide = 4;
        foreach ($kategori as $kat) :
            if ($counter % $itemsPerSlide == 0): ?>
                            <div class="carousel-item <?= $isActive ? 'active' : ''; ?>">
                                <div class="row">
                                    <?php $isActive = false; endif; ?>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-4">
                                        <div class="card shadow-sm h-100 border-2 border-primary">
                                            <div class="card-header bg-primary text-white text-center">
                                                <h5 class="mb-0"><?= $kat['nama_kategori']; ?></h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <p class="card-text">
                                                    <?= word_limiter($kat['keterangan_kategori'], 10); ?></p>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a href="<?= base_url('Home/getKategoriProduk/' . $kat['id_kategori']); ?>"
                                                    class="btn btn-sm btn-primary">Lihat Produk</a>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                        $counter++;
                        if ($counter % $itemsPerSlide == 0 || $counter == count($kategori)): ?>
                                </div>
                            </div>
                            <?php endif; 
        endforeach; ?>
                        </div>
                        <a class="carousel-control-prev custom-carousel-control" href="#carouselKategori" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next custom-carousel-control" href="#carouselKategori" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Produk Terbaru</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if (!empty($produkBaru)) : ?>
                        <?php foreach ($produkBaru as $baru) : ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-4">
                            <div class="card shadow-sm border border-primary hover-effect">
                                <img src="<?= base_url('assets/upload/produk/' . $baru['image']); ?>"
                                    class="card-img-top" alt="<?= $baru['nama_produk']; ?>"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body text-center hover-effect">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="font-italic text-truncate" style="font-size: 1rem;">
                                                <?= $baru['nama_kategori']; ?>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="font-weight-bold text-truncate" style="font-size: 1rem;">
                                                <?= $baru['nama_produk']; ?>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="font-weight-bold text-success" style="font-size: 1.1rem;">Rp
                                                <?= number_format($baru['harga_produk'], 0, ',', '.'); ?>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="font-weight-bold text-truncate">Stok:
                                                <span
                                                    class="<?= $baru['stok_produk'] > 0 ? 'text-success' : 'text-danger'; ?>">
                                                    <?= $baru['stok_produk'] > 0 ? $baru['stok_produk'] : 'Habis'; ?>
                                                </span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                        <a href="<?= base_url('home/produk/' . $baru['id_produk']); ?>"
                                            class="text-primary">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>
                                        <a href="<?= base_url('keranjang/tambah/' . $baru['id_produk']); ?>"
                                            class="text-success">
                                            <i class="fas fa-cart-plus fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="col-12">
                            <div class="alert alert-warning text-center" role="alert">
                                Tidak ada produk yang tersedia saat ini.
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->userdata('username')) : ?>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Produk Baru Dibeli</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if (!empty($produkRecent)) : ?>
                        <?php foreach ($produkRecent as $recent) : ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-4">
                            <div class="card shadow-sm border border-primary hover-effect">
                                <img src="<?= base_url('assets/upload/produk/' . $recent['image']); ?>"
                                    class="card-img-top" alt="<?= $recent['nama_produk']; ?>"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body text-center hover-effect">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="font-italic text-truncate" style="font-size: 1rem;">
                                                <?= $recent['nama_kategori']; ?>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="font-weight-bold text-truncate" style="font-size: 1rem;">
                                                <?= $recent['nama_produk']; ?>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="font-weight-bold text-success" style="font-size: 1.1rem;">Rp
                                                <?= number_format($recent['harga_produk'], 0, ',', '.'); ?>
                                            </h5>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="font-weight-bold text-truncate">Stok:
                                                <span
                                                    class="<?= $recent['stok_produk'] > 0 ? 'text-success' : 'text-danger'; ?>">
                                                    <?= $recent['stok_produk'] > 0 ? $recent['stok_produk'] : 'Habis'; ?>
                                                </span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                        <a href="<?= base_url('home/produk/' . $recent['id_produk']); ?>"
                                            class="text-primary">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>
                                        <a href="<?= base_url('keranjang/tambah/' . $recent['id_produk']); ?>"
                                            class="text-success">
                                            <i class="fas fa-cart-plus fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="col-12">
                            <div class="alert alert-warning text-center" role="alert">
                                Belum ada produk yang baru dibeli.
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<!-- /.content-wrapper -->