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
                                <form action="<?= base_url('admin/pasien/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>NIK:</label>
                                        <input type="number" name="nik" class="form-control" placeholder="Masukkan NIK" required>
                                        <?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pasien:</label>
                                        <input type="text" name="nm_pasien" class="form-control" placeholder="Masukkan Nama Pasien" required>
                                        <?= form_error('nm_pasien', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Umur:</label>
                                        <input type="number" name="umur" class="form-control" placeholder="Masukkan Umur" required>
                                        <?= form_error('umur', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                        <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>No. HP:</label>
                                        <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No. HP" required>
                                        <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat" required></textarea>
                                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/pasien') ?>" class="btn btn-sm btn-secondary">Kembali</a>
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
