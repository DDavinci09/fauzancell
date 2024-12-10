<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">

    <!-- Main content -->
    <div class="content">
        <!-- Tampilkan pesan jika ada -->
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
        <?php elseif ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>
        <div class="container">
            <?php if ($this->session->flashdata('message')): ?>
            <?= $this->session->flashdata('message'); ?>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h1>CHECKOUT</h1>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('Keranjang/processCheckout') ?>" method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
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
                                        <td><?= $item['jumlah']; ?></td>
                                        <td>Rp
                                            <?= number_format($item['harga_produk'] * $item['jumlah'], 0, ',', '.'); ?>
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
                            <h2>Metode Pembayaran</h2>
                            <?php foreach ($payment_methods as $method): ?>
                            <label>
                                <input type="radio" name="payment_method" value="<?= $method; ?>" required>
                                <?= $method; ?>
                            </label><br>
                            <?php endforeach; ?>
                            <div class="text-right">
                                <button id="pay-button" type="submit">Proses Checkout</button>
                            </div>
                        </div>
                    </form>
                    <!-- Tombol Checkout -->
                    <button class="btn btn-success" data-toggle="modal" data-target="#paymentModal">Pilih Metode
                        Pembayaran</button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Your_Client_Key"></script>
<script>
var payButton = document.getElementById('pay-button');
payButton.addEventListener('click', function() {
    snap.pay('<?= $snapToken; ?>', {
        onSuccess: function(result) {
            console.log(result);
            // Redirect ke halaman sukses
            window.location.href = "<?= base_url('payment/success'); ?>";
        },
        onPending: function(result) {
            console.log(result);
            // Redirect ke halaman menunggu pembayaran
            window.location.href = "<?= base_url('payment/pending'); ?>";
        },
        onError: function(result) {
            console.log(result);
            // Redirect ke halaman gagal
            window.location.href = "<?= base_url('payment/error'); ?>";
        }
    });
});
</script>


<!-- Modal Metode Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Keranjang/processCheckout'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Pilih Metode Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="payment_method">Metode Pembayaran:</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="">Pilih Metode</option>
                            <option value="COD">Cash on Delivery (COD)</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>