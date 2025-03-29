<div class="iq-top-navbar rtl-iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <!-- Logo Section -->
            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                <i class="ri-menu-line wrapper-menu"></i>
                <a href="index.html" class="header-logo">
                    <img src="<?= base_url('assets/images/loading.png') ?>" 
                         class="img-fluid rounded-normal light-logo" 
                         alt="logo">
                    <img src="<?= base_url('assets/images/loading.png') ?>" 
                         class="img-fluid rounded-normal darkmode-logo" 
                         alt="logo">
                </a>
            </div>

            <!-- Search Bar -->
            <div class="iq-search-bar device-search"></div>

            <!-- Navbar Content -->
            <div class="d-flex align-items-center">
                <!-- Dark Mode Switch -->
                <div class="change-mode">
                    <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                        <div class="custom-switch-inner">
                            <p class="mb-0"></p>
                            <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                            <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                <span class="switch-icon-left">
                                    <i class="a-left ri-moon-clear-line"></i>
                                </span>
                                <span class="switch-icon-right">
                                    <i class="a-right ri-sun-line"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Navbar Items -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                        <!-- Fullscreen Icon -->
                        <li class="nav-item iq-full-screen">
                            <a href="#" id="btnFullscreen">
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </li>

                        <!-- User Dropdown -->
                        <li class="caption-content">
                            <a href="#" class="iq-user-toggle">
                                <img src="<?= base_url('assets/img/user/default.png') ?>" 
                                     class="img-fluid rounded" 
                                     alt="user">
                            </a>
                            <div class="iq-user-dropdown">
                                <div class="card">
                                    <!-- Profile Header -->
                                    <div class="card-header d-flex justify-content-between align-items-center mb-0">
                                        <h4 class="card-title mb-0">Profile</h4>
                                        <div class="close-data text-right badge badge-primary cursor-pointer">
                                            <i class="ri-close-fill"></i>
                                        </div>
                                    </div>

                                    <!-- Scrollable Content -->
                                    <div class="data-scrollbar" data-scroll="2">
                                        <div class="card-body">
                                            <!-- User Info -->
                                            <div class="profile-header">
                                                <div class="cover-container">
                                                    <div class="media align-items-center mb-4">
                                                        <img src="<?= base_url('assets/img/user/default.png') ?>" 
                                                             alt="profile-bg" 
                                                             class="rounded img-fluid avatar-80">
                                                        <div class="media-body profile-detail ml-3 rtl-mr-3 rtl-ml-0">
                                                            <h3><?= $this->session->userdata('username') ?></h3>
                                                            <div class="d-flex flex-wrap">
                                                                <p class="mb-1"><?= $this->session->userdata('level') ?></p>
                                                                <a href="<?= base_url('auth/logout') ?>" class="ml-3 rtl-mr-3 rtl-ml-0">Keluar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Personal Details -->
                                                <div class="personal-details">
                                                    <h5 class="card-title mb-3 mt-3">Informasi Anda</h5>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-sm-4">
                                                            <h6>ID User</h6>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="mb-0">: <?= $this->session->userdata('id_user') ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-sm-4">
                                                            <h6>Username</h6>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="mb-0">: <?= $this->session->userdata('username') ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-sm-4">
                                                            <h6>Jabatan</h6>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="mb-0">: <?= $this->session->userdata('jabatan') ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-sm-4">
                                                            <h6>Alamat</h6>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="mb-0">: <?= $this->session->userdata('alamat') ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-sm-4">
                                                            <h6>Nomor Hp</h6>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="mb-0">: <?= $this->session->userdata('no_hp') ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-sm-4">
                                                            <h6>Password</h6>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="mb-0">: <?= $this->session->userdata('password') ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-sm-4">
                                                            <h6>Email</h6>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="mb-0">: <?= $this->session->userdata('email') ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
