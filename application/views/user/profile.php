<!-- breadcrumb --> 
<div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile Saya</li>
      </ol>
    </nav>
  </div>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash') ?>"></div>

<div class="container mt-2" style="min-height: 450px;">
<div class="card-header font-weight-bold text-center">Profile Saya</div>
    <div class="card mb-3" style="max-width: 1100px; min-height: 500px;">
      <div class="row no-gutters">
          <div class="col-sm-12">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th>Nama Lengkap</th>
                    <td>:</td>
                    <td><?= $user['nama_depan'].' '.$user['nama_belakang'] ?></td>
                  </tr>
                  <tr>
                    <th>Provinsi</th>
                    <td>:</td>
                    <td><?= $user['nama_prov'] ?></td>
                  </tr>
                  <tr>
                    <th>Kota/Kabupaten</th>
                    <td>:</td>
                    <td><?= $user['nama_kota'] ?></td>
                  </tr>
                  <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td><?= $user['alamat'] ?></td>
                  </tr>
                  <tr>
                    <th>No Telp</th>
                    <td>:</td>
                    <td><?= $user['telp'] ?></td>
                  </tr>
                  <tr>
                    <th>Kode Pos</th>
                    <td>:</td>
                    <td><?= $user['kd_pos'] ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <a href="<?= base_url('user/ubah_profile/') . $user['kd_konsumen'] ?>" class="btn btn-primary float-right mr-5">Ubah Profile</a>
        </div>
    </div>
</div>
</div>

