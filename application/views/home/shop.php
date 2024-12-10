<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">
    <style>
    /* Hover effect untuk card */
    .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efek saat card di-hover */
    .hover-effect:hover {
        transform: scale(1.05);
        /* Membuat card sedikit membesar */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Menambahkan bayangan */
    }

    /* Mengatur efek transisi */
    .card-body {
        transition: background-color 0.3s ease;
    }

    /* Mengubah warna latar belakang card saat hover */
    .hover-effect:hover .card-body {
        background-color: #f8f9fa;
    }
    </style>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1>SHOP</h1>
                </div>
                <div class="card-body">
                    <div class="row bg-dark mb-3">
                        <div class="col">
                            <h5>semua produk</h5>
                        </div>
                        <div class="col">
                            <h5>total : 21</h5>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (!empty($produk)) : ?>
                        <?php foreach ($produk as $item) : ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="card shadow-sm border border-primary btn hover-effect" href="#">
                                <img src="<?= base_url('assets/upload/produk/' . $item['image']); ?>"
                                    class="card-img-top" alt="<?= $item['nama_produk']; ?>" style="height: 200px;">
                                <div class="card-body text-center hover-effect">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="font-weight-bold text-truncate">
                                                <?= $item['nama_produk']; ?></h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="font-weight-bold text-truncate">Rp
                                                <?= number_format($item['harga_produk'], 0, ',', '.'); ?></h5>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="font-weight-bold text-truncate">Stok: <span
                                                    class="<?= $item['stok_produk'] > 0 ? 'text-success' : 'text-danger'; ?>">
                                                    <?= $item['stok_produk'] > 0 ? $item['stok_produk'] : 'Habis'; ?>
                                                </span></h5>
                                        </div>
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
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->