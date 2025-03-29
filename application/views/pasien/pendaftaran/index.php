<!DOCTYPE html>
<html lang="en">

<body class="">
    <!-- Loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- Loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page rtl-page">
            <!-- Halaman Content -->
            <?= $this->session->flashdata('pesan') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between mb-4">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6 text-right">
                                        <a href="<?= base_url('pasien/pendaftaran/add') ?>" class="btn btn-sm btn-primary">Daftar</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pasien</th>
                                                <th>Jadwal (Hari)</th>
                                                <th>Jenis Perawatan</th>
                                                <th>Nama Perawat</th>
                                                <th>Status Pendaftaran</th>
                                                <th>Tanggal Pendaftaran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($pendaftaran as $val): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $val->nm_pasien ?></td>
                                                    <td><?= $val->hari ?>, <?= $val->mulai ?>-<?= $val->selesai ?></td>
                                                    <td><?= $val->jenis_perawatan ?></td>
                                                    <td><?= $val->nm_karyawan ?></td>
                                                    <td>
                                                        <?php if($val->status == 'Proses'): ?>
                                                            <span class="badge bg-warning">Sedang di Proses</span>
                                                        <?php elseif($val->status == 'Disetujui'): ?>
                                                            <span class="badge bg-primary">Terverifikasi</span>
                                                        <?php endif; ?>    
                                                    </td>
                                                    <td><?= do_formal_date($val->tgl_pendaftaran) ?></td>
                                                    <td>
                                                        <?php if($val->status == 'Proses'): ?>
                                                            <a href="<?= base_url('pasien/pendaftaran/edit/') . $val->id_pendaftaran ?>" class="btn btn-primary btn-sm">Edit</a>
                                                        <?php endif; ?>
                                                            <a href="<?= base_url('pasien/pendaftaran/delete/') . $val->id_pendaftaran ?>" class="btn btn-danger btn-sm hapus">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.hapus').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
            var url = this.getAttribute('href'); // Ambil URL dari atribut href

            Swal.fire({
                title: "Hapus Data?",
                text: "Data yang sudah dihapus tidak dapat dipulihkan kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, redirect ke URL penghapusan
                    window.location.href = url;
                }
            });
        });
    });
    </script>
</body>

</html>
