<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><?= $title; ?></h1>
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahKategori">Tambah Data</a>
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
                                    <th>Nama Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($kategori as $kt): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $kt['nama_kategori'] ?></td>
                                    <td><?= $kt['keterangan_kategori'] ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editKategori<?= $kt['id_kategori'] ?>"><i
                                                class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#hapusKategori<?= $kt['id_kategori'] ?>"><i
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

<!-- Modal tambah kategori-->
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/tambah_kategori'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori :</label>
                        <input type="text" name="nama_kategori" class="form-control" id="nama_kategori"
                            value="<?= set_value('nama_kategori'); ?>" placeholder="Masukkan nama kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_kategori">Keterangan :</label>
                        <textarea name="keterangan_kategori" class="form-control" id="keterangan_kategori" rows="3"
                            placeholder="Masukkan keterangan kategori"
                            required><?= set_value('keterangan_kategori'); ?></textarea>
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

<?php foreach ($kategori as $kt): ?>

<!-- Modal edit kategori-->
<div class="modal fade" id="editKategori<?= $kt['id_kategori'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/edit_kategori/'); ?><?= $kt['id_kategori'] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori :</label>
                        <input type="text" name="nama_kategori" class="form-control" id="nama_kategori"
                            value="<?= $kt['nama_kategori'] ?>" placeholder="Masukkan nama kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_kategori">Keterangan :</label>
                        <textarea name="keterangan_kategori" class="form-control" id="keterangan_kategori" rows="3"
                            placeholder="Masukkan keterangan kategori"
                            required><?= $kt['keterangan_kategori'] ?></textarea>
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

<!-- Modal hapus kategori-->
<div class="modal fade" id="hapusKategori<?= $kt['id_kategori'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus kategori ini?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger"
                    href="<?= base_url(); ?>Admin/hapus_kategori/<?= $kt['id_kategori'] ?>">Hapus</a>
            </div>
        </div>
    </div>
</div>


<?php endforeach; ?>