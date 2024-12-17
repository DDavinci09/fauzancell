<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-2">

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">RECENT PRODUCT</h1>
                </div>
                <div class="card-body">
                    <?php if (!empty($recent_products)): ?>
                    <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($recent_products as $product): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <img src="<?= base_url('assets/upload/produk/') ?><?= $product['image'] ?>"
                                        href="<?= base_url('./assets/upload/produk/') . $product['image']; ?>"
                                        alt="Gambar Produk" style="width: 100px; height: 100px;" data-toggle="lightbox">
                                </td>
                                <td><?= $product['nama_produk']; ?></td>
                                <td><?= number_format($product['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary text-light"
                                        href="<?= base_url() ?>Home/produk/<?= $product['id_produk'] ?>">
                                        <i class="fas fa-eye"></i> See Produk
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p>Anda belum membeli produk apapun.</p>
                    <?php endif; ?>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->