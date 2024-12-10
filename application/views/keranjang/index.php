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
                    <h1>SHOP</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                <?php foreach ($keranjang as $id_produk => $item): ?>
                                <tr>
                                    <td><img src="<?= base_url('assets/upload/produk/' . $item['image']); ?>"
                                            width="100" alt="<?= $item['nama_produk']; ?>"></td>
                                    <td><?= $item['nama_produk']; ?></td>
                                    <td>Rp <?= number_format($item['harga_produk'], 0, ',', '.'); ?></td>
                                    <td>
                                        <form action="<?= base_url('keranjang/update_keranjang'); ?>" method="post"
                                            class="d-inline">
                                            <input type="hidden" name="id_produk" value="<?= $id_produk; ?>">
                                            <input type="number" name="jumlah" value="<?= $item['jumlah']; ?>"
                                                class="form-control form-control-sm" min="1"
                                                style="width: 80px; display: inline-block;">
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                    </td>
                                    <td>Rp <?= number_format($item['harga_produk'] * $item['jumlah'], 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('keranjang/hapus_item/' . $id_produk); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')">
                                            Hapus
                                        </a>
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
                        <div class="text-right mt-3">
                            <h5>Total Pembayaran :
                                <span class="text-success">
                                    Rp <?= number_format($total_pembayaran, 0, ',', '.'); ?>
                                </span>
                            </h5>
                        </div>
                        <div class="text-right">
                            <a href="<?= base_url('Keranjang/checkout'); ?>" class="btn btn-success">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->