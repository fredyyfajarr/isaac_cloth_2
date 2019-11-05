<div style="margin-bottom: 350px;" >
<div class="container-fluid mt-3">
<!-- breadcrumb -->
<div class="container mt-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pesanan Saya</li>
      </ol>
    </nav>
</div>
<!-- alert success -->
<div class="container">
<?php if ( $this->session->flashdata('flash') ) : ?>
        <div class="row mt-3 ml-2">
        <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert">
            Transaksi <strong>telah </strong><?= $this->session->flashdata('flash'); ?>.
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>  
            </button>
        </div>
        </div>
<?php endif; ?>
</div>

<div class="container">
	<div class="card-header text-center font-weight-bold">Pesanan Saya</div>
	<div class="row mt-2">

		<?php foreach ($invoice as $inv) : ?>
			<div class="col-sm-12 mb-4">
				<div class="card h-100">
					<div class="card-body">
					<div class="container">
						<div class="row">
							<div class="col-sm">
								<h4 class="card-title " style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 40px;"><?= $inv->id_invoice ?></h4>
							</div>
							<div class="col-sm">
							<?php if($inv->kd_status == 1) { ?>
											<td><div class="btn btn-danger btn-sm btn-block"><i class="fas fa-sync-alt"></i> <?= $inv->nama_status ?></div></td>
										<?php }elseif($inv->kd_status == 2) {?>
											<td><div class="btn btn-warning btn-sm btn-block"><i class="fas fa-paper-plane"></i> <?= $inv->nama_status ?></div></td>
										<?php }elseif($inv->kd_status == 3) { ?>
											<td><div class="btn btn-success btn-sm btn-block"><i class="fas fa-check"></i> <?= $inv->nama_status ?></div></td>
										<?php } ?>
							</div>
							<div class="col-sm">
							<a href="<?= base_url('user/detail_pesanan/') . $inv->id_invoice; ?>" class="btn btn-primary float-right  mt-2"><i class="fas fa-eye"></i></a>
							</div>
							</div>
						</div>
						<table class="table table-hover table-striped mt-2">
                            <tr>
                                <th>Nama Pemesan</th><td>:</td><td><?= $inv->nama_pemesan ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th><td>:</td><td><?= $inv->alamat ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pemesanan</th><td>:</td><td><?= $inv->tgl_pesan ?></td>
                            </tr>
                            <tr>
                                <th>Batas Bayar</th><td>:</td><td><?= $inv->batas_bayar ?></td>
                            </tr>
                        </table>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>	
</div>

</div>
</div>

