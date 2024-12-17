<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">PRODUK</h1>
                </div>
                <div class="card-body">
                    <div class="row no-gutters">
                        <!-- Gambar Produk -->
                        <div class="col-md-5">
                            <div class="product-image h-100 position-relative">
                                <img src="<?= base_url('assets/upload/produk/' . $item['image']); ?>"
                                    class="img-fluid w-100 rounded-left" alt="<?= $item['nama_produk']; ?>" style="">
                            </div>
                        </div>

                        <!-- Detail Produk -->
                        <div class="col-md-7">
                            <div class="card-body">
                                <!-- Nama Produk dan Data -->
                                <div class="row mb-3 h4">
                                    <div class="col-md-4 text-muted font-weight-bold">
                                        <i class="fas fa-tag mr-2"></i> Nama Produk
                                    </div>
                                    <div class="col-md-8 text-dark font-weight-bold">
                                        <?= $item['nama_produk']; ?>
                                    </div>
                                </div>

                                <!-- Harga Produk dan Data -->
                                <div class="row mb-3 h5">
                                    <div class="col-md-4 text-muted font-weight-bold">
                                        <i class="fas fa-money-bill-wave mr-2"></i> Harga
                                    </div>
                                    <div class="col-md-8 text-dark font-weight-bold">
                                        Rp <?= number_format($item['harga_produk'], 0, ',', '.'); ?>
                                    </div>
                                </div>

                                <!-- Stok Produk dan Data -->
                                <div class="row mb-3 h5">
                                    <div class="col-md-4 text-muted font-weight-bold">
                                        <i class="fas fa-box-open mr-2"></i> Stok
                                    </div>
                                    <div
                                        class="col-md-8 font-weight-bold <?= $item['stok_produk'] > 0 ? 'text-dark' : 'text-dark'; ?>">
                                        <?= $item['stok_produk'] > 0 ? $item['stok_produk'] : 'Habis'; ?>
                                    </div>
                                </div>

                                <!-- Jumlah Pembelian -->
                                <div class="row mb-4 h5">
                                    <div class="col-md-4 text-muted font-weight-bold">
                                        <i class="fas fa-sort-numeric-up-alt mr-2"></i> Jumlah
                                    </div>
                                    <div class="col-md-8">
                                        <form action="<?= base_url('keranjang/tambah/' . $item['id_produk']); ?>"
                                            method="POST">
                                            <div class="input-group" style="max-width: 150px;">
                                                <input type="number" name="jumlah" id="jumlah"
                                                    class="form-control text-center" value="1" min="1"
                                                    style="border-radius: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            </div>
                                            <!-- Tombol Aksi -->
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary btn-mdshadow-sm"
                                                    style="border-radius: 30px;">
                                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Deskripsi Produk -->
                                    <div class="mb-2 mt-4">
                                        <h5 class="text-muted"><i class="fas fa-info-circle mr-2"></i> Deskripsi</h5>
                                        <p class="text-secondary" style="line-height: 1.8;">
                                            <?= nl2br(htmlspecialchars($item['keterangan_produk'])); ?>
                                        </p>
                                    </div>
                                </div>
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