<!-- breadcrumb --> 
<div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
      </ol>
    </nav>
  </div>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash') ?>"></div>

<div class="container mt-2" style="min-height: 450px;">

    <div class="card mb-3" style="max-width: 1100px; min-height: 500px;">
    <div class="row no-gutters">
        <div class="col-md-4" style="max-width: 250px;">
        <img style="max-width: 250px; min-height: 250px;" src="<?= base_url('assets/img/shop.jpg'); ?>" class="card-img img-thumbnail mt-2 ml-2" alt="...">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title"><?= $user['nama_depan'].''.$user['nama_belakang'] ?></h5>
            E-Mail / No.Telp :
            <p class="card-text"><?= $user['email'] ?> / <?= $user['telp'] ?></p>
        </div>
        </div>
    </div>
    </div>
</div>

