<!-- breadcrumb --> 
<div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
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

<form method="post" action="">
<div class="container mt-4 ml-4" style="min-height: 400px;">
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				<label for="exampleFormControlInput1">Email</label>
				<input type="hidden" value="<?= $user['kd_konsumen'] ?>" name="kd_konsumen">
				<input type="text" name="email" class="form-control" id="exampleFormControlInput1" value="<?= $user['email'] ?>" >
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Username</label>
				<input type="text" name="username" class="form-control" id="exampleFormControlInput1" value="<?= $user['username'] ?>" >
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">First Name</label>
				<input type="text" name="nama_depan" class="form-control" id="exampleFormControlInput1" value="<?= $user['nama_depan'] ?>" >
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Last Name</label>
				<input type="text" name="nama_belakang" class="form-control" id="exampleFormControlInput1" value="<?= $user['nama_belakang'] ?>" >
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput3">No Telp</label>
				<input type="text" class="form-control" name="telp" id="exampleFormControlInput3" value="<?= $user['telp'] ?>"  >
			</div>
				<button class="btn btn-primary" type="submit">Ubah</button>
		</div>
    </div>
</div>
</form>
