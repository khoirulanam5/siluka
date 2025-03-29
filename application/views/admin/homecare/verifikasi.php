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
                    <div class="col-sm-12 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('admin/homecare/verifikasi/'.$id_homecare) ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nama Perawat:</label>
                                        <select name="id_karyawan" class="form-control" required>
                                            <option value="">Pilih Perawat</option>
                                            <?php foreach($perawat as $val): ?>
                                                <option value="<?= $val->id_karyawan ?>"><?= $val->username ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('id_karyawan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/homecare') ?>" class="btn btn-sm btn-secondary">Kembali</a>
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
