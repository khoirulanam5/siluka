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
                                        <a href="<?= base_url('perawat/hasil') ?>" class="btn btn-sm btn-primary">Riwayat Perawatan Klinik</a>
                                        <a href="<?= base_url('perawat/hasil/homecare') ?>" class="btn btn-sm btn-primary">Riwayat Perawatan Homecare</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pasien</th>
                                                <th>Nama Pasien</th>
                                                <th>Nama Perawatan</th>
                                                <th>Kondisi Luka</th>
                                                <th>Tanggal Kunjungan</th>
                                                <th>Jam</th>
                                                <th>Alamat</th>
                                                <th>Catatan</th>
                                                <th>Status</th>
                                                <th>Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($hasil as $val): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $val->id_pasien ?></td>
                                                    <td><?= $val->nm_pasien ?></td>
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
                                                    <td><?= $val->status ?></td>
                                                    <td>
                                                        <?php if($val->bayar == NULL): ?>
                                                            <span class="badge bg-warning">Belum Bayar</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-primary">Lunas</span>
                                                        <?php endif; ?>
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
</body>

</html>
