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
          <!-- Dashboard Widgets -->
          <?php if($this->session->userdata('jabatan') !== 'Pasien'): ?>
            <div class="row">
               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-1">
                              <i class="fas fa-users"></i>
                           </span>
                           <div class="dash-count">
                               <div class="dash-title">Jumlah Pasien</div>
                              <div class="dash-counts">
                                  <p><?= $pasien ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-1">
                                <i class="fas fa-user"></i>
                           </span>
                           <div class="dash-count">
                               <div class="dash-title">Jumlah Karyawan</div>
                              <div class="dash-counts">
                                  <p><?= $karyawan ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-2">
                              <i class="fas fa-stethoscope"></i>
                           </span>
                           <div class="dash-count">
                              <div class="dash-title">Perawatan Klinik</div>
                              <div class="dash-counts">
                                 <p><?= $perawatan ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="dash-widget-header">
                           <span class="dash-widget-icon bg-3">
                              <i class="fas fa-first-aid"></i>
                           </span>
                           <div class="dash-count">
                              <div class="dash-title">Homecare</div>
                              <div class="dash-counts">
                                 <p><?= $homecare ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <!-- /Dashboard Widgets -->

            <!-- Welcome Message -->
            <div class="col-xl-12 col-sm-12 col-12">
               <div class="card">
                  <div class="card-body">
                     <?= $this->session->flashdata('pesan'); ?>
                     <center>
                        <h4 class="header-title">Selamat Datang <?= $this->session->userdata('username'); ?> di Sistem Rawat Luka Diabetes Pati (SILUKA)</h4>
                        <?php if ($this->session->userdata('jabatan') !== 'Pasien'): ?>
                           <p class="text-muted">Anda dapat melakukan pekerjaan anda sesuai dengan jabatan <?= $this->session->userdata('jabatan'); ?> </p>
                        <?php elseif ($this->session->userdata('jabatan') == 'Pasien'): ?>
                           <p class="text-muted">Jaga selalu pola makan hidup sehat ya! </p>
                        <?php endif; ?>
                        <img height="550px" src="<?= base_url('assets/images/login/dashboard.jpg'); ?>">
                     </center>
                  </div>
               </div>
            </div>
            <!-- /Welcome Message -->
        </div>
    </div>