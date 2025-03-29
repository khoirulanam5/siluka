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
                                <form action="<?= base_url('admin/pasien/edit/' . $user->id_user) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                    <input type="hidden" name="id_pasien" value="<?= $user->id_pasien ?>">
                                    <div class="form-group">
                                        <label>NIK:</label>
                                        <input type="number" name="nik" value="<?= $user->nik ?>" class="form-control" placeholder="Masukan NIK" required readonly>
                                        <?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama:</label>
                                        <input type="text" name="nm_pasien" value="<?= $user->nm_pasien ?>" class="form-control" placeholder="Masukan nama" required>
                                        <?= form_error('nm_pasien', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Umur:</label>
                                        <input type="number" name="umur" value="<?= $user->umur ?>" class="form-control" placeholder="Masukan umur" required>
                                        <?= form_error('umur', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin:</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Pria" <?= $user->jenis_kelamin == 'Pria' ? 'selected' : '' ?>>Pria</option>
                                            <option value="Wanita" <?= $user->jenis_kelamin == 'Wanita' ? 'selected' : '' ?>>Wanita</option>
                                        </select>
                                        <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP:</label>
                                        <input type="number" name="no_hp" value="<?= $user->no_hp ?>" class="form-control" placeholder="Masukkan nomor HP" required>
                                        <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" value="<?= $user->email ?>" class="form-control" placeholder="Masukkan username" required readonly>
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required><?= $user->alamat ?></textarea>
                                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" name="username" value="<?= $user->username ?>" class="form-control" placeholder="Masukkan username" required readonly>
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" value="<?= $user->password ?>" class="form-control" placeholder="Masukkan password" required>
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('pemilik/karyawan') ?>" class="btn btn-sm btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>