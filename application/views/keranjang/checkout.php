<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <!-- Tampilkan Pesan Flashdata -->
            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
            <?php elseif ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <!-- Form Hidden untuk Payment -->
            <form id="payment-form" method="post" action="<?= base_url('Keranjang/finishPayment'); ?>">
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">
            </form>

            <!-- Checkout Card -->
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">CHECKOUT</h1>
                </div>
                <div class="card-body">
                    <?php if ($keranjang): ?>
                    <!-- Tabel Produk -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $no = 1;
                            foreach ($keranjang as $id_produk => $item): 
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td class="text-left font-weight-bold"><?= $item['nama_produk']; ?></td>
                                    <td><?= $item['jumlah']; ?></td>
                                    <td>Rp <?= number_format($item['harga_produk'], 0, ',', '.'); ?></td>
                                    <td class="text-success font-weight-bold">
                                        Rp <?= number_format($item['harga_produk'] * $item['jumlah'], 0, ',', '.'); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <th colspan="4" class="text-right">Total Pembayaran :</th>
                                    <th class="text-primary font-weight-bold">
                                        Rp <?= number_format($total_pembayaran, 0, ',', '.'); ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Tombol Bayar -->
                    <div class="text-center mt-4">
                        <button id="pay-button" class="btn btn-primary btn-md shadow-sm" style="border-radius: 30px;">
                            <i class="fas fa-credit-card mr-2"></i> Bayar Sekarang
                        </button>
                    </div>

                    <?php else: ?>
                    <!-- Keranjang Kosong -->
                    <div class="alert alert-warning text-center" role="alert">
                        <h4><i class="fas fa-shopping-basket mr-2"></i> Keranjang Anda Kosong</h4>
                        <p>Yuk, tambahkan produk sekarang!</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->