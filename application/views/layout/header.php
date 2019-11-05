<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $judul ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/sb-admin-2.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
    
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
    .form-rounded{
      border-radius: 1rem;
    }
    </style>
    
</head>
<body style="height: 100%;">

<!-- Navbar jika tidak ada Session -->
<?php 
if($this->session->userdata('status') != 'login'){
?>

<!-- Navbar Jika Tidak Login -->
<nav class="navbar sticky-top navbar navbar-expand-lg navbar-light bg-gradient-primary">
  <div class="container">
  <a style="color: white;" class="navbar-brand font-weight-bold" href="<?= base_url() ?>"><i class="fas fa-tshirt fa-fw"></i> ISAAC CLOTH</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link text-white" href="<?= base_url('auth/login') ?>">Login<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="<?= base_url('auth/daftar') ?>">Register<span class="sr-only">(current)</span></a>
          </li>
        </ul>
    </div>
  </div>
</nav>

<!-- Navbar user jika ada session -->
<?php 
}
else if($this->session->userdata('status') == 'login' && $this->session->userdata('role_id') == 2){
?>

<!-- Navbar User -->
<nav class="navbar sticky-top navbar navbar-expand-lg navbar-light bg-gradient-primary">
  <div class="container">
    <a style="color: white;" class="navbar-brand" href="<?= base_url() ?>"><i class="fas fa-tshirt fa-fw"></i><b> ISAAC CLOTH</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <?php $keranjang = $this->cart->total_items() ?>
                <a class="nav-link" href="<?= base_url("user/keranjang_saya"); ?>"><i class="fas fa-shopping-cart fa-fw text-white"></i><sup class="badge badge-danger badge-counter"><?= $keranjang ?></sup> </a>  
                  
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;"><i class="fas fa-user-alt fa-fw text-white"></i></a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?= base_url('user/profile/') . $this->session->userdata('kd_konsumen');?>".<?= $this->session->userdata('nama_depan').' '.$this->session->userdata('nama_belakang') ?>>
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?= $this->session->userdata('nama_depan').' '.$this->session->userdata('nama_belakang') ?>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url("user/keranjang_saya"); ?>">
                  <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i>
                Keranjang Saya</a>
                <a class="dropdown-item" href="<?= base_url("user/pesanan/") . $this->session->userdata('kd_konsumen'); ?>">
                  <i class="fas fa-folder-open fa-sm fa-fw mr-2 text-gray-400"></i>
                Pesanan Saya</a>  
                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                </div>
            </div>
          </li>
      </ul>
    </div>
  </div>
</nav>

<?php 
    }
?>
