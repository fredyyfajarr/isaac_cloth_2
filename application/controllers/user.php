<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('invoice_model');
        $this->load->library('form_validation');
    }
    // home user
    public function index(){
        $data['judul'] = 'Isaac Cloth';

        $data['user']     = $this->user_model->getAllUser();
        $data['barang']   = $this->user_model->getAllBarang();
        $data['kategori'] = $this->user_model->tampilJmlBarang();
        $data['cart']     = $this->cart->contents();        
        if($this->input->post('keyword')){
            $data['barang'] = $this->user_model->productKeyword();
        }
        $this->load->view('layout/header',$data);
        $this->load->view('user/index',$data);
        $this->load->view('layout/footer');
    }

    // home tampil by kategori
    public function show($kd_kategori){
        $data['judul'] = 'Isaac Cloth';

        $data['user']     = $this->user_model->getAllUser();
        $data['barang']   = $this->user_model->getBarangByKategori($kd_kategori);
        $data['kategori'] = $this->user_model->tampilJmlBarang();
        $data['cart']     = $this->cart->contents();    
        if($this->input->post('keyword')){
            $data['barang'] = $this->user_model->productKeyword();
        }
        
        $this->load->view('layout/header',$data);
        $this->load->view('user/kategori',$data);
        $this->load->view('layout/footer');
    }

     // home detail user
    public function detail_barang($kd_brg){
        $data['judul'] = 'Detail Barang';

        $data['barang']     = $this->user_model->getBarang($kd_brg);
        $data['cart']       = $this->cart->contents();

        $this->load->view('layout/header',$data);
        $this->load->view('user/detailBarang',$data);
        $this->load->view('layout/footer');
    }
    
    public function tambah_ke_keranjang($kd_brg){
        $this->user_model->secure(); // session login
        $barang = $this->user_model->find($kd_brg);
            if($barang->diskon <= 0){
                $total = $barang->harga;
            }
            else{
                $diskon = $barang->harga * ($barang->diskon / 100);
                $total = $barang->harga - $diskon;
            }
			$data = array(
			   'id'   	=> $barang->kd_brg,
			   'qty'    => 1,
			   'price'  => $total,
			   'name'   => $barang->nama
			);

			$this->cart->insert($data);
			redirect('user');
    }
    // home keranjang saya
    public function keranjang_saya(){
        $this->user_model->secure(); // session login
        $data['judul'] = 'Keranjang Saya';

        $this->load->view('layout/header',$data);
        $this->load->view('user/keranjang',$data);
        $this->load->view('layout/footer');
    }
    // function delete cart
    public function hapus_keranjang()
		{
            $this->user_model->secure(); // session login
			$this->cart->destroy();
			redirect('user');
        }
    
    // home transaksi
    public function transaksi(){
        $this->user_model->secure(); // session login
        $data['judul'] = 'Proses Transaksi';

        $data['provinsi'] = $this->user_model->getAllProvinsi();
        $data['jasa']     = $this->user_model->getAllJasa();
        $data['kode']     = $this->user_model->kodeResi();

        $this->load->view('layout/header',$data);
        $this->load->view('user/transaksi',$data);
        $this->load->view('layout/footer');
    }

    public function listKota(){
        // Ambil data ID Provinsi yang dikirim via ajax post
        $kd_prov = $this->input->post('kd_prov');
        
        $kota = $this->user_model->getKotaByProv($kd_prov);
        
        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>Select Kota</option>";
        
        foreach($kota as $data){
          $lists .= "<option value='".$data->kd_kota."'>".$data->nama_kota."</option>"; // Tambahkan tag option ke variabel $lists
        }
        
        $callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
      }
      
      public function listJP(){
        // Ambil data ID Provinsi yang dikirim via ajax post
        $kd_jasa = $this->input->post('kd_jasa');
        
        $jp = $this->user_model->getJPByJasa($kd_jasa);
        
        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>Jenis Pengiriman</option>";
        
        foreach($jp as $data){
          $lists .= "<option value='".$data->kd_jp."'>".$data->nama_jp."</option>"; // Tambahkan tag option ke variabel $lists
        }
        
        $callback = array('list_jp'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
      }

      public function listBK(){
        // Ambil data ID Provinsi yang dikirim via ajax post
        $kd_jp   = $this->input->post('kd_jp');
        
        $bk = $this->user_model->getBKByJP($kd_jp);
        
        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>Biaya Pengiriman</option>";
        
        foreach($bk as $data){
          $lists .= "<option value='".$data->kd_bk."'>".$data->biaya_kirim."</option>"; // Tambahkan tag option ke variabel $lists
        }
        
        $callback = array('list_bk'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
      }

    // tampilan jika pesanan berhasil di pesan
    public function resi(){
        $this->user_model->secure(); // session login
        $data['judul'] = 'Resi Pemesanan';
        
        $data['nama']      = $this->input->post('nama_pemesan1');
        $data['alamat']    = $this->input->post('alamat1');
        $data['kd_resi']   = $this->input->post('kd_resi1');
        $data['kd_prov']   = $this->input->post('kd_prov1');
        $data['bk_kota']   = $this->user_model->getBiayaKota($this->input->post('kd_kota1'));
        $data['kd_kota']   = $this->input->post('kd_kota1');
        $data['kd_jasa']   = $this->input->post('kd_jasa1');
        $data['kd_jp']     = $this->input->post('kd_jp1');
        $data['bk_bk']     = $this->user_model->getBiayaKirim($this->input->post('kd_bk1'));
        $data['kd_bk']     = $this->input->post('kd_bk1');
		
		$this->form_validation->set_rules('kd_resi', 'Kode Resi', 'required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan ', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Pemesan ', 'required');
        $this->form_validation->set_rules('kd_prov', 'Provinsi ', 'required');
        $this->form_validation->set_rules('kd_kota', 'Kota ', 'required');
        $this->form_validation->set_rules('kd_jasa', 'Jasa Pengiriman ', 'required');
        $this->form_validation->set_rules('kd_jp', 'Jenis Pengiriman ', 'required');
        $this->form_validation->set_rules('kd_bk', 'Biaya Kirim ', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('layout/header',$data);
					$this->load->view('user/resi',$data);
					$this->load->view('layout/footer');
                }
                else
                {
                    $proses = $this->invoice_model->index();
					if($proses){
					$this->cart->destroy();
					$this->session->set_flashdata('flash','Transaksi ');
					redirect(base_url('user'));
					}   
					else{
						echo "Pesanan anda gagal";
					}
                } 
	}

    // home Pesanan Saya
    public function pesanan($id){
        $this->user_model->secure(); // session login
        $data['judul'] = 'Pesanan Saya';
        
        $data['invoice'] = $this->invoice_model->getInvoiceByUser($id);

        $this->load->view('layout/header',$data);
        $this->load->view('user/pesanan',$data);
        $this->load->view('layout/footer');
    }

    // home Detail Pesanan Saya
    public function detail_pesanan($id){
        $this->user_model->secure(); // session login
        $data['judul']     = 'Detail Pesanan';
        $data['pemesanan'] = $this->invoice_model->getIdPemesanan($id);     
        $data['status']    = $this->invoice_model->getIdStatus($id);  

        $this->form_validation->set_rules('id', 'Id Trans', 'required');
        $this->form_validation->set_rules('kd_status', 'Kode Status', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                    
                    $this->load->view('layout/header',$data);
                    $this->load->view('user/detailPesanan', $data);
                    $this->load->view('layout/footer');
                }
                else
                {
                   
                    $this->invoice_model->KonfirmasiBarang($id_trans);  
                    $this->session->set_flashdata('flash','Berhasil');
                    redirect(base_url('user/pesanan/'.$this->session->userdata('kd_konsumen')));
                }    
	}
	
	  // home profile admin
    public function profile($idUser){
        $this->user_model->secure();

        $data['judul'] = 'Profile';
        $data['user'] = $this->user_model->getKonsumenById($idUser);

        $this->load->view('layout/header',$data);
        $this->load->view('user/profile',$data);
        $this->load->view('layout/footer');
    }

    // home ubah profile user
    public function ubah_profile($idUser){
        $this->user_model->secure();

        $data['judul'] = 'Halaman Ubah Profile';
        $data['user']     = $this->user_model->getKonsumenById($idUser);
        $data['provinsi'] = $this->user_model->getAllProvinsi();

        $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required');
        $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required');
        $this->form_validation->set_rules('kd_prov', 'Kode Provinsi', 'required');
        $this->form_validation->set_rules('kd_kota', 'Kode Kota', 'required');
        $this->form_validation->set_rules('kd_pos', 'Kode POs', 'required');
        $this->form_validation->set_rules('telp', 'No HP', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                    
                    $this->load->view('layout/header',$data);
                    $this->load->view('user/ubah-profile', $data);
                    $this->load->view('layout/footer');
                }
                else
                {
                    $this->user_model->ubahProfile($idUser);
                    $this->session->set_flashdata('flash','Diubah');
                    redirect(base_url('user/profile/') . $this->session->userdata('kd_konsumen'));
                }       
    }
}

?>
