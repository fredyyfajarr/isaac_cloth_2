<?php 
    class authModel extends CI_Model{
        // REGISTER
        public function Registrasi(){
            $data = [
                'kd_konsumen'   => $this->input->post('kd_konsumen', true),
                'email'         => $this->input->post('email', true),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama_depan'    => $this->input->post('nama_depan', true),
                'nama_belakang' => $this->input->post('nama_belakang', true),
                'username'      => $this->input->post('username', true),
                'kd_prov'       => $this->input->post('kd_prov', true),
                'kd_kota'       => $this->input->post('kd_kota', true),
                'alamat'        => $this->input->post('alamat', true),
                'kd_pos'        => $this->input->post('kd_pos', true),
                'telp'          => $this->input->post('telp', true),
                'role_id'       => 2
            ];
        
        $this->db->insert('konsumen', $data);
        }
        
        public function getAllProvinsi(){
            $this->db->order_by('nama_prov','ASC');
            return $this->db->get('provinsi')->result_array();
        }

        public function getKotaByProv($kd_prov){
            $this->db->where('kd_prov', $kd_prov);
            $result = $this->db->get('kota')->result(); // Tampilkan semua data kota berdasarkan id provinsi
            
            return $result;
        }

        // LOGIN
        public function Login(){

            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            
            $user     = $this->db->where('email', $email )->or_where('username',$email)->get('konsumen')->row_array();

            // jika user ada
            if($user){
                    // cek password
                    if(password_verify($password, $user['password'])){
                        $data = [
                            'kd_konsumen'   => $user['kd_konsumen'],  
                            'nama_depan'    => $user['nama_depan'],
                            'nama_belakang' => $user['nama_belakang'],
                            'username'      => $user['username'],
                            'email'         => $user['email'],
                            'role_id'       => $user['role_id'],
                            'status'        => 'login'
                        ];

                        $this->session->set_userdata($data);
                        
                        if($this->session->userdata('role_id') == 1){
                            redirect(base_url('admin'));
                        }
                        else if($this->session->userdata('role_id') == 2){
                            redirect(base_url('user'));
                        }
                      
                    }
                    else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password Salah</div>');
                        redirect('auth/login'); 
                    }
                }

            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Akun anda belum diregistrasi!</div>');
                redirect('auth/login'); 
                }   
        }

        // SECURE SESSIONs
        public function secure(){
            if($this->session->userdata('status') == 'login'){ 
                if($this->session->userdata('role_id') == 1){
                    redirect(base_url('admin'));
                }
                else if($this->session->userdata('role_id') == 2){
                    redirect(base_url('user'));
                }
            }
        }

        // AI kode
        public function kodeKonsumen(){
            $this->db->select('RIGHT(konsumen.kd_konsumen,2) as kd_konsumen', FALSE);
            $this->db->order_by('kd_konsumen','DESC');
            $this->db->limit(1);
            $query = $this->db->get('konsumen');

            if($query->num_rows() <> 0){
                $data = $query->row();
                $kode = intval($data->kd_konsumen) + 1;
            }
            else{
                $kode = 1;
            }
            $batas = str_pad($kode,6,"0",STR_PAD_LEFT);
            $kodetampil = "KSM".$batas;
            return $kodetampil;
        }

    } 
?>