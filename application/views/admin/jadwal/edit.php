<!DOCTYPE html>
<html lang="en">

<body class="  ">
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
                                <form action="<?= base_url('admin/jadwal/edit/' . $jadwal->id_jadwal) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_jadwal" value="<?= $jadwal->id_jadwal ?>">
                                    <div class="form-group">
                                        <label>Nama Perawat:</label>
                                        <select name="id_karyawan" class="form-control" required>
                                            <option value="">Pilih Perawat</option>
                                            <?php foreach ($perawat as $val): ?>
                                                <option value="<?= $val->id_karyawan ?>" 
                                                    <?= ($val->id_karyawan == $jadwal->id_karyawan) ? 'selected' : '' ?>>
                                                    <?= $val->username ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('id_karyawan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Hari:</label>
                                        <input type="text" name="hari" value="<?= $jadwal->hari ?>" class="form-control" placeholder="Masukan hari" required>
                                        <?= form_error('hari', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Mulai:</label>
                                        <input type="time" name="mulai" value="<?= $jadwal->mulai ?>" class="form-control" placeholder="Waktu mulai" required>
                                        <?= form_error('mulai', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Selesai:</label>
                                        <input type="time" name="selesai" value="<?= $jadwal->selesai ?>" class="form-control" placeholder="Waktu selesai" required>
                                        <?= form_error('selesai', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Perawatan:</label>
                                        <select name="jenis_perawatan" class="form-control" required>
                                            <option value="">Pilih Jenis Perawat</option>
                                            <option value="Klinik" <?= $jadwal->jenis_perawatan == 'Klinik' ? 'selected' : '' ?>>Klinik</option>
                                            <option value="Homecare" <?= $jadwal->jenis_perawatan == 'Homecare' ? 'selected' : '' ?>>Homecare</option>
                                        </select>
                                        <?= form_error('jenis_perawatan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-sm btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>