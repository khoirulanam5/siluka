<div class="hero-wrap" style="background-image: url('<?= base_url('/landing/front/images/') ?>ruangan.jpeg ');" data-stellar-background-ratio="0.5">
    <div class="overlay">
  </div>
    <div class="container">
      <div class="row no-gutters  justify-content-start align-items-center" style="padding-top: 100px;">
        <div class="col-lg-12 col-md-12">
          <div class="row">
            <div class="col-md-3" style="background-color: #0C2F91;padding: 20px;">
              <div class="d-flex flex-md-column list-group" id="list-tab" role="tablist">
                <a class="list-group-item active" id="list-ticket-list" data-toggle="list" href="#list-ticket" role="tab" aria-controls="ticket" aria-selected="false">
                  <i class="fas fa-ticket-alt"></i>
                  <span style="font-size:14px;">Kritik / Saran</span>
                </a>
              </div>
            </div>
            <?= $this->session->flashdata('pesan') ?>
            <div class="col-md-9" style="background-color: #fff;padding: 20px;">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade bordered show active" id="list-ticket" role="tabpanel" aria-labelledby="list-ticket-list">
                  <form action="<?= base_url('front/feedback_v') ?>" method="post" enctype="multipart/form-data">
                    <div class="d-md-flex mt-2">
                      <div class="form-group col-12 col-md-12">
                        <label for="" class="label">Berikan Saran</label>
                        <textarea class="form-control" name="saran" placeholder="Masukkan Saran Anda Untuk Pelayanan di Klinik Kami" required></textarea>
                      </div>
                    </div>
                    <div class="d-md-flex">
                      <div class="form-group col-12 col-md-12" style="text-align: right;">
                        <button type="submit" class="btn btn-info py-3 px-4"><i class="fas fa-comment"></i> Feedback</button>
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