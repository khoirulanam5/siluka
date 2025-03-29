<!DOCTYPE html>
<html lang="en">

<body class="">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page rtl-page">
            <!-- Halaman content -->
            <?= $this->session->flashdata('pesan') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('pasien/homecare/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nama Luka:</label>
                                        <input type="text" name="nama_perawatan" class="form-control" required>
                                        <?= form_error('nama_perawatan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Kondisi Luka:</label>
                                        <input type="file" name="foto" class="form-control" required>
                                        <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Kunjungan:</label>
                                        <input type="date" name="tgl_kunjungan" class="form-control" required>
                                        <?= form_error('tgl_kunjungan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Jam:</label>
                                        <input type="time" name="jam" class="form-control" required>
                                        <?= form_error('jam', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Kunjungan:</label>
                                        <textarea name="alamat_kunjungan" class="form-control" required></textarea>
                                        <?= form_error('alamat_kunjungan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('pasien/homecare') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
