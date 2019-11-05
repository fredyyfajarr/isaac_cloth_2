<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('adminModel');
        $this->load->model('invoiceModel');
        $this->load->library('form_validation');

        if($this->session->userdata('status') != 'login'){ 
            redirect(base_url('auth/login'));
        }
    }

    public function index(){
        $this->adminModel->secure();

        $data['judul'] = 'Dashboard';

        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/index');
        $this->load->view('layout/footer_admin');
    }

    // home list product
    public function list_produk(){
        $this->adminModel->secure();

        $data['judul'] = 'List Product';
        $data['barang'] = $this->adminModel->getAllBarang();
        $data['user']   = $this->adminModel->getAllUser();
        
        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/listProduk',$data);
        $this->load->view('layout/footer_admin',$data);
    }

    // home det barang
    public function detail_barang($kd_brg){
        $this->adminModel->secure();

        $data['judul'] = 'Detail Barang';
        $data['barang']     = $this->adminModel->getBarang($kd_brg);

        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/detailBarang',$data);
        $this->load->view('layout/footer_admin');
    }

    // home tambahBarang 
    public function tambah_barang(){
        $this->adminModel->secure();
        
        $data['judul'] = 'Halaman Tambah Barang';
        $data['kategori']   = $this->adminModel->getAllBarang();
        $data['kode']       = $this->adminModel->kodeBrg();

        $this->form_validation->set_rules('kd_brg', 'Kode Barang');
        $this->form_validation->set_rules('nama', 'Nama Barang', 'required|max_length[32]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga Barang', 'required');
        $this->form_validation->set_rules('diskon', 'Diskon Barang', 'required|max_length[3]');
        $this->form_validation->set_rules('kd_kategori', 'Kategori Barang', 'required|max_length[24]');
        $this->form_validation->set_rules('bahan', 'Bahan Barang', 'required|max_length[16]');
        $this->form_validation->set_rules('warna', 'Warna Barang', 'required|max_length[16]');
        $this->form_validation->set_rules('keyword', 'Keyword Barang', 'required|max_length[16]');
        $this->form_validation->set_rules('ukuran', 'Ukuran Barang', 'required');
        $this->form_validation->set_rules('berat', 'Berat Barang', 'required');
        $this->form_validation->set_rules('stok', 'Stok Barang', 'required');
        
        
        if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('layout/header_admin',$data);
                    $this->load->view('admin/tambahBarang',$data);
                    $this->load->view('layout/footer_admin');
                }
                else
                {
                    $this->adminModel->tambahBarang();
                    $this->session->set_flashdata('flash','Ditambahkan');
                    redirect(base_url('admin/list_produk'));
                }        
    }

    // home editBarang 
    public function edit_barang($kd_brg){
        $this->adminModel->secure();

        $data['judul'] = 'Halaman Edit Barang';
        $data['kategori'] = $this->adminModel->getAllBarang();        
        $data['barang']     = $this->adminModel->getBarang($kd_brg);
		
        $this->form_validation->set_rules('kd_brg', 'Kode Barang');
        $this->form_validation->set_rules('nama', 'Nama Barang', 'required|max_length[32]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga Barang', 'required');
        $this->form_validation->set_rules('diskon', 'Diskon Barang', 'required|max_length[3]');
        $this->form_validation->set_rules('kd_kategori', 'Kategori Barang', 'required|max_length[24]');
        $this->form_validation->set_rules('bahan', 'Bahan Barang', 'required|max_length[16]');
        $this->form_validation->set_rules('warna', 'Warna Barang', 'required|max_length[16]');
        $this->form_validation->set_rules('keyword', 'Keyword Barang', 'required|max_length[16]');
        $this->form_validation->set_rules('ukuran', 'Ukuran Barang', 'required');
        $this->form_validation->set_rules('berat', 'Berat Barang', 'required');
        $this->form_validation->set_rules('stok', 'Stok Barang', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('layout/header_admin',$data);
                    $this->load->view('admin/editBarang',$data);
                    $this->load->view('layout/footer_admin');
                }
                else
                {
                    $this->adminModel->editBarang($kd_brg);
                    $this->session->set_flashdata('flash','Diubah');
                    redirect(base_url('admin/list_produk'));
                }       
    }
    // function delete barang
    public function hapus($kd_brg){
        $this->adminModel->secure();
        
        $this->adminModel->hapusBarang($kd_brg);
        $this->session->set_flashdata('flash','Dihapus');
        redirect(base_url('admin/list_produk'));
    }
    
    // invoice
    public function invoice(){
        $this->adminModel->secure();

        $data['judul'] = 'Invoice';
        $data['invoice'] = $this->invoiceModel->getAllInvoice();

        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/invoice', $data);
        $this->load->view('layout/footer_admin');
    }

    // detail invoice
    public function detail_invoice($id){
        $this->adminModel->secure();

        $data['judul'] = 'Detail Pemesanan';
        $data['pemesanan'] = $this->invoiceModel->getIdPemesanan($id);     
        $data['status'] = $this->invoiceModel->getIdStatus($id);  

        $this->form_validation->set_rules('id', 'Id Trans', 'required');
        $this->form_validation->set_rules('kd_status', 'Kode Status', 'required');

        if ($this->form_validation->run() == FALSE)
                {  
                    $this->load->view('layout/header_admin',$data);
                    $this->load->view('admin/detailInvoice', $data);
                    $this->load->view('layout/footer_admin');
                }
                else
                {
                   
                    $this->invoiceModel->pendingToSending($id_trans);  
                    $this->session->set_flashdata('flash','Dikonfirmasi');
                    redirect(base_url('admin/invoice/'));
                }       
    }
}
?>


