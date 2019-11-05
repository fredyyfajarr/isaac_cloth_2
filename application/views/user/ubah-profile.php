<!-- breadcrumb --> 
<div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('user/profile/') . $this->session->userdata['kd_konsumen'] ?>">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
      </ol>
    </nav>
</div>

  <div class="container mt-4">
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>TERJADI KESALAHAN BRO !!!!</strong><hr>
            <?= validation_errors(); ?>
              <button class="close" type="button" data-dismiss="alert" aria-;abel="Close">
                <span aria-hidden="true">&times;</span>  
              </button>
        </div>
    <?php endif; ?>
  </div>

<div class="container" style="min-height: 350px;">
<div class="card">
	<div class="card-header font-weight-bold text-center">Edit Profile</div>
	<div class="card-body">

		<form action="" method="post">
    <input type="hidden" name="kd_konsumen" value="<?= $user['kd_konsumen'] ?>">
		<div class="row">
      <div class="form-group col-sm-6">
        <label for="fn">First Name</label>
				<input type="text" name="nama_depan" id="fn" placeholder="Nama Depan" value="<?= $user['nama_depan'] ?>" class="form-control form-rounded">
      </div>
			<div class="form-group col-sm-6">
        <label for="ln">Last Name</label>
				<input type="text" name="nama_belakang" id="ln" placeholder="Nama Belakang" value="<?= $user['nama_belakang'] ?>" class="form-control form-rounded">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-6">
        <label for="provinsi">Provinsi</label>
        <select class="custom-select form-control form-rounded" name="kd_prov" id="provinsi" required>
              <option selected><?= $user['nama_prov'] ?></option>
                <?php foreach ($provinsi as $prv) : ?>
                  <option value="<?= $prv['kd_prov']; ?>"><?= $prv['nama_prov']?></option>
                <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-sm-6 ">
        <label for="kota">Kota</label>
        <select class="custom-select form-control form-rounded " name="kd_kota" id="kota" required>
                    <option selected value=""><?= $user['nama_kota'] ?></option>
        </select>
      </div>
		</div>
		<div class="row">
			<div class="form-group col-sm-6">
        <label for="kp">Kode Pos</label>
				<input type="text" name="kd_pos" id="kp" placeholder="Kode Pos" value="<?= $user['kd_pos'] ?>" class="form-control form-rounded">
			</div>
			<div class="form-group col-sm-6">
        <label for="nt">No Telpon</label>
				<input type="text" name="telp" id="nt" placeholder="No Telp" value="<?= $user['telp'] ?>" class="form-control form-rounded">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<button class="btn btn-primary float-right" type="submit">Ubah</button>
			</div>
		</div>
		</form>

	</div>
</div>
</div>

