<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">SHOP</h1>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row bg-dark p-2">
                                <div class="col">
                                    <h5><?= $title; ?></h5>
                                </div>
                                <div class="col text-right">
                                    <h5>Total : <?= $totalproduk; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if (!empty($produk)) : ?>
                                <?php foreach ($produk as $item) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-4">
                                    <div class="card shadow-sm border border-primary hover-effect">
                                        <img src="<?= base_url('assets/upload/produk/' . $item['image']); ?>"
                                            class="card-img-top" alt="<?= $item['nama_produk']; ?>"
                                            style="height: 200px; object-fit: cover;">
                                        <div class="card-body text-center hover-effect">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="font-italic text-truncate" style="font-size: 1rem;">
                                                        <?= $item['nama_kategori']; ?>
                                                    </h5>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="font-weight-bold text-truncate" style="font-size: 1rem;">
                                                        <?= $item['nama_produk']; ?>
                                                    </h5>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="font-weight-bold text-success"
                                                        style="font-size: 1.1rem;">Rp
                                                        <?= number_format($item['harga_produk'], 0, ',', '.'); ?>
                                                    </h5>
                                                </div>
                                                <div class="col-12">
                                                    <h6 class="font-weight-bold text-truncate">Stok:
                                                        <span
                                                            class="<?= $item['stok_produk'] > 0 ? 'text-success' : 'text-danger'; ?>">
                                                            <?= $item['stok_produk'] > 0 ? $item['stok_produk'] : 'Habis'; ?>
                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <!-- Icons for cart and view -->
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="gap: 10px;">
                                                <!-- View Icon -->
                                                <a href="<?= base_url('home/produk/' . $item['id_produk']); ?>"
                                                    class="text-primary">
                                                    <i class="fas fa-eye fa-lg"></i>
                                                </a>
                                                <!-- Cart Icon -->
                                                <a href="<?= base_url('keranjang/tambah/' . $item['id_produk']); ?>"
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
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->