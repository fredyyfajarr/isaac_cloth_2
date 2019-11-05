<?php
      $harga = 'harga';

    function rupiah($harga){
        $hasil = "Rp " . number_format($harga,0,',','.');
        return $hasil;
    }
?>

<!-- search -->
<div class="container mt-3">
	<div class="row">
		<div class="col-sm-3">
			<form class="navbar-form" action="" method="post">
			<div class="input-group add-on">
				<input class="form-control" type="text" name="keyword" placeholder="Search" aria-label="Search">
				<button class="btn" type="submit"><i class="fas fa-search fa-fw "></i></button>
			</form>
			</div>
		</div>
	</div>
</div>

<!-- breadcrumb -->
<div class="container">
	<nav aria-label="breadcrumb" class="mt-3">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">Home</li>
		</ol>
	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
				<img class="d-block img-fluid" src="<?= base_url('assets/img/landing.jpg') ?>" alt="First slide">
				</div>
				<div class="carousel-item">
				<img class="d-block img-fluid" src="<?= base_url('assets/img/landing.jpg') ?>" alt="Second slide">
				</div>
				<div class="carousel-item">
				<img class="d-block img-fluid" src="<?= base_url('assets/img/landing.jpg') ?>" alt="Third slide">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			</div>
		</div> <!-- end of col --> 
		
		<div class="col-sm-4 mt-4 mb-4">
			<ul class="list-group">
				<li class="list-group-item active bg-gradient-primary">Category</li>
			</ul>
			
			<?php 
			foreach($kategori->result_array() as $row):
			$kd_kategori = $row['kd_kategori'];
			$total       = $row['total'];
			$nm_ktg      = $row['nama_kategori'];
			?>
			<ul class="list-group mt-2">
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<a href="<?= base_url('user/show/') . $kd_kategori ; ?>"><?php echo htmlentities($nm_ktg, ENT_QUOTES, 'UTF-8');?></a>
					<span class="badge badge-primary badge-pill"><?php echo htmlentities($total, ENT_QUOTES, 'UTF-8');?></span>
				</li>
					
			<?php endforeach; ?>
			</ul>
			
		</div> <!-- end of col --> 
	</div> <!-- end of row --> 
</div> <!-- end of container --> 

<div class="container">
	<div class="row">
		<?php if ($barang->num_rows() < 1)  :?>
			<div class="alert alert-danger w-100 text-center">Item not found!</div>
		<?php endif; ?>

		<?php foreach ($barang->result_array() as $row) : ?>
			<div class="col-sm-3 mb-2">
				<div class="card h-100 bg-gradient-primary shadow-lg">
				<a href="#"><img class="card-img-top" src="<?= base_url('assets/img/' . $row['gambar']); ?>" style="max-width: 400px; max-height: 200px;" alt=""></a>
					<div class="card-body">
						<h4 class="card-title text-white" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 40px;">
						<a href="<?= base_url('user/detail_barang/') . $row['kd_brg'] ?>" class="text-white"><?= $row['nama'] ?></a>
						</h4>
						<?php 
						
						 $diskon = $row['harga'] * ($row['diskon'] / 100);
						 $total = $row['harga'] - $diskon;
						
						?>
						<em class='text-white'>Disc <?= $row['diskon'] ?> %</em><br>
						<?php if( $row['diskon'] <= 0 ) :?>
							<em class="text-white" style="text-decoration: line-through"><?= rupiah($row['harga']); ?></em> <br>
						<?php else : ?>
						<div class="row">
							<div class="col-sm-12">
								<em class="text-white" style="text-decoration: line-through"><?= rupiah($row['harga']); ?></em>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<em class="text-white"><?= rupiah($total); ?></em>
							</div>
						</div>
						<?php endif; ?>
						<a href="<?= base_url('user/detail_barang/') . $row['kd_brg'] ?>" class="btn btn-light btn-sm m-0 mt-2 float-right text-primary"><i class="fas fa-eye fa-fw"></i></a>
						<?php if( $row['stok'] <= 0 ) { ?>
							<div class="btn btn-disabled btn-light btn-sm mt-2 float-right mr-2 text-danger"><i class="fas fa-times-circle fa-fw"></i></div>
						<?php }else{ ?>
							<?= anchor("user/tambah_ke_keranjang/" . $row['kd_brg'], '<div class="btn btn-light btn-sm mt-2 float-right mr-2 text-primary"><i class="fas fa-shopping-cart fa-fw"></i></div>') ?>
						<?php } ?>	
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		
	</div>	
</div>
