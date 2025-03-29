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
                                        <a href="<?= base_url('pasien/pembayaran') ?>" class="btn btn-sm btn-primary">Riwayat Pembayaran Klinik</a>
                                        <a href="<?= base_url('pasien/pembayaran/homecare') ?>" class="btn btn-sm btn-primary">Riwayat Pembayaran Homecare</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pasien</th>
                                                <th>ID Pembayaran</th>
                                                <th>ID Perawatan</th>
                                                <th>Total Bayar</th>
                                                <th>bayar</th>
                                                <th>Tanggal Bayar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($pembayaran as $val): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $val->nm_pasien ?></td>
                                                    <td><?= $val->id_pembayaran ?></td>
                                                    <td><?= $val->id_perawatan ?></td>
                                                    <td><?= $val->biaya_perawatan ?></td>
                                                    <td>
                                                        <?php if(!empty($val->bayar)): ?>
                                                        <a href="<?= base_url('assets/bayar/'.$val->bayar) ?>" target="_blank">
                                                            <img src="<?= base_url('assets/bayar/'.$val->bayar) ?>" alt="" style="height: 50px; width: 50px; object-fit: cover;">
                                                        </a>
                                                        <?php else: ?>
                                                        <span>Belum Bayar</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= do_formal_date($val->tgl_bayar) ?></td>
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
