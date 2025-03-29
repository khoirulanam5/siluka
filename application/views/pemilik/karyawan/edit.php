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
                                <form action="<?= base_url('pemilik/karyawan/edit/' . $user->id_user) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_user" value="<?= $user->id_user ?>">
                                    <input type="hidden" name="id_karyawan" value="<?= $user->id_karyawan ?>">
                                    <div class="form-group">
                                        <label>Nama:</label>
                                        <input type="text" name="nm_karyawan" value="<?= $user->nm_karyawan ?>" class="form-control" placeholder="Masukan nama" required>
                                        <?= form_error('nm_karyawan', '<small class="text-danger">', '</small>'); ?>
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
                                    <div class="form-group">
                                        <label>Jabatan:</label>
                                        <select name="jabatan" class="form-control" required>
                                            <option value="">-- Pilih Jabatan --</option>
                                            <option value="Pemilik" <?= $user->jabatan == 'Pemilik' ? 'selected' : '' ?>>Pemilik</option>
                                            <option value="Admin" <?= $user->jabatan == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="Perawat" <?= $user->jabatan == 'Perawat' ? 'selected' : '' ?>>Perawat</option>
                                        </select>
                                        <?= form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
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