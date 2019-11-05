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
        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
      </ol>
    </nav>
</div>

<div class="col-sm-8 m-auto">
    <div class="card mb-5 mt-5">
        <div class="card-header">
            <center><b>Detail Barang</b></center>
        </div>
        <div class="card-body">
        <div class="card-text">
         <center><img src="<?= base_url('assets/img/' . $barang['gambar']); ?>" alt="..." style="max-width: 200px; max-height: 200px;"></center>
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
          <th>Ukuran</th><td>:</td><td><?= $barang['ukuran']; ?></td>
          </tr>
          <tr>
          <th>Berat</th><td>:</td><td><?= $barang['berat']; ?> Kg</td>
          </tr>
          <tr>
          <th>Stok</th><td>:</td><td><?= $barang['stok']; ?> pcs</td>
          </tr>
          <tr>
          <th>Harga</th><td>:</td><td><?= rupiah($barang['harga']); ?></td>
          </tr>
          <tr>
          <th>Diskon</th><td>:</td><td><?= $barang['diskon']; ?> %</td>
          </tr>
        </table>
        <?php if( $barang['stok'] <= 0 ) { ?>
          <div class="btn btn-danger btn-disabled btn-sm"><i class="fas fa-times-circle fa-fw text-white"></i> Stock Habis</div>
        <?php }else{ ?>
          <?= anchor("user/tambah_ke_keranjang/" . $barang['kd_brg'], '<div class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart fa-fw text-white"></i> Tambah ke keranjang</div>') ?>
        <?php } ?>
      </div>
  </div>    
</div>
</div>
        
    
        
        
