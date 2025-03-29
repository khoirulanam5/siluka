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
                                <form action="<?= base_url('pemilik/karyawan/add') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nama Lengkap:</label>
                                        <input type="text" name="nm_karyawan" class="form-control" placeholder="Masukan nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Telp:</label>
                                        <input type="number" name="no_hp" class="form-control" placeholder="Masukan nomer HP" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" class="form-control" placeholder="Masukan email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <input type="text" name="alamat" class="form-control" placeholder="Masukan alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" name="username" class="form-control" placeholder="Masukan username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan:</label>
                                        <select name="jabatan" class="form-control" required>
                                            <option value="">Pilih Jabatan</option>
                                            <option value="Pemilik">Pemilik</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Perawat">Perawat</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('pemilik/karyawan') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
