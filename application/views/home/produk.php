<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1>PRODUK</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Gambar Produk -->
                        <div class="col-md-6">
                            <img src="<?= base_url('assets/upload/produk/' . $item['image']); ?>" class="img-fluid"
                                alt="<?= $item['nama_produk']; ?>" style="object-fit: cover; height: 400px;">
                        </div>

                        <!-- Detail Produk -->
                        <div class="col-md-6">
                            <h2 class="font-weight-bold"><?= $item['nama_produk']; ?></h2>
                            <p class="text-success font-weight-bold mb-2">
                                Rp <?= number_format($item['harga_produk'], 0, ',', '.'); ?>
                            </p>

                            <!-- Deskripsi Produk -->
                            <p class="text-muted"><?= $item['keterangan_produk']; ?></p>

                            <!-- Stok Produk -->
                            <p class="text-muted">
                                Stok: <span class="<?= $item['stok_produk'] > 0 ? 'text-success' : 'text-danger'; ?>">
                                    <?= $item['stok_produk'] > 0 ? $item['stok_produk'] : 'Habis'; ?>
                                </span>
                            </p>

                            <!-- Tombol Aksi -->
                            <form action="<?= base_url('keranjang/tambah/' . $item['id_produk']); ?>" method="POST">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="1"
                                        min="1">
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->