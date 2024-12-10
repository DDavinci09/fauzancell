<div class="container mt-5">
    <h2>Keranjang Belanja</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($keranjang): ?>
            <?php foreach ($keranjang as $item): ?>
            <tr>
                <td><img src="<?= base_url('assets/upload/produk/' . $item['image']); ?>" width="100"
                        alt="<?= $item['nama_produk']; ?>"></td>
                <td><?= $item['nama_produk']; ?></td>
                <td>Rp <?= number_format($item['harga_produk'], 0, ',', '.'); ?></td>
                <td><?= $item['jumlah']; ?></td>
                <td>Rp <?= number_format($item['harga_produk'] * $item['jumlah'], 0, ',', '.'); ?></td>
                <td>
                    <a href="<?= base_url('keranjang/hapus/' . $item['id_produk']); ?>"
                        class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Keranjang Kosong</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-right">
        <a href="<?= base_url('checkout'); ?>" class="btn btn-success">Checkout</a>
    </div>
</div>