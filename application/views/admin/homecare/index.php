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
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Homecare</th>
                                                <th>Nama Pasien</th>
                                                <th>Nama Perawat</th>
                                                <th>Nama Luka</th>
                                                <th>Kondisi Luka</th>
                                                <th>Hari, Tgl Kunjungan</th>
                                                <th>Jam</th>
                                                <th>Alamat</th>
                                                <th>Catatan</th>
                                                <th>Biaya</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($homecare as $val): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $val->id_homecare ?></td>
                                                    <td><?= $val->nm_pasien ?></td>
                                                    <td><?= $val->nm_karyawan ?></td>
                                                    <td><?= $val->nama_perawatan ?></td>
                                                    <td>
                                                        <?php if(!empty($val->foto)): ?>
                                                        <a href="<?= base_url('assets/luka/'.$val->foto) ?>" target="_blank">
                                                            <img src="<?= base_url('assets/luka/'.$val->foto) ?>" alt="" style="height: 50px; width: 50px; object-fit: cover;">
                                                        </a>
                                                        <?php else: ?>
                                                        <span>Tidak ada foto</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= do_formal_date($val->tgl_kunjungan) ?></td>
                                                    <td><?= $val->jam ?></td>
                                                    <td><?= $val->alamat_kunjungan ?></td>
                                                    <td><?= $val->catatan_kunjungan ?></td>
                                                    <td><?= $val->biaya_homecare ?></td>
                                                    <td>
                                                        <?php if($val->status == NULL): ?>   
                                                            <a href="<?= base_url('admin/homecare/verifikasi/'.$val->id_homecare) ?>" class="badge bg-warning">Belum Diverifikasi</a> 
                                                        <?php elseif($val->status == 'Terverifikasi'): ?>
                                                            <span class="badge bg-primary">Terverifikasi</span>
                                                        <?php elseif($val->status == 'Selesai'): ?>
                                                            <span class="badge bg-success">Perawatan Selesai</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/homecare/delete/') . $val->id_homecare ?>" class="btn btn-danger btn-sm hapus">Hapus</a>
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
