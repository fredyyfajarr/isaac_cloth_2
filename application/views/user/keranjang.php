<div class="container-fluid mt-3" style="margin-bottom: 250px;">
<!-- breadcrumb --> 
<div class="container mt-3" >
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Keranjang Saya</li>
      </ol>
    </nav>
</div>



<div class="container">
	<div class="card-header text-center font-weight-bold">Keranjang Saya</div>
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
			<tr>
				<th style="width: 10px;">NO</th>
				<th>Nama Barang</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Subtotal</th>
			</tr>
			<?php $no=1; ?>
			<?php foreach ( $this->cart->contents() as $i ): ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $i['name'] ?></td>
				<td><?= $i['qty'] ?></td>
				<td align="right">Rp. <?= number_format($i['price'], 0, ',', '.') ?></td>
				<td align="right">Rp. <?= number_format($i['subtotal'], 0, ',', '.') ?></td>
			</tr>
			<?php endforeach ?>
			<tr>
				<td colspan="4"></td>
				<td align="right">Rp. <?= number_format( $this->cart->total(), 0, ',', '.' ) ?></td>
			</tr>
		</table>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-6 col-sm-8">
				<a href="<?= base_url('user') ?>">
					<div class="btn btn-sm btn-primary">Kembali</div>
				</a>
			</div>
			<div class="col-3 col-sm-2">
				<a href="<?= base_url('user/hapus_keranjang') ?>">
					<div class="btn btn-sm btn-danger">Hapus Keranjang</div>
				</a>
			</div>	
			<div class="col-3 col-sm-2">
				<a href="<?= base_url('user/transaksi') ?>">
					<div class="btn btn-sm btn-success">Transaksi Sekarang</div>
				</a>
			</div>
		</div>
	</div>
</div>
</div>
