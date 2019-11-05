<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('authModel');
        $this->load->library('form_validation');
    }

    public function daftar(){
        $data['judul'] = 'Halaman Register';
        $this->authModel->secure();
        $data['kode']     = $this->authModel->kodeKonsumen();
        $data['provinsi'] = $this->authModel->getAllProvinsi();

        $this->form_validation->set_rules('kd_konsumen', 'KD Konsumen', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[24]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Konfirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[16]');
        $this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|max_length[16]');
        $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required|max_length[16]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[50]');
        $this->form_validation->set_rules('kd_pos', 'KD POS', 'required|max_length[5]');
        $this->form_validation->set_rules('telp', 'Telpon', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                    
                    $this->load->view('layout/header',$data);
                    $this->load->view('auth/daftar');
                    $this->load->view('layout/footer');
                }
                else
                {
                    $this->authModel->Registrasi();
					$this->session->set_flashdata('flash','Didaftarkan');
                    redirect(base_url('auth/login'));
                }       
    }

    public function listKota(){
        // Ambil data ID Provinsi yang dikirim via ajax post
        $kd_prov = $this->input->post('kd_prov');
        
        $kota = $this->authModel->getKotaByProv($kd_prov);
        
        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>Select Kota</option>";
        
        foreach($kota as $data){
          $lists .= "<option value='".$data->kd_kota."'>".$data->nama_kota."</option>"; // Tambahkan tag option ke variabel $lists
        }
        
        $callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
      }
    

    public function login(){
        $data['judul'] = 'Halaman Login';
        $this->authModel->secure();

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password1', 'required');

        if ($this->form_validation->run() == FALSE)
                {
                    
                    $this->load->view('layout/header',$data);
                    $this->load->view('auth/login');
                    $this->load->view('layout/footer');
                }
                else
                {
                    $this->authModel->Login();
                }   

    }

    function logout(){ 
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->sess_destroy();
        redirect('auth/login');
    }
    
}
?>
