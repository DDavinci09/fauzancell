<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><?= $title; ?></h1>
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahProduk">Tambah Data</a>
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
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Rating</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($produk as $pd): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $pd['nama_produk'] ?></td>
                                    <td><?= $pd['harga_produk'] ?></td>
                                    <td><?= $pd['stok_produk'] ?></td>
                                    <td><?= $pd['rating_produk'] ?></td>
                                    <td>
                                        <img src="<?= base_url('assets/upload/produk/') ?><?= $pd['image'] ?>"
                                            href="<?= base_url('./assets/upload/produk/') . $pd['image']; ?>"
                                            alt="Gambar Produk" style="width: 100px; height: 100px;"
                                            data-toggle="lightbox">
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editProduk<?= $pd['id_produk'] ?>"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#hapusProduk<?= $pd['id_produk'] ?>"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal tambah produk-->
<div class="modal fade" id="tambahProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/tambah_produk'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk :</label>
                                <input type="text" name="nama_produk" class="form-control" id="nama_produk"
                                    value="<?= set_value('nama_produk'); ?>" placeholder="Masukkan nama produk"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="harga_produk">Harga Produk :</label>
                                <input type="number" name="harga_produk" class="form-control" id="harga_produk"
                                    value="<?= set_value('harga_produk'); ?>" placeholder="Masukkan harga produk"
                                    required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="diskon_produk">Diskon Produk :</label>
                                <input type="text" name="diskon_produk" class="form-control" id="diskon_produk"
                                    value="<?= set_value('diskon_produk'); ?>" placeholder="Masukkan diskon produk"
                                    required>
                            </div> -->
                            <div class="form-group">
                                <label for="stok_produk">Stok Produk :</label>
                                <input type="number" name="stok_produk" class="form-control" id="stok_produk"
                                    value="<?= set_value('stok_produk'); ?>" placeholder="Masukkan stok produk"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kategori">Kategori Produk :</label>
                                <select name="id_kategori" class="form-control" id="id_kategori">
                                    <option value="">-- Pilih kategori produk --</option>
                                    <?php foreach ($kategori as $kt): ?>
                                    <option value="<?= $kt['id_kategori'] ?>">
                                        <?= $kt['nama_kategori'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    value="<?= set_value('image'); ?>" placeholder="Masukkan nama kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan_produk">Keterangan Produk :</label>
                                <textarea name="keterangan_produk" class="form-control" id="keterangan_produk" rows="3"
                                    placeholder="Masukkan keterangan produk"
                                    required><?= set_value('keterangan_produk'); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($produk as $pd): ?>

<!-- Modal edit produk-->
<div class="modal fade" id="editProduk<?= $pd['id_produk'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/edit_produk/'); ?><?= $pd['id_produk'] ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk :</label>
                                <input type="text" name="nama_produk" class="form-control" id="nama_produk"
                                    value="<?= $pd['nama_produk'] ?>" placeholder="Masukkan nama produk" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_produk">Harga Produk :</label>
                                <input type="number" name="harga_produk" class="form-control" id="harga_produk"
                                    value="<?= $pd['harga_produk'] ?>" placeholder="Masukkan harga produk" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="diskon_produk">Diskon Produk :</label>
                                <input type="text" name="diskon_produk" class="form-control" id="diskon_produk"
                                    value="<?= set_value('diskon_produk'); ?>" placeholder="Masukkan diskon produk"
                                    required>
                            </div> -->
                            <div class="form-group">
                                <label for="stok_produk">Stok Produk :</label>
                                <input type="number" name="stok_produk" class="form-control" id="stok_produk"
                                    value="<?= $pd['stok_produk'] ?>" placeholder="Masukkan stok produk" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kategori">Kategori Produk :</label>
                                <select name="id_kategori" class="form-control" id="id_kategori">
                                    <option value="">-- Pilih kategori produk --</option>
                                    <?php foreach ($kategori as $kt): ?>
                                    <option value="<?= $kt['id_kategori']; ?>"
                                        <?= $kt['id_kategori'] == $pd['id_kategori'] ? 'selected' : ''; ?>>
                                        <?= $kt['nama_kategori']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    value="<?= $pd['image'] ?>">
                                <!-- Menampilkan nama file sebelumnya -->
                                <small class="text-muted"><b>File saat ini : </b> <?= $pd['image'] ?></small>
                            </div>
                            <div class="form-group">
                                <label for="keterangan_produk">Keterangan Produk :</label>
                                <textarea name="keterangan_produk" class="form-control" id="keterangan_produk" rows="3"
                                    placeholder="Masukkan keterangan produk"
                                    required><?= $pd['keterangan_produk'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-warning" type="submit">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal hapus produk-->
<div class="modal fade" id="hapusProduk<?= $pd['id_produk'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Produk?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus produk ini? <b><?= $pd['nama_produk'] ?></b>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="<?= base_url(); ?>Admin/hapus_produk/<?= $pd['id_produk'] ?>">Hapus</a>
            </div>
        </div>
    </div>
</div>


<?php endforeach; ?>