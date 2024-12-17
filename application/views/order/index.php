<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><?= $title; ?></h1>
                    <a class="btn btn-success btn-sm" href="<?= base_url('payment/check_all_pending_payments') ?>"><i
                            class="fas fa-sync-alt"></i> Update</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('message')): ?>
            <div class="row">
                <div class="col text-center">
                    <h5><?= $this->session->flashdata('message'); ?></h5>
                </div>
            </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($orders)): ?>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped"
                            style="width: 100%;">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 40%;">Order</th>
                                    <th style="width: 55%;">Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($orders as $order): ?>
                                <tr>
                                    <!-- Kolom Order -->
                                    <td class="align-middle text-center"><?= $no++; ?></td>
                                    <td>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <strong>Pelanggan:</strong> <?= $order['nama']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Order ID:</strong> <?= $order['order_id']; ?> <a
                                                    class="btn btn-success btn-sm"
                                                    href="<?= base_url('admin/print_order/') ?><?= $order['id_order'] ?>"><i
                                                        class="fas fa-sync-alt"></i> Print</a>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Tanggal Order:</strong>
                                                <?= date('d-m-Y H:i', strtotime($order['tanggal_order'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Status Pembayaran:</strong>
                                                <?php if ($order['status_pembayaran'] == 'Lunas'): ?>
                                                <span class="badge badge-success">Lunas</span>
                                                (<?= $order['jenis_pembayaran']; ?>)
                                                <?php else: ?>
                                                <span
                                                    class="badge badge-warning"><?= $order['status_pembayaran']; ?></span>
                                                <?php endif; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Tanggal Pembayaran:</strong>
                                                <?php if ($order['tanggal_pembayaran'] != '0000-00-00 00:00:00' && !empty($order['tanggal_pembayaran'])): ?>
                                                <?= date('d-m-Y H:i', strtotime($order['tanggal_pembayaran'])); ?>
                                                <?php else: ?>
                                                <span class="text-muted">Belum dibayar</span>
                                                <?php endif; ?>
                                            </li>

                                            <li class="list-group-item">
                                                <strong>Status Pesanan:</strong>
                                                <a class="btn btn-sm 
                                                    <?= $order['status_pesanan'] == 'Diproses' ? 'btn-primary' : 
                                                        ($order['status_pesanan'] == 'Dikirim' ? 'btn-info' : 
                                                        ($order['status_pesanan'] == 'Selesai' ? 'btn-success' : 
                                                        ($order['status_pesanan'] == 'Dibatalkan' ? 'btn-danger' : 'btn-warning'))) ?>"
                                                    <?php if ($order['status_pesanan'] == 'Diproses' || $order['status_pesanan'] == 'Dikirim'): ?>
                                                    data-toggle="modal"
                                                    data-target="#status-pesanan<?= $order['id_order'] ?>"
                                                    <?php else: ?> style="pointer-events: none; opacity: 0.7;"
                                                    <?php endif; ?>>
                                                    <i
                                                        class="fas 
                                                    <?= $order['status_pesanan'] == 'Diproses' ? 'fa-spinner' : 
                                                        ($order['status_pesanan'] == 'Dikirim' ? 'fa-truck' : 
                                                        ($order['status_pesanan'] == 'Selesai' ? 'fa-check-circle' : 
                                                        ($order['status_pesanan'] == 'Dibatalkan' ? 'fa-times-circle' : 'fa-exclamation-triangle'))) ?>">
                                                    </i>
                                                    <?= $order['status_pesanan'] ?>
                                                </a>
                                            </li>

                                            <?php if ($order['status_pesanan'] == "Selesai" && $order['tanggal_diterima'] != '0000-00-00 00:00:00') { ?>
                                            <li class="list-group-item">
                                                <strong>Tanggal Diterima:</strong>
                                                <?= date('d-m-Y H:i', strtotime($order['tanggal_diterima'])); ?>
                                            </li>
                                            <?php } ?>
                                            <?php if (!empty($order['keterangan'])) { ?>
                                            <li class="list-group-item">
                                                <strong>Keterangan:</strong>
                                                <p class="text-bold"
                                                    style="color: 
                                                    <?= $order['status_pesanan'] == 'Diproses' ? 'blue' : 
                                                    ($order['status_pesanan'] == 'Dikirim' ? 'green' : 
                                                    ($order['status_pesanan'] == 'Selesai' ? 'darkgreen' : 
                                                    ($order['status_pesanan'] == 'Dibatalkan' ? 'red' : 'black'))) ?>;">
                                                    <?= htmlspecialchars($order['keterangan'], ENT_QUOTES, 'UTF-8') ?>
                                                </p>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </td>


                                    <!-- Kolom Produk -->
                                    <td>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <thead class="thead-light text-center">
                                                    <tr>
                                                        <th style="width: 5%;">No</th>
                                                        <th>Nama Produk</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no_produk = 1; foreach ($order['items'] as $item): ?>
                                                    <tr>
                                                        <td class="align-middle text-center"><?= $no_produk++; ?></td>
                                                        <td><?= $item['nama_produk']; ?></td>
                                                        <td class="text-center"><?= $item['jumlah']; ?></td>
                                                        <td class="text-right">Rp
                                                            <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                                        <td class="text-right">Rp
                                                            <?= number_format($item['jumlah'] * $item['harga'], 0, ',', '.'); ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4" class="text-right">Total Pembayaran</th>
                                                        <th class="text-right">Rp
                                                            <?= number_format($order['total_harga'], 0, ',', '.'); ?></span>
                                                    </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info text-center">
                        Anda belum memiliki pesanan.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php foreach ($orders as $order): ?>
<!-- Modal Edit Status Pesanan -->
<div class="modal fade" id="status-pesanan<?= $order['id_order'] ?>">
    <div class="modal-dialog dialog-center">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Status Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('Admin/editStatusPesanan'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="hidden" name="id_order" value="<?= $order['id_order'] ?>">
                            <label for="status_bayar">Status Pesanan</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control" id="status_pesanan" name="status_pesanan">
                                        <option value="Diproses"
                                            <?= $order['status_pesanan'] == 'Diproses' ? 'selected' : ''; ?>>Diproses
                                        </option>
                                        <option value="Dikirim"
                                            <?= $order['status_pesanan'] == 'Dikirim' ? 'selected' : ''; ?>>Dikirim
                                        </option>
                                        <option value="Selesai"
                                            <?= $order['status_pesanan'] == 'Selesai' ? 'selected' : ''; ?>>Selesai
                                        </option>
                                        <option value="Dibatalkan"
                                            <?= $order['status_pesanan'] == 'Dibatalkan' ? 'selected' : ''; ?>>
                                            Dibatalkan
                                        </option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-money-check"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan  -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"
                                    placeholder="Masukkan keterangan"><?= $order['keterangan'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endforeach; ?>