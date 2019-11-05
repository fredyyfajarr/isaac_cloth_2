<?php 

    $ongkir = $bk_bk->biaya_kirim;
    $ppn    = $bk_kota->biaya_kirim;
    $total = $ongkir + $ppn;

    $grandTotal = $this->cart->total() + $total; 

?>

<div style="margin-bottom: 150px; margin-top: 50px;">
    <div class="container">
        <div class="card-header text-center container w-auto">Resi Pemesanan</div>
            <div class="card-body container w-auto">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>No Resi</th><td>:</td><td><?= $kd_resi ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th><td>:</td><td><?= date('Y-m-d H:i:s') ?></td>
                    </tr>
                    <tr>
                        <th>Customer</th><td>:</td><td><?= $nama ?></td>
                    </tr>
                    <tr>
                        <th>Pembayaran</th><td>:</td><td>COD</td>
                    </tr>
                    <tr>
                        <th>Total Bayar</th><td>:</td><td><?= $grandTotal ?></td>
                    </tr>

                    <tr>
                        <th>Status Order</th><td>:</td><td>Menunggu Konfirmasi</td>
                    </tr>
                </table>    
            </div>
            </div>
        <form action="" method="post">
			<input type="hidden" name="kd_resi" value="<?= $kd_resi ?>">
			<input type="hidden" name="nama_pemesan" value="<?= $nama ?>">
			<input type="hidden" name="alamat" value="<?= $alamat ?>">
			<input type="hidden" name="kd_prov" value="<?= $kd_prov ?>">
			<input type="hidden" name="kd_kota" value="<?= $kd_kota ?>">
			<input type="hidden" name="kd_jasa" value="<?= $kd_jasa ?>">
			<input type="hidden" name="kd_jp" value="<?= $kd_jp ?>">
			<input type="hidden" name="kd_bk" value="<?= $kd_jp ?>">
			<div class="row">
				<div class="col-sm-12">
					<center><button type="submit" class="btn btn-primary">Konfirmasi Pemesanan</button></center>
				</div>
			</div>
        </form>
    </div>
</div>
