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
                                <form action="<?= base_url('pasien/pendaftaran/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Pilih Jadwal:</label>
                                        <select name="id_jadwal" class="form-control" required>
                                            <option value="">Pilih Jadwal</option>
                                            <?php foreach($pendaftaran as $val): ?>
                                                <option value="<?= $val->id_jadwal ?>"><?= $val->nm_karyawan ?>, <?= $val->hari ?> <?= $val->mulai ?>-<?= $val->selesai ?> (<?= $val->jenis_perawatan ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('id_jadwal', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Daftar</button>
                                    <a href="<?= base_url('pasien/pendaftaran') ?>" class="btn btn-sm btn-secondary">Kembali</a>
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
