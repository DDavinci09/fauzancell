<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><?= $title; ?></h1>
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
                    <div class="row">
                        <!-- Data Total Pesanan -->
                        <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>Rp.<?= number_format($profit, 0, ',', '.'); ?></h3>
                                    <p>Total Pendapatan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-check"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="row">
                        <!-- Data User -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= count($users); ?></h3>
                                    <p>Total Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- Data Kategori -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= count($kategori); ?></h3>
                                    <p>Total Kategori</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- Data Produk -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?= count($produk); ?></h3>
                                    <p>Total Produk</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- Data Total Pesanan -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= count($orders); ?></h3>
                                    <p>Total Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-truck-loading"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->