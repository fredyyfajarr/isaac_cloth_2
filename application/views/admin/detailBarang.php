<style>
  th{
    width: 200px;
  }
</style>

<?php
      $harga = 'harga';

    function rupiah($harga){
        $hasil = "Rp " . number_format($harga,0,',','.');
        return $hasil;
    }
?>

<div class="container mt-4"style="min-height: 450px;"> 

<!-- breadcrumb --> 
<div class="container mt-2" >
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('admin/list_produk') ?>">List Product</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
      </ol>
    </nav>
</div>

<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <center><b>Detail Barang</b></center>
        </div>
        <div class="card-body">
        <div class="card-text">
         <center><img src="<?=base_url('assets/img/' . $barang['gambar']); ?>" class="img-thumbnail" alt="..." style="max-width: 200px; max-height: 200px;"></center>
        </div>
        <table class="table table-striped mt-3">
          <tr>
          <th scope=>Nama Barang</th><td>:</td><td><?= $barang['nama'] ?></td>
          </tr>
          <tr>
          <th>Deskripsi Barang</th><td>:</td><td><?= $barang['deskripsi'] ?></td>
          </tr>
          <tr>
          <th>Kategori</th><td>:</td><td><?= $barang['nama_kategori'] ?></td>
          </tr>
          <tr>
          <th>Bahan</th><td>:</td><td><?= $barang['bahan'] ?></td>
          </tr>
          <tr>
          <th>Warna</th><td>:</td><td><?= $barang['warna'] ?></td>
          </tr>
          <tr>
          <th>Keyword</th><td>:</td><td><?= $barang['keyword'] ?></td>
          </tr>
          <tr>
          <th>Harga</th><td>:</td><td><?= rupiah($barang['harga']); ?></td>
          </tr>
          <tr>
          <th>Ukuran</th><td>:</td><td><?= $det_barang['ukuran']; ?></td>
          </tr>
          <tr>
          <th>Berat</th><td>:</td><td><?= $det_barang['berat']; ?> Kg</td>
          </tr>
          <tr>
          <th>Stok</th><td>:</td><td><?= $det_barang['stok']; ?> pcs</td>
          </tr>
        </table>
      </div>
  </div>    
</div>
</div>
</div>