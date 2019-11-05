<?php 
	class invoiceModel extends CI_Model{
		public function index()
		{
			date_default_timezone_set('Asia/Jakarta');
			$nama     = $this->input->post('nama_pemesan');
			$alamat   = $this->input->post('alamat');
			$resi     = $this->input->post('kd_resi');
			$provinsi = $this->input->post('kd_prov');
			$kota     = $this->input->post('kd_kota');
			$jasa     = $this->input->post('kd_jasa');
			$jp       = $this->input->post('kd_jp');
			$bk       = $this->input->post('kd_bk');

			$invoice = array(
				'nama_pemesan'=> $nama,
				'alamat'	  => $alamat,
				'tgl_pesan'   => date('Y-m-d H:i:s'),
				'batas_bayar' => date('Y-m-d H:i:s', mktime( date('H'), date('i'), date('s'), date('m'), date('d')+1, date('Y') )),
				'kd_status'   => 1,
				'kd_konsumen' => $this->session->userdata('kd_konsumen'),
				'kd_resi'     => $resi,
				'kd_prov'     => $provinsi,
				'kd_kota'     => $kota,
				'kd_jasa'     => $jasa,
				'kd_jp'       => $jp,
				'kd_bk'       => $bk
			);

			$this->db->insert('transaksi', $invoice);
			$idInvoice = $this->db->insert_id();

			foreach ($this->cart->contents() as $i) {
				$data = array(
					'id_invoice' => $idInvoice,
					'kd_brg' => $i['id'],
					'nama' => $i['name'],
					'jumlah' => $i['qty'],
					'harga' => $i['price'],
					'total_bayar' => $i['qty'] * $i['price']
				);
				
				$this->db->insert('pemesanan', $data);
			}
			return TRUE;
		}

		public function getAllInvoice()
		{
            $this->db->order_by('id_invoice', 'ASC');
			$this->db->select('*');
            $this->db->from('transaksi');
			$this->db->join('status', 'status.kd_status=transaksi.kd_status');
			
			return $this->db->get()->result();
		}

		public function getInvoiceByUser($id)
		{
            $this->db->order_by('id_invoice', 'ASC');
			$this->db->select('*');
            $this->db->from('transaksi');
			$this->db->join('status', 'status.kd_status=transaksi.kd_status');
			$this->db->where('transaksi.kd_konsumen',$id);
			
			return $this->db->get()->result();
		}

		public function getInvoiceByResi($id)
		{
            $this->db->order_by('id_invoice', 'ASC');
			$this->db->select('*');
            $this->db->from('transaksi');
			$this->db->where('transaksi.kd_resi', $id);
			
			return $this->db->get()->result();
		}

		public function getIdPemesanan($id)
		{

			$this->db->select('*');
            $this->db->from('pemesanan');
			$this->db->join('transaksi', 'transaksi.id_invoice=pemesanan.id_invoice');
			$this->db->where('pemesanan.id_invoice', $id);
			return $this->db->get()->result();
		}
		
		public function getIdStatus($id)
		{
			$this->db->select('*');
            $this->db->from('transaksi');
			$this->db->join('status', 'status.kd_status=transaksi.kd_status');
			$this->db->where('transaksi.id_invoice', $id);
			return $this->db->get()->row_array();
		}

		public function konfirmasiPemesanan($id){
			$id = $this->input->post('id');

			$data = [  
				'kd_status'     => 2
			];

			$this->db->where('id_invoice', $id);
			$this->db->update('transaksi', $data);
		}

		public function konfirmasiBarang($id){
			$id = $this->input->post('id');

			$data = [  
				'kd_status'     => 3
			];

			$this->db->where('id_invoice', $id);
			$this->db->update('transaksi', $data);
		}
		
	}
 ?>
