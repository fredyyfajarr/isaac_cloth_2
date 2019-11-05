<div style="margin-bottom: 200px;">
<div class="container-fluid mt-4">
<!-- breadcrumb -->
<div class="container mt-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('user/index') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('user/pesanan/'.$this->session->userdata('kd_konsumen')) ?>">Pesanan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
      </ol>
    </nav>
</div>

<div class="container">
<div class="card-header text-center"><b>Detail Pesanan</b></div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Jumlah Barang</th>
            <th>Total</th>
        </tr>

        <?php 
            $a = 1;
            $total = 0;
            foreach($pemesanan as $item):
            $total_bayar = $item->jumlah * $item->harga;
            $total += $total_bayar;

            $status = $item->kd_status;
        ?>

        <tr>
            <td><?= $a++ ?></td>
            <td><?= $item->nama; ?></td>
            <td><?= $item->harga ?></td>
            <td><?= $item->jumlah ?></td>
            <td><?= $item->total_bayar ?></td>
        </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4">Grand Total : </td>
            <td><?= $total ?></td>
        </tr>
    </table>
</div>
        <form action="" method="post">      
            <input type="hidden" name="id" value="<?= $item->id_invoice?>">  
            <input type="hidden" name="kd_status" value="<?= $item->kd_status?>">
            <?php 
                if($status == 1){
                    echo '
                    <div class="btn btn-primary disabled">Status Pemesanan</div> : Pesanan anda sedang diproses!
                    ';
                }
                else if($status == 2){
                    echo '
                    <div class="label">Konfirmasi disini jika barang disampai</div>
                    <small>Note : mohon diperhatikan, konfirmasi apabila barang benar-benar sudah sampai!</small><br>
                    <button class="btn btn-primary mt-2" type="submit">Konfirmasi</button>
                    ';
                }
                else if($status == 3){
                    echo '
                    <div class="btn btn-primary disabled">Status Pemesanan</div> : Pesanan anda berhasil!
                    ';
                }
            ?>
        </form>
</div>
</div>
</div>
</div>
</div>