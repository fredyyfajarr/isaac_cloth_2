<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn-lg btn-primary mb-3 mt-3 w-100">Input Data Pembeli</div>
            <form action="<?= base_url()?>/user/resi" method="post"> 
            <input type="hidden" name="kd_resi1" value="<?= $kode ?>">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan1" value="<?= $this->session->userdata('nama_depan').' '.$this->session->userdata('nama_belakang') ?>" autofocus>
                </div>
                <div class="form-row" > 
                    <div class="form-group col-sm-6">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-control" name="kd_prov1" id="provinsi" required>
                                <option selected disabled>Select Provinsi</option>
                                <?php foreach ($provinsi as $prv) : ?>
                                    <option value="<?= $prv['kd_prov']; ?>"><?= $prv['nama_prov']?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="provinsi">Kota/Kabupaten</label>
                            <select class="form-control" name="kd_kota1" id="kota" required>
                                <option value="">Select Kota</option>
                            </select>
                    </div>
                </div>     
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea type="text" class="form-control" id="alamat" name="alamat1"></textarea>
                </div>
                <div class="form-row" > 
                    <div class="form-group col-sm-4">
                    <label for="jasa">Jasa Pengiriman</label>
                        <select class="form-control" name="kd_jasa1" id="jasa" required>
                        <option selected disabled>Jasa Pengiriman</option>
                                <?php foreach ($jasa as $jsa) : ?>
                                    <option value="<?= $jsa['kd_jasa']; ?>"><?= $jsa['nama_jasa']?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                    <label for="jp">Jenis Pengiriman</label>
                        <select class="form-control" name="kd_jp1" id="jp" required>
                            <option value="">Jenis Pengiriman</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                    <label for="ongkir">Biaya Kirim</label>
                        <select class="form-control" name="kd_bk1" id="ongkir" required>
                            <option value="">Biaya Kirim</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
					<label>No. Telepon</label>
					<input type="text" name="telepon1" placeholder="No. Telepon" class="form-control">
				</div>
                <button type="submit" class="btn btn-sm btn-primary mb-4">Kirim</button>
			</form>			

            <?php 
                $grand_total = 0;

                if($keranjang = $this->cart->contents()){

                    foreach ($keranjang as $item) {
                        $grand_total = $grand_total + $item['subtotal'];
                    }
                    echo 'Total Belanja : Rp.'.number_format($grand_total,'0',',','.');                
            ?>
           
            <?php 
            }
            else{
                redirect(base_url('user/keranjang_saya'));
            }
            ?>
        </div>
    </div>
</div>
