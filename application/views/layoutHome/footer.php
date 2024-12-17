<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Keluar Sekarang?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda ingin meninggalkan sesi ini? Klik "Logout" untuk keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="<?= base_url(); ?>Auth/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer bg-dark text-white">
    <div class="container">
        <div class="row">
            <!-- Kolom 1: Informasi Perusahaan -->
            <div class="col-md-4">
                <h5 class="text-uppercase">Tentang Kami</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus cursus purus id nisl dignissim, et
                    malesuada orci tristique.</p>
            </div>

            <!-- Kolom 2: Informasi Kontak -->
            <div class="col-md-4">
                <h5 class="text-uppercase">Kontak</h5>
                <ul class="list-unstyled">
                    <li>Email: support@ecommerce.com</li>
                    <li>Telepon: +62 123 456 7890</li>
                    <li>Alamat: Jl. Contoh Alamat No. 123, Jakarta</li>
                </ul>
            </div>

            <!-- Kolom 3: Metode Pembayaran -->
            <div class="col-md-4">
                <h5 class="text-uppercase">Metode Pembayaran</h5>
                <p>Kami menerima berbagai metode pembayaran aman, termasuk:</p>
                <ul class="list-unstyled">
                    <li><img src="https://example.com/images/payment/midtrans-logo.png" alt="Midtrans Payment"
                            class="img-fluid" style="width: 150px;"></li>
                    <li>~ Transfer Bank</li>
                    <li>~ Credit/Debit Card</li>
                    <li>~ e-Wallet (OVO, Dana, GoPay, dll)</li>
                </ul>
            </div>
        </div>

        <!-- Hak Cipta -->
        <div class="row mt-4">
            <div class="col text-center">
                &copy; 2024 FauzanCell.
            </div>
        </div>
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(function() {
    $('#example1').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "paging": true, // Mengaktifkan pagination
        "searching": true, // Mengaktifkan pencarian
        "ordering": false, // Mengaktifkan pengurutan
        "info": true // Menampilkan informasi tabel
    });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
<!-- Payment -->
<script type="text/javascript">
document.getElementById('pay-button').onclick = function() {
    fetch('<?= base_url('payment/pay'); ?>')
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                snap.pay(data.token, {
                    onSuccess: function(result) {
                        alert("Pembayaran berhasil!");
                        console.log(result);
                        window.location.href =
                            "<?= base_url('payment/check_all_pending_payments'); ?>";
                    },
                    onPending: function(result) {
                        alert("Pembayaran Anda sedang diproses.");
                        console.log(result);
                    },
                    onError: function(result) {
                        alert("Terjadi kesalahan saat memproses pembayaran.");
                        console.log(result);
                    },
                    onClose: function() {
                        alert("Anda menutup jendela pembayaran.");
                    }
                });
            } else {
                alert('Error: ' + data.error);
            }
        });
};
</script>
</body>

</html>