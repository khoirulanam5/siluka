  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  <script src="<?= base_url('/landing/front/js/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/popper.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/jquery.easing.1.3.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/jquery.waypoints.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/jquery.stellar.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/owl.carousel.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/jquery.magnific-popup.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/aos.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/jquery.animateNumber.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/bootstrap-datepicker.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/jquery.timepicker.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/scrollax.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/google-map.js'); ?>"></script>
  <script src="<?= base_url('/landing/front/js/main.js'); ?>"></script> 
  <!-- jQuery dan DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(disaring dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        }
    });
});
</script>
 
  </body>
</html>