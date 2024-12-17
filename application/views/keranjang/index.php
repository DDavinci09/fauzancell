<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <?php if ($this->session->flashdata('message')): ?>
            <?= $this->session->flashdata('message'); ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">CART</h1>
                </div>
                <div class="card-body">
                    <?php if ($keranjang): ?>
                    <!-- Tabel Produk dalam Keranjang -->
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($keranjang as $id_produk => $item): ?>
                                <tr>
                                    <!-- Gambar Produk -->
                                    <td class="text-center">
                                        <img src="<?= base_url('assets/upload/produk/' . $item['image']); ?>"
                                            class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>

                                    <!-- Nama Produk -->
                                    <td class="font-weight-bold"><?= $item['nama_produk']; ?></td>

                                    <!-- Harga Produk -->
                                    <td class="text-success">Rp
                                        <?= number_format($item['harga_produk'], 0, ',', '.'); ?></td>

                                    <!-- Jumlah Produk -->
                                    <td>
                                        <form action="<?= base_url('keranjang/update_keranjang'); ?>" method="post"
                                            class="d-flex align-items-center">
                                            <input type="hidden" name="id_produk" value="<?= $id_produk; ?>">
                                            <input type="number" name="jumlah" value="<?= $item['jumlah']; ?>"
                                                class="form-control form-control-sm text-center mr-2"
                                                style="width: 70px; border-radius: 10px;" min="1">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>

                                    <!-- Total Harga Produk -->
                                    <td class="text-success font-weight-bold">
                                        Rp <?= number_format($item['harga_produk'] * $item['jumlah'], 0, ',', '.'); ?>
                                    </td>

                                    <!-- Aksi Hapus -->
                                    <td class="text-center">
                                        <a href="<?= base_url('keranjang/hapus_item/' . $id_produk); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Total Pembayaran -->
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <h4 class="text-muted mb-0">
                            <i class="fas fa-receipt mr-2"></i> Total Pembayaran:
                        </h4>
                        <h3 class="text-success font-weight-bold mb-0">
                            Rp <?= number_format($total_pembayaran, 0, ',', '.'); ?>
                        </h3>
                    </div>

                    <!-- Tombol Checkout -->
                    <div class="text-right mt-4">
                        <a href="<?= base_url('Keranjang/checkout'); ?>" class="btn btn-success btn-md shadow-sm"
                            style="border-radius: 25px;">
                            <i class="fas fa-credit-card mr-2"></i> Checkout
                        </a>
                    </div>
                    <?php else: ?>
                    <!-- Keranjang Kosong -->
                    <div class="alert alert-warning text-center" role="alert">
                        <h4><i class="fas fa-shopping-basket mr-2"></i> Keranjang Anda Kosong</h4>
                        <p>Yuk, tambah produk ke keranjang sekarang!</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.content-wrapper -->