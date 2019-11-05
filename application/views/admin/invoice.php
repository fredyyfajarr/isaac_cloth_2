<div class="container-fluid">
    <!-- breadcrumb --> 
    <div class="container mt-2">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
        </ol>
        </nav>
    </div>

    <!-- alert success tambah/mengubah data -->
    <?php if ( $this->session->flashdata('flash') ) : ?>
        <div class="row mt-3 ml-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>.
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>  
            </button>
        </div>
        </div>
    <?php endif; ?>	

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Invoice Pemesanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama Pemesan</th>
                    <th>Alamat Pengiriman</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Batas pembayaran</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($invoice as $inv) : ?>
                <tr>
                    <td><?= $inv->id_invoice ?></td>
                    <td><?= $inv->nama_pemesan ?></td>
                    <td><?= $inv->alamat ?></td>
                    <td><?= $inv->tgl_pesan ?></td>
                    <td><?= $inv->batas_bayar ?></td>
                    
                    <?php if($inv->kd_status == 1) { ?>
                        <td><div class="btn btn-danger btn-sm btn-block"> <?= $inv->nama_status ?></div></td>
                    <?php }elseif($inv->kd_status == 2) {?>
                        <td><div class="btn btn-warning btn-sm btn-block"><?= $inv->nama_status ?></div></td>
                    <?php }elseif($inv->kd_status == 3) { ?>
                        <td><div class="btn btn-success btn-sm btn-block"><?= $inv->nama_status ?></div></td>
                    <?php } ?>
                    

                    <td>
                        <a href="<?= base_url('admin/detail_invoice/') . $inv->id_invoice; ?>" class="btn btn-primary btn-block btn-sm"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>