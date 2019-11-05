<?php
    foreach($barang as $b){
        $harga = $b['harga'];
    }

    function rupiah($harga){
        $hasil = "Rp " . number_format($harga,0,',','.');
        return $hasil;
    }
?>

<div class="container-fluid">
    <!-- breadcrumb --> 
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">List Product</li>
                </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash') ?>"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Product</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($barang as $row) : ?>
                <tr>
                    <td><?= $row['kd_brg'];?></td>
                    <td><?= $row['nama'];?></td>
                    <td><?= $row['nama_kategori'] ?></td>
                    <td><?= rupiah($row['harga']);?></td>
                    <td>
                    <button class="btn btn-primary btn-sm"><a class="text-white"style="color: white;" href="<?= base_url('admin/edit_barang/') . $row['kd_brg']; ?>"><i class="fas fa-pencil-alt fa-fw"></i></a></button>
                    <button class="btn btn-primary btn-sm"><a class="text-white" data-href="<?= base_url('admin/hapus/') . $row['kd_brg']; ?>" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash-alt fa-fw"></i></a></button>
                    <button class="btn btn-primary btn-sm"><a class="text-white" href="<?= base_url('admin/detail_barang/') . $row['kd_brg']; ?>"><i class="fas fa-eye fa-fw"></i></a></button></td>
                    <!-- Hapus Barang Modal-->
                        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Delete" below if you are ready to delete your data.</div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger btn-ok text-white">Delete</a>
                            </div>
                            </div>
                        </div>
                        </div>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
   