<div class="hero-wrap" style="background-image: url('<?= base_url('/landing/front/images/') ?>ruangan.jpeg ');" data-stellar-background-ratio="0.5">
    <div class="overlay">
  </div>
    <div class="container">
      <div class="row no-gutters  justify-content-start align-items-center" style="padding-top: 100px;">
        <div class="col-lg-12 col-md-12">
        <?= $this->session->flashdata('pesan') ?>
          <div class="row">
            <div class="col-md-3" style="background-color: #0C2F91;padding: 20px;">
              <div class="d-flex flex-md-column list-group" id="list-tab" role="tablist">
                <a class="list-group-item active" id="list-ticket-list" data-toggle="list" href="#list-ticket" role="tab" aria-controls="ticket" aria-selected="false">
                  <i class="fas fa-ticket-alt"></i>
                  <span style="font-size:14px;">Feedback</span>
                </a>
              </div>
            </div>
            <div class="col-md-9" style="background-color: #fff;padding: 20px;">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade bordered show active" id="list-ticket" role="tabpanel" aria-labelledby="list-ticket-list">
                <form method="GET" action="<?= base_url('front/saran') ?>">
                      <div class="d-md-flex mt-2">
                          <div class="form-group col-12 col-md-12">
                              <label for="username" class="label">Masukan Username</label>
                              <input type="text" class="form-control" name="username" id="username" placeholder="Masukan username untuk melihat riwayat feedback dari pasien">
                          </div>
                      </div>
                      <div class="d-md-flex">
                          <div class="form-group col-12 col-md-12" style="text-align: right;">
                              <button type="submit" class="btn btn-info py-3 px-4">
                                  <i class="fas fa-search"></i> Cek Feedback
                              </button>
                          </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- endcontent -->

<section class="ftco-section services-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
        <span class="subheading">Layanan</span>
        <h2 class="mb-2">Layanan Kami</h2>
      </div>
    </div>
    <div class="row d-flex">
      <!-- Perawatan Luka -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services">
          <div class="media-body py-md-4">
            <div class="d-flex mb-3 align-items-center">
              <div class="icon">
                <i class="fas fa-first-aid" style="font-size: 2.5rem; color: #4CAF50;"></i>
              </div>
              <h3 class="heading mb-0 pl-3">Perawatan Luka</h3>
            </div>
            <p>Penanganan luka diabetes, pasca operasi, dan luka bakar dengan metode terkini.</p>
          </div>
        </div>      
      </div>
      <!-- Konsultasi Medis -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services">
          <div class="media-body py-md-4">
            <div class="d-flex mb-3 align-items-center">
              <div class="icon">
                <i class="fas fa-stethoscope" style="font-size: 2.5rem; color: #2196F3;"></i>
              </div>
              <h3 class="heading mb-0 pl-3">Konsultasi Medis</h3>
            </div>
            <p>Dapatkan saran medis dari ahli kami untuk solusi perawatan terbaik.</p>
          </div>
        </div>      
      </div>
      <!-- Home Care -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services">
          <div class="media-body py-md-4">
            <div class="d-flex mb-3 align-items-center">
              <div class="icon">
                <i class="fas fa-home" style="font-size: 2.5rem; color: #FFC107;"></i>
              </div>
              <h3 class="heading mb-0 pl-3">Home Care</h3>
            </div>
            <p>Perawatan luka langsung di rumah pasien dengan layanan profesional.</p>
          </div>
        </div>      
      </div>
      <!-- Layanan Darurat -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services">
          <div class="media-body py-md-4">
            <div class="d-flex mb-3 align-items-center">
              <div class="icon">
                <i class="fas fa-ambulance" style="font-size: 2.5rem; color: #F44336;"></i>
              </div>
              <h3 class="heading mb-0 pl-3">Layanan Darurat 24/7</h3>
            </div>
            <p>Kami siap membantu kapan saja untuk kasus-kasus darurat.</p>
          </div>
        </div>      
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container-fluid px-4">
    <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
        <span class="subheading">Fasilitas</span>
        <h2 class="mb-2">Fasilitas Kami</h2>
      </div>
    </div>
    <div class="row">
      <!-- Ruang Perawatan Bersih -->
      <div class="col-md-3">
        <div class="car-wrap ftco-animate text-center" style="padding: 30px;">
          <div class="icon mb-4" style="font-size: 50px; color: #007bff;">
            <i class="fas fa-clinic-medical"></i>
          </div>
          <div class="text p-4">
            <h2 class="mb-0">Ruang Perawatan Bersih</h2>
          </div>
        </div>
      </div>
      <!-- Peralatan Medis Modern -->
      <div class="col-md-3">
        <div class="car-wrap ftco-animate text-center" style="padding: 30px;">
          <div class="icon mb-4" style="font-size: 50px; color: #007bff;">
            <i class="fas fa-stethoscope"></i>
          </div>
          <div class="text p-4">
            <h2 class="mb-0">Peralatan Medis Modern</h2>
          </div>
        </div>
      </div>
      <!-- Akses Wi-Fi Gratis -->
      <div class="col-md-3">
        <div class="car-wrap ftco-animate text-center" style="padding: 30px;">
          <div class="icon mb-4" style="font-size: 50px; color: #007bff;">
            <i class="fas fa-wifi"></i>
          </div>
          <div class="text p-4">
            <h2 class="mb-0">Akses Wi-Fi Gratis</h2>
          </div>
        </div>
      </div>
      <!-- Area Tunggu Nyaman -->
      <div class="col-md-3">
        <div class="car-wrap ftco-animate text-center" style="padding: 30px;">
          <div class="icon mb-4" style="font-size: 50px; color: #007bff;">
            <i class="fas fa-couch"></i>
          </div>
          <div class="text p-4">
            <h2 class="mb-0">Area Tunggu Nyaman</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section services-section img" style="background-image: url(<?= base_url('/landing/front/images/') ?>ruangan.jpeg);">
  <div class="overlay"></div>
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
        <span class="subheading">Pendaftaran</span>
        <h2 class="mb-3">Alur Pendaftaran Layanan</h2>
      </div>
    </div>
    <div class="row">
      <!-- Langkah 1: Pilih Layanan -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services services-2">
          <div class="media-body py-md-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <i class="fas fa-briefcase-medical fa-3x"></i>
            </div>
            <h3>Pilih Layanan</h3>
            <p>Pilih jenis layanan seperti perawatan luka diabetes, luka bakar, atau luka operasi.</p>
          </div>
        </div>
      </div>
      <!-- Langkah 2: Isi Form Pendaftaran -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services services-2">
          <div class="media-body py-md-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <i class="fas fa-file-alt fa-3x"></i>
            </div>
            <h3>Isi Form Pendaftaran</h3>
            <p>Masukkan data pasien seperti nama, usia, jenis kelamin, dan informasi kesehatan.</p>
          </div>
        </div>
      </div>
      <!-- Langkah 3: Pilih Jadwal -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services services-2">
          <div class="media-body py-md-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <i class="fas fa-calendar-alt fa-3x"></i>
            </div>
            <h3>Pilih Jadwal</h3>
            <p>Tentukan tanggal dan waktu konsultasi atau perawatan yang diinginkan.</p>
          </div>
        </div>
      </div>
      <!-- Langkah 4: Konfirmasi Pendaftaran -->
      <div class="col-md-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services services-2">
          <div class="media-body py-md-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <i class="fas fa-check-circle fa-3x"></i>
            </div>
            <h3>Konfirmasi Pendaftaran</h3>
            <p>Periksa kembali data yang telah diisi, lalu konfirmasi untuk menyelesaikan proses pendaftaran.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row no-gutters">
      <!-- Gambar -->
      <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url('/landing/front/images/') ?>ruangan.jpeg);">
      </div>
      <!-- Tentang Kami -->
      <div class="col-md-6 wrap-about py-md-5 ftco-animate">
        <div class="heading-section mb-5 pl-md-5">
          <span class="subheading">Tentang Kami</span>
          <h2 class="mb-4">Klinik Perawatan Luka Terpercaya</h2>
          <p>Klinik Rawat Luka Diabetes Pati hadir untuk memberikan solusi terbaik bagi Anda yang membutuhkan perawatan luka secara intensif.</p>
          <p>Berdiri sejak 2 Februari 2022, klinik kami berkomitmen untuk memberikan layanan perawatan luka seperti luka diabetes, luka bakar, luka operasi, dan jenis luka lainnya dengan pendekatan multidisiplin untuk mencegah komplikasi.</p>
          <p>Kami menyediakan fasilitas modern dan tenaga medis profesional untuk memastikan kenyamanan serta kesembuhan pasien.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Kontak Kami</h2>
          <div class="block-23 mb-3">
            <ul>
              <li>
                <span class="icon icon-map-marker"></span>
                <span class="text">Jl. Juwana Jakenan KM 01, Tambak Pekuwon, Kec. Juwana, Kab. Pati, Jawa Tengah</span>
              </li>
              <li>
                <a href="#"><span class="icon icon-phone"></span>
                <span class="text">+62 812-3456-7890</span></a>
              </li>
              <li>
                <a href="#"><span class="icon icon-envelope"></span>
                <span class="text">info@klinikrawatlukapati.com</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p>
          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Klinik Rawat Luka Diabetes Pati <i aria-hidden="true"></i>
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- endfooter -->