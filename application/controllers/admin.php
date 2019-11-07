<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('invoice_model');
        $this->load->library('form_validation');

        if($this->session->userdata('status') != 'login'){ 
            redirect(base_url('auth/login'));
        }
    }

    public function index(){
        $this->admin_model->secure();

        $data['judul'] = 'Dashboard';

        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/index');
        $this->load->view('layout/footer_admin');
    }

    // home list product
    public function list_produk(){
        $this->admin_model->secure();

        $data['judul'] = 'List Product';
        $data['barang'] = $this->admin_model->getAllBarang();
        $data['user']   = $this->admin_model->getAllUser();
        
        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/listProduk',$data);
        $this->load->view('layout/footer_admin',$data);
    }

    // home det barang
    public function detail_barang($kd_brg){
        $this->admin_model->secure();

        $data['judul'] = 'Detail Barang';
        $data['barang']     = $this->admin_model->getBarang($kd_brg);

        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/detailBarang',$data);
        $this->load->view('layout/footer_admin');
    }

    // home tambahBarang 
    public function tambah_barang(){
        $this->admin_model->secure();
        
        $data['judul'] = 'Halaman Tambah Barang';
        $data['kategori']   = $this->admin_model->getAllKategori();
        $data['kode']       = $this->admin_model->kodeBrg();

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
                    $this->admin_model->tambahBarang();
                    $this->session->set_flashdata('flash','Ditambahkan');
                    redirect(base_url('admin/list_produk'));
                }        
    }

    // home editBarang 
    public function edit_barang($kd_brg){
        $this->admin_model->secure();

        $data['judul'] = 'Halaman Edit Barang';
        $data['kategori'] = $this->admin_model->getAllKategori();        
        $data['barang']     = $this->admin_model->getBarang($kd_brg);
		
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
                    $this->admin_model->editBarang($kd_brg);
                    $this->session->set_flashdata('flash','Diubah');
                    redirect(base_url('admin/list_produk'));
                }       
    }
    // function delete barang
    public function hapus($kd_brg){
        $this->admin_model->secure();
        
        $this->admin_model->hapusBarang($kd_brg);
        $this->session->set_flashdata('flash','Dihapus');
        redirect(base_url('admin/list_produk'));
    }
    
    // invoice
    public function invoice(){
        $this->admin_model->secure();

        $data['judul'] = 'Invoice';
        $data['invoice'] = $this->invoice_model->getAllInvoice();

        $this->load->view('layout/header_admin',$data);
        $this->load->view('admin/invoice', $data);
        $this->load->view('layout/footer_admin');
    }

    // detail invoice
    public function detail_invoice($id){
        $this->admin_model->secure();

        $data['judul'] = 'Detail Pemesanan';
        $data['pemesanan'] = $this->invoice_model->getIdPemesanan($id);     
        $data['status'] = $this->invoice_model->getIdStatus($id);  

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
                   
                    $this->invoice_model->pendingToSending($id_trans);  
                    $this->session->set_flashdata('flash','Dikonfirmasi');
                    redirect(base_url('admin/invoice/'));
                }       
    }
}
?>


