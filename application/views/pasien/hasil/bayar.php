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
                    <div class="col-sm-12 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('pasien/hasil/bayar/'.$id_pembayaran) ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>ID Pembayaran:</label>
                                        <input type="text" name="id_pembayaran" class="form-control" value="<?= $id_pembayaran ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Rekening Tujuan:</label>
                                        <input type="text" name="no_rek" class="form-control" value="BRI: 5942 0105 2210 531 A/N Vicky Priyani" readonly>
                                    </div>
                                    <div class="form-group">
    <label>Total Bayar:</label>
    <input type="text" name="total_bayar" class="form-control" 
           value="<?= $total->biaya_perawatan ?? $total->biaya_homecare ?? '0' ?>" readonly>
</div>

                                    <div class="form-group">
                                        <label>Pembayaran:</label>
                                        <input type="file" name="bayar" class="form-control" accept="image/*" required>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Bayar</button>
                                    <a href="<?= base_url('pasien/hasil') ?>" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
