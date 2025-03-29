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
                            <form action="<?= base_url('perawat/klinik/perawatan/' . $id_pendaftaran) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama Perawatan:</label>
                                    <input type="text" class="form-control" name="nm_perawatan" placeholder="Masukan nama perawatan" required>
                                    <?= form_error('nm_perawatan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Biaya Perawatan:</label>
                                    <input type="number" class="form-control" name="biaya_perawatan" placeholder="Masukan biaya perawatan" required>
                                    <?= form_error('biaya_perawatan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Catatan:</label>
                                    <textarea class="form-control" name="catatan" placeholder="Masukan catatan" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                <a href="<?= base_url('perawat/klinik') ?>" class="btn btn-sm btn-secondary">Kembali</a>
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
