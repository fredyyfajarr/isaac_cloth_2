<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="<?= base_url('auth/daftar') ?>">
                <input type="hidden" name="kd_konsumen" value="<?= $kode; ?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-rounded" name="nama_depan" id="nama_depan" placeholder="First Name" autofocus>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-rounded" name="nama_belakang" id="nama_belakang" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="email" class="form-control form-rounded" name="email" id="email" placeholder="Email">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-rounded" name="username" id="username" placeholder="Username">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-rounded" name="password" id="password" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-rounded" name="password2" id="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select class="custom-select form-control form-rounded" name="kd_prov" id="provinsi" required>
                          <option selected disabled>Select Provinsi</option>
                            <?php foreach ($provinsi as $prv) : ?>
                              <option value="<?= $prv['kd_prov']; ?>"><?= $prv['nama_prov']?></option>
                            <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <select class="custom-select form-control form-rounded" name="kd_kota" id="kota" required>
                                <option value="">Select Kota</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-rounded" name="alamat" id="alamat" placeholder="Alamat">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-rounded" name="kd_pos" id="kd_pos" placeholder="Kode Pos">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-rounded" name="telp" id="telp" placeholder="No Telp.">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Registrasi</button>
                
              </form>
              <hr>
                  <div class="text-center">
                      <a class="small" href="<?= base_url('auth/login') ?>">Already have an account? Login!</a>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
