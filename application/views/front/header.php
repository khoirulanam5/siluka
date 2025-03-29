<!DOCTYPE html>
<html lang="en">
  <!-- HEAD -->
  <head>
    <title>SILUKA</title>
    <link rel="shortcut icon" type="image/icon" href="<?= base_url('/landing/furn/assets/logo/klinik.png'); ?>"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/landing/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/open-iconic-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/aos.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/jquery.timepicker.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/front/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/landing/adminlte/plugins/toastr/toastr.min.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
  <!-- ENDHEAD -->
    
    <!-- NAVBAR -->
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="./">KLINIK<span> RAWAT LUKA </span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= ($this->uri->segment(1) == 'front' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
                    <a href="<?= base_url("front/") ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'front' && $this->uri->segment(2) == 'feedback') ? 'active' : '' ?>">
                    <a href="<?= base_url("front/feedback") ?>" class="nav-link">Feedback</a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'auth') ? 'active' : '' ?>">
                    <a href="<?= base_url("auth") ?>" class="nav-link">Login</a>
                </li>
            </ul>
        </div>
	    </div>
	  </nav>
<!-- END nav -->

    