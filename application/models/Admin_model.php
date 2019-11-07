<?php 
    class Admin_model extends CI_Model{
        // GET ALL DATA DI TABLE
        public function getAllBarang()
        {
            $this->db->order_by('kd_brg', 'ASC');
            $this->db->select('*');
            $this->db->from('barang');
            // include tabel kategori
            $this->db->join('kategori', 'kategori.kd_kategori=barang.kd_kategori');
            return $this->db->get()->result_array();
        }
        
        public function getAllKategori()
        {
            return $this->db->get('kategori')->result_array();
        }
        public function getAllUser()
        {    
            return $this->db->get('konsumen')->result_array();
        }
        
        // GET BY ID
        public function getBarang($kd_brg)
        {
            $this->db->select('*');
            $this->db->from('barang');
            // include tabel kategori by kd_barang
            $this->db->join('kategori', 'kategori.kd_kategori=barang.kd_kategori');
            // include tabel det_barang by kd_barang
            $this->db->join('det_barang', 'det_barang.kd_brg=barang.kd_brg');
            $this->db->where('barang.kd_brg', $kd_brg);
            return $this->db->get()->row_array();
        }
        
        // TAMBAH BARANG 
        public function tambahBarang(){
            $gambar = $_FILES['gambar']['name'];
            if($gambar = ''){

            }
            else{
                $config['upload_path']   = './assets/img';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 1024;
                $config['encrypt_name']  = true;
                $config['overwrite']  = true;

                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('gambar')){
                    echo "Gambar gagal diupload!";
                }
                else{
                    $gambar = $this->upload->data('file_name');
                }
            }

            $data = [
                'kd_brg'          => $this->input->post('kd_brg', true),
                'nama'            => $this->input->post('nama', true),
                'deskripsi'       => $this->input->post('deskripsi', true),
                'harga'           => $this->input->post('harga', true),
                'kd_kategori'     => $this->input->post('kd_kategori', true),
                'bahan'           => $this->input->post('bahan', true),
                'warna'           => $this->input->post('warna', true),
                'keyword'         => $this->input->post('keyword', true),
                'gambar'          => $gambar,
                'diskon'          => $this->input->post('diskon', true)
                ];

            $dataa = [
                'kd_brg'          => $this->input->post('kd_brg', true),
                'ukuran'          => $this->input->post('ukuran', true),
                'berat'           => $this->input->post('berat', true),
                'stok'            => $this->input->post('stok', true)  
            ];

            
            $this->db->insert('barang', $data);
            $this->db->insert('det_barang', $dataa);
        }
        
        // EDIT BARANG
        public function editBarang($kd_brg){
            $kd_brg = $this->input->post('kd_brg');

            $data = [
                'nama'            => $this->input->post('nama', true),
                'deskripsi'       => $this->input->post('deskripsi', true),
                'harga'           => $this->input->post('harga', true),
                'kd_kategori'     => $this->input->post('kd_kategori', true),
                'bahan'           => $this->input->post('bahan', true),
                'warna'           => $this->input->post('warna', true),
                'keyword'         => $this->input->post('keyword', true),
                'diskon'          => $this->input->post('diskon', true)
            ];

            $dataa = [  
                'ukuran'          => $this->input->post('ukuran', true),
                'berat'           => $this->input->post('berat', true),
                'stok'            => $this->input->post('stok', true)  
            ];

            $this->db->where('kd_brg', $kd_brg);
            $this->db->update('barang', $data);

            $this->db->where('kd_brg', $kd_brg);
            $this->db->update('det_barang', $dataa);
        }
        
        // HAPUS BARANG
        public function hapusBarang($kd_brg){
            $this->db->delete('barang', array('kd_brg' => $kd_brg));
        }

        // SECURE SESSIONs
        public function secure(){
            if($this->session->userdata('role_id') != 1){
                redirect(base_url());
            }
        }
    
        // AI VARCHAR
        public function kodeBrg(){
            $this->db->select('RIGHT(barang.kd_brg,2) as kd_brg', FALSE);
            $this->db->order_by('kd_brg','DESC');
            $this->db->limit(1);
            $query = $this->db->get('barang');

            if($query->num_rows() <> 0){
                $data = $query->row();
                $kode = intval($data->kd_brg) + 1;
            }
            else{
                $kode = 1;
            }
            $batas = str_pad($kode,6,"0",STR_PAD_LEFT);
            $kodetampil = "KAT".$batas;
            return $kodetampil;
        }
    }   


    
    
?>
