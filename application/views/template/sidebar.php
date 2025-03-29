<!-- Sidebar -->
<div class="iq-sidebar rtl-iq-sidebar sidebar-default">
        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url('dashboard') ?>" class="header-logo">
                <img src="<?= base_url('assets/images/loading.png') ?>" class="img-fluid rounded-normal light-logo" alt="logo">
                <img src="<?= base_url('assets/images/loading.png') ?>" class="img-fluid rounded-normal darkmode-logo" alt="logo">
            </a>
            <div class="ml-3 logo-text">
                <p class="mt-2 mb-0 font-weight-bold">SILUKA</p>
                <p class="text-muted small">Klinik Rawat Luka Diabetes</p>
            </div>
            <div class="iq-menu-bt-sidebar">
                <i class="las la-bars wrapper-menu"></i>
            </div>
        </div>
        <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard') ?>"><i class="las la-home"></i><span>Dashboard</span></a>
                    </li>
                    <?php if ($this->session->userdata('jabatan') == 'Pemilik'): ?>
                        <li class="<?= $this->uri->segment(2) == 'karyawan' ? 'active' : '' ?>">
                            <a href="<?= base_url('pemilik/karyawan') ?>"><i class="las la-user"></i><span>Data Karyawan</span></a>
                        </li>
                        <li class="nav-item dropdown <?= $this->uri->segment(2) == 'laporan' ? 'active' : '' ?>">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                <i class="las la-file-alt"></i> <span>Laporan</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('pemilik/laporan/pasien') ?>">Data Pasien</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('pemilik/laporan') ?>">Perawatan Klinik</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('pemilik/laporan/homecare') ?>">Perawatan Homecare</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('jabatan') == 'Admin'): ?>
                        <li class="<?= $this->uri->segment(2) == 'pasien' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/pasien') ?>"><i class="las la-user"></i><span>Data Pasien</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'jadwal' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/jadwal') ?>"><i class="las la-calendar"></i><span>Jadwal Perawatan</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'pendaftaran' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/pendaftaran') ?>"><i class="las la-user-check"></i><span>Verify Pendaftaran</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'homecare' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/homecare') ?>"><i class="las la-first-aid"></i><span>Verify Homecare</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'feedback' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/feedback') ?>"><i class="las la-envelope"></i><span>Data Saran</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'hasil' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/hasil') ?>"><i class="las la-notes-medical"></i><span>Riwayat Perawatan</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'pembayaran' ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/pembayaran') ?>"><i class="las la-wallet"></i><span>Riwayat Pembayaran</span></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('jabatan') == 'Perawat'): ?>
                        <li class="<?= $this->uri->segment(2) == 'klinik' ? 'active' : '' ?>">
                            <a href="<?= base_url('perawat/klinik') ?>"><i class="las la-stethoscope"></i><span>Perawatan Klinik</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'homecare' ? 'active' : '' ?>">
                            <a href="<?= base_url('perawat/homecare') ?>"><i class="las la-first-aid"></i><span>Perawatan Homecare</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'hasil' ? 'active' : '' ?>">
                            <a href="<?= base_url('perawat/hasil') ?>"><i class="las la-notes-medical"></i><span>Riwayat Perawatan</span></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('jabatan') == 'Pasien'): ?>
                        <li class="<?= $this->uri->segment(2) == 'pendaftaran' ? 'active' : '' ?>">
                            <a href="<?= base_url('pasien/pendaftaran') ?>"><i class="las la-user-plus"></i><span>Pendaftaran Layanan</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'homecare' ? 'active' : '' ?>">
                            <a href="<?= base_url('pasien/homecare') ?>"><i class="las la-first-aid"></i><span>Homecare</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'hasil' ? 'active' : '' ?>">
                            <a href="<?= base_url('pasien/hasil') ?>"><i class="las la-notes-medical"></i><span>Hasil Perawatan</span></a>
                        </li>
                        <li class="<?= $this->uri->segment(2) == 'pembayaran' ? 'active' : '' ?>">
                            <a href="<?= base_url('pasien/pembayaran') ?>"><i class="las la-wallet"></i><span>Riwayat Pembayaran</span></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>