<div class="container-fluid mt-4">
<!-- breadcrumb -->  
  <div class="container mt-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
  <div class="container mt-4 ml-1">
  <div class="form-row">
      <div class="form-group col-sm-6">
        <input type="hidden" value="<?= $barang['kd_brg'] ?>" name="kd_brg"> <!-- HIDDEN INPUT-->
        <label for="namabarang">Nama Barang</label>
        <input type="text"  name="nama" class="form-control" id="namabarang" value="<?= $barang['nama'] ?>" required autofocus>
      </div>
        <div class="form-group col-sm-6">
          <label for="kategori">Category</label>
            <select class="form-control custom-select" name="kd_kategori" id="kategori" required>
                  <option selected disabled>Category Sekarang : <?= $barang['nama_kategori'] ?></option>
                    <?php foreach ($kategori as $ktg) : ?>
                      <option value="<?= $ktg['kd_kategori']; ?>"><?= $ktg['nama_kategori']?></option>
                    <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="form-row">
      <div class="form-group col-sm-12">
        <label for="deskripsi">Deskripsi Barang</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required><?= $barang['deskripsi'] ?></textarea>
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-4">
          <label for="bahan">Bahan</label>
          <input type="text" name="bahan" value="<?= $barang['bahan'] ?>" class="form-control" id="bahan">
        </div>
        <div class="form-group col-sm-4">
          <label for="warna">Warna</label>
          <input type="text" name="warna" value="<?= $barang['warna'] ?>" class="form-control" id="warna">
        </div>
        <div class="form-group col-sm-4">
          <label for="keyword">Keyword</label>
          <input type="text" name="keyword" value="<?= $barang['keyword'] ?>" class="form-control" id="keyword">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-4">
          <label for="ukuran">Ukuran</label>
          <input type="text" name="ukuran" class="form-control" id="ukuran" value="<?= $det_barang['ukuran'] ?>">
        </div>
        <div class="form-group col-sm-4">
          <label for="berat">Berat</label>
          <input type="text" name="berat" class="form-control" id="berat" value="<?= $det_barang['berat'] ?>">
        </div>
        <div class="form-group col-sm-4">
          <label for="stok">Stok</label>
          <input type="text" name="stok" class="form-control" id="stok" value="<?= $det_barang['stok'] ?>">
        </div>
    </div>
    
    <div class="form-row">
      <div class="form-group col-sm-4">
        <label for="harga">Harga</label>
        <input type="text" class="form-control" name="harga" id="harga" required  value="<?= $barang['harga'] ?>">
      </div>
    </div>

    <button class="btn btn-primary" type="submit"><i class="fas fa-edit fa-fw"></i> Edit Product</button>
</form>
  </div>
</div>
