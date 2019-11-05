<?php 
    class userModel extends CI_Model{

        public function __construct()
        {
            parent::__construct();
        }

        public function getAllBarang(){
            $this->db->order_by('barang.kd_brg', 'ASC');
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->join('kategori', 'kategori.kd_kategori=barang.kd_kategori');
            $this->db->join('det_barang', 'det_barang.kd_brg=barang.kd_brg');
            return $this->db->get();
        }

        public function getAllBiayaKirim($id){
            $this->db->order_by('kd_bk', 'ASC');
            $this->db->select('biaya_kirim');
            $this->db->from('biaya_kirim');
            $this->db->where('kd_bk', $id);
            return $this->db->get()->row();
        }

        public function getAllBiayaKota($id){
            $this->db->order_by('kd_kota', 'ASC');
            $this->db->select('biaya_kirim');
            $this->db->from('kota');
            $this->db->where('kd_kota', $id);
            return $this->db->get()->row();
	    }

        public function getAllKategori(){
            
            return $this->db->get('kategori')->result_array();
        }

        public function getAllUser(){
            
            return $this->db->get('konsumen')->result_array();
        }

        public function getDetBarang($kd_brg){
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->join('det_barang', 'det_barang.kd_brg=barang.kd_brg');
            $this->db->where('barang.kd_brg', $kd_brg);
            return $this->db->get()->row_array();
        }

        public function getBarangByID($kd_brg){
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->join('kategori', 'kategori.kd_kategori=barang.kd_kategori');
            $this->db->where('barang.kd_brg', $kd_brg);
            return $this->db->get()->row_array();
		}

		public function getKonsumenById($idUser){
            
            return $this->db->get_where('konsumen', ['kd_konsumen' => $idUser])->row_array();
        }
        // Cart
        public function find($kd_brg)
		{
			$result = $this->db->where('kd_brg', $kd_brg)
							   ->limit(1)
							   ->get('barang');

			if($result->num_rows() > 0){
				return $result->row();
			}else{
				return array();
			}
        }
        
        public function tampilJmlKategori(){
            $this->db->select('*, COUNT(barang.kd_kategori) as total');
            $this->db->join('kategori', 'barang.kd_kategori=kategori.kd_kategori');
            $this->db->group_by('barang.kd_kategori'); 
            $this->db->order_by('total', 'ASC'); 
                   
            $hasil = $this->db->get('barang');
            return $hasil;
        }

        public function getKategoriByID($kd_kategori){
            $this->db->select('*');
            $this->db->from('kategori');
            $this->db->join('barang','barang.kd_kategori=kategori.kd_kategori');
            $this->db->join('det_barang', 'det_barang.kd_brg=barang.kd_brg');
            $this->db->where('barang.kd_kategori',$kd_kategori);

            return $this->db->get();
        }

		// Search
        public function productKeyword(){
            $keyword = $this->input->post('keyword', true);
            $this->db->like('nama', $keyword);
            $this->db->or_like('kd_kategori', $keyword);
        
            return $this->db->get('barang');
        }
		// Chainned Box
        public function getAllProvinsi(){
            $this->db->order_by('nama_prov','ASC');
            return $this->db->get('provinsi')->result_array();
        }

        public function getAllKota(){
            $this->db->order_by('nama_kota','ASC');
            return $this->db->get('kota')->result_array();
        }

        public function getAllJasa(){
            $this->db->order_by('nama_jasa','ASC');
            return $this->db->get('jasa_pengiriman')->result_array();
        }

        public function getKotaByProv($kd_prov){
            $this->db->where('kd_prov', $kd_prov);
            $result = $this->db->get('kota')->result(); // Tampilkan semua data kota berdasarkan id provinsi
            
            return $result;
        }
        
        public function getJPByJasa($kd_jasa){
            $this->db->where('kd_jasa', $kd_jasa);
            $result = $this->db->get('jenis_pengiriman')->result(); // Tampilkan semua data kota berdasarkan id provinsi
            
            return $result;
            
        }
        public function getBKByJP($kd_jp){
            $this->db->where('kd_jp', $kd_jp);
            $result = $this->db->get('biaya_kirim')->result(); // Tampilkan semua data kota berdasarkan id provinsi
            
            return $result;
        }
		
		// CRUD
        public function ubahProfile($idUser){
            $idUser = $this->input->post('kd_konsumen');
                $data = [
                    'email'           => $this->input->post('email', true),
                    'nama_depan'      => $this->input->post('nama_depan', true),
                    'nama_belakang'   => $this->input->post('nama_belakang', true),
                    'username'        => $this->input->post('username', true),
                    'no_hp'           => $this->input->post('no_hp', true)
            ];

            $this->db->where('kd_konsumen', $idUser);
            $this->db->update('konsumen', $data);
		}
		
        // AI VARCHAR
        public function kodeResi(){
            $this->db->select('RIGHT(transaksi.kd_resi,2) as kd_resi', FALSE);
            $this->db->order_by('kd_resi','DESC');
            $this->db->limit(1);
            $query = $this->db->get('transaksi');

            if($query->num_rows() <> 0){
                $data = $query->row();
                $kode = intval($data->kd_resi) + 1;
            }
            else{
                $kode = 1;
            }
            $batas = str_pad($kode,6,"0",STR_PAD_LEFT);
            $kodetampil = "RES".$batas;
            return $kodetampil;
        }

        public function secure(){
            if($this->session->userdata('status') != 'login' ){ 
                redirect(base_url('auth/login'));
            }
        }
    }

?>
