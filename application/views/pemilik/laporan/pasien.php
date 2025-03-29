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
                                    <div class="col-md-6 text-left">
                                        <a href="<?= base_url('pemilik/laporan/cetakpasien') ?>" target="_blank" class="btn btn-sm btn-success">Cetak</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pasien</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>Umur</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No. Telp</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($pasien as $val): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $val->id_pasien ?></td>
                                                    <td><?= $val->nm_pasien ?></td>
                                                    <td><?= $val->nik ?></td>
                                                    <td><?= $val->umur ?></td>
                                                    <td><?= $val->jenis_kelamin ?></td>
                                                    <td><?= $val->no_hp ?></td>
                                                    <td><?= $val->email ?></td>
                                                    <td><?= $val->alamat ?></td>
                                                    <td><?= $val->username ?></td>
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
</body>

</html>
