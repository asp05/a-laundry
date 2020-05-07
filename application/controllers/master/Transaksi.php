<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('mod_outlet');
		$this->load->model('mod_paket');
		$this->load->model('mod_transaksi');
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
	}
	public function index()
	{
		$data = array(
			'judul'		=> 'Daftar Pesanan',
			'user'		=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
		);
		$this->andi->sugara('master/pesanan/index',$data);
	}
	public function ajax_list()
	{
		$list 	= $this->mod_transaksi->get_dataTables();
		$no  	= $_POST['start'];
		$data 	= array();
		foreach ($list as $x) {
			$no++;
			$row 	= array();
			$row[]	= $no++;
			$row[]	= $x->kode_invoice;
			$row[]	= $x->nama;
			$tgl_mulai = explode(' ', $x->tgl_mulai);
			$tgl_mulai = $tgl_mulai['0'];
			$row[]	= date_indo($tgl_mulai);
			$row[]	= 'Rp.'.number_format($x->bayar_awal,2);
			if ($x->status_bayar == 'belum bayar') {
				$row[]	= '<button data-toggle="modal" id="modal" onclick="pembayaran('.$x->id_transaksi.')" class="btn btn-danger btn-block" title="">'.$x->status_bayar.'</button>';
			}else{
				$row[]	= '<button class="btn btn-success btn-block" title="">'.$x->status_bayar.'</button>';
			}
			$row[]	= $this->status($x);
				$row[]	= '<a target="blank" href="'.base_url('master/transaksi/print/'.base64_encode($x->id_transaksi)).'" title="" class="btn btn-success" ><i class="fa fa-print"></i></a>';
			$data[]	= $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_transaksi->count_all(),
			"recordsFiltered" => $this->mod_transaksi->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	private function status($x)
	{
		if ($x->status == 'baru') {
			$button = '<a class="btn btn-danger" href="'.base_url('master/transaksi/updateStatus/'.$x->id_transaksi).'" title="update ke cuci">Baru</a>';
		}elseif ($x->status == 'dicuci') {
			$button = '<a class="btn btn-warning" href="'.base_url('master/transaksi/updateStatus/'.$x->id_transaksi).'" title="update ke jemur">Dicuci</a>';
		}elseif ($x->status == 'dijemur') {
			$button = '<a class="btn btn-primary" href="'.base_url('master/transaksi/updateStatus/'.$x->id_transaksi).'" title="update ke selesai">Dijemur</a>';
		}elseif ($x->status == 'selesai') {
			$button = '<a class="btn btn-success" href="'.base_url('master/transaksi/updateStatus/'.$x->id_transaksi).'" title="update ke diambil">Selesai</a>';
		}else{
			$button = '<a class="btn btn-default" title="sudah diambil">diambil</a>';
		}
		return $button;
	}
	public function updateStatus($x)
	{
		$q = $this->mc->mengambil('tbl_transaksi',['id_transaksi' => $x])->row_array();
		$status_bayar = $q['status'];
		switch ($status_bayar) {
			case 'baru':
				$this->mod_transaksi->updateStatus('tbl_transaksi',['status' => 'dicuci'],['id_transaksi' => $x]);
				redirect('master/transaksi','refresh');
				break;
			case 'dicuci':
				$this->mod_transaksi->updateStatus('tbl_transaksi',['status' => 'dijemur'],['id_transaksi' => $x]);
				redirect('master/transaksi','refresh');
				break;
			case 'dijemur':
				$this->mod_transaksi->updateStatus('tbl_transaksi',['status' => 'selesai'],['id_transaksi' => $x]);
				redirect('master/transaksi','refresh');
				break;
			case 'selesai':
				$this->mod_transaksi->updateStatus('tbl_transaksi',['status' => 'diambil'],['id_transaksi' => $x]);
				redirect('master/transaksi','refresh');
				break;
			default:
				$this->session->set_flashdata('gagal', 'tidak ada yang diubah');
				redirect('master/transaksi','refresh');
				break;
		}
	}
	public function tambah()
	{
		$data = array(
			'sementara' 	=> $this->mod_outlet->ambilSementara()->result(),
			'judul'	=> 'Tambah Pesanan',
			'user' 	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
			'member'=> $this->mc->mengambil('member')->result(),
			'paket'	=> $this->mc->mengambil_paket('paket',['id_outlet' => $this->session->userdata('outlet')])->result()
		);
		$this->andi->sugara('master/transaksi/tambah',$data);
	}
	public function ambil_pelanggan()
	{
		$member = $this->input->post('pel');
		$data['user'] = $this->mc->mengambil('member',['id_member' => $member])->row_array();
		if ($data['user']['status'] == 1) {
			$res = array(
				'view'  => $this->load->view('master/transaksi/pelanggan',$data),
			);
			echo json_encode($res);	
		}else{
			$res = array(
				'view' => $this->load->view('master/transaksi/blank'),
			);
			echo json_encode($res);
		}
	}
	public function simpancart()
	{
		$q = $this->mod_paket->ambilQTY('sementara',['id_user' => $this->session->userdata('id')],['id_jenis_paket' => $this->input->post('jenis_paket')],['nama_paket' => $this->input->post('nama_paket')])->num_rows();
		if ($q > 0) {
			$query = $this->mod_paket->updateQTY('sementara',['id_user' => $this->session->userdata('id')],['id_jenis_paket' => $this->input->post('jenis_paket')],['nama_paket' => $this->input->post('nama_paket')],$this->input->post('qty'));
			if ($query['status'] == 'berhasil') {
					echo json_encode(array('data' => 'berhasil'));
				}else{
					echo json_encode(array('data' => 'gagal'));
				}	
		}else{	
			$data = array(
				'id_paket'		=> $this->input->post('id_p'),
				'id_jenis_paket' => $this->input->post('jenis_paket'),
				'harga_satuan' => $this->input->post('harga'),
				'nama_paket' => $this->input->post('nama_paket'),
				'qty' => $this->input->post('qty'),
				'id_user' => $this->session->userdata('id'),
			);
			if ($this->input->post('keterangan') == '' || $this->input->post('keterangan') == null) {
				$data['keterangan']	= '-';
			}else{
				$data['keterangan']	= $this->input->post('keterangan');
			}
			$q = $this->mc->simpan('sementara',$data);
			if ($q['status'] == 'berhasil') {
				echo json_encode(array('data' => 'berhasil'));
			}else{
				echo json_encode(array('data' => 'gagal'));

			}
		}
	}
	public function ambilPaket()
	{
		$outlet = $this->input->post('outlet');
		$jenis_paket = $this->input->post('jenis_paket');
		$q = $this->mod_outlet->ambilPaket('paket',['jenis_paket' => $jenis_paket],['id_outlet' => $outlet])->result();
		echo json_encode(array(
			'data'	=> $q
		));
	}
	public function ambilHarga()
	{
		$outlet = $this->input->post('outlet');
		$jenis_paket = $this->input->post('jenis_paket');
		$nama_paket = $this->input->post('nama_paket');
		$q = $this->mod_outlet->ambilHarga('paket',['jenis_paket' => $jenis_paket],['id_outlet' => $outlet],['nama_paket' => $nama_paket])->row_array();
		echo json_encode(array(
			'data'	=> $q
		));
	}
	public function updateQTY()
	{
		$data = array(
			'qty'	=> $this->input->post('qty'),
		);
		$q = $this->mc->ubah('sementara',$data,['id_sementara' => $this->input->post('id')]);
		if ($q['status'] == 'berhasil') {
			echo json_encode(array('status' => 'berhasil'));
		}else{
			echo json_encode(array('status' => 'berhasil'));
		}
	}
	public function cekDiskon()
	{
		$tgl = date('Y-m-d');
		$q = $this->mc->mengambil('diskon')->row_array();
		if ($tgl >= $q['tgl_mulai'] && $tgl <= $q['tgl_selesai']) {
		 	echo json_encode(array('data' => $q['diskon']));
		 } else{
		 	echo json_encode(array('data' => '0'));
		 }
	}
	public function getPajak()
	{
		$q = $this->mc->mengambil('pajak')->row_array();
		echo json_encode(array('data' => $q));

	}
	public function hapusSementara($id)
	{
		$this->mc->menghapus('sementara',['id_sementara' => $id]);
		redirect('master/transaksi/tambah','refresh');
	}
	public function simpan()
	{
		$this->form_validation->set_rules('nama_member', 'member', 'trim|required',['required' => 'member tidak boleh kosong']);
		if ($this->form_validation->run() == false) {
			$this->tambah();
		}else{
			$data = array(
				'id_outlet'		=> $this->session->userdata('outlet'),
				'kode_invoice'	=> 'LDR'.time(),
				'id_member'		=> $this->input->post('nama_member'),
				'nama'			=> $this->input->post('nama'),
				'tlp'			=> $this->input->post('tlp'),
				'alamat'		=> $this->input->post('alamat'),
				'tgl_mulai'		=> date('Y-m-d H-i-s'),
				'batas_waktu'	=> date('Y-m-d H-i-s',strtotime('+3 days')),
				'diskon'		=> $this->input->post('diskon'),
				'pajak'			=> $this->input->post('pajak'),
				'status'		=> 'baru',
				'id_user'		=> $this->session->userdata('id'),
				'bayar_awal'	=> $this->input->post('bayar')
			);
			$total = explode('.', $this->input->post('total'));
			$total = $total[1].$total[2];
			if ($this->input->post('bayar') >= $total) {
					$data['tgl_bayar']		= date('Y-m-d H-i-s');
					$data['status_bayar']	= 'dibayar';
			}else{
				$data['tgl_bayar']	= '0000-00-00';
				$data['status_bayar']	= 'belum bayar';
			}
			$detail = array();
			$id = $this->mc->simpan('tbl_transaksi',$data);
			$paket = $this->input->post('id_paket');
			foreach ($paket as $index => $x) {
				$detail[] = array(
				'id_transaksi'	=> $id['id'],
				'id_paket'		=> $x,
				'satuan'		=> $this->input->post('satuan')[$index],
				'qty'			=> $this->input->post('qty1')[$index],
				'keterangan'	=> $this->input->post('keterangan')[$index],
				);
			}
			if ($this->mc->simpan2('detail_transaksi',$detail)) {
				$this->session->set_flashdata('berhasil','berhasil membuat pesanan');
				redirect('master/transaksi','refresh');
			};

		}
	}
	public function print($id)
	{
		$id = base64_decode($id);
		$data = array(
			'identitas' => $this->mod_transaksi->ambilStruk(['t.id_transaksi' => $id])->row_array(),
			'struk'		=> $this->mod_transaksi->ambilStruk(['t.id_transaksi' => $id])->result(),
		);
		$this->load->view('master/pesanan/print', $data);
	}
	public function ambilDetail()
	{
		$id = $this->input->post('id');
		$data = array(
			'identitas' => $this->mod_transaksi->ambilStruk(['t.id_transaksi' => $id])->row_array(),
			'struk'		=> $this->mod_transaksi->ambilStruk(['t.id_transaksi' => $id])->result(),
		);
		$this->load->view('master/pesanan/pembayaran', $data);
	}
	public function updateStatusBayar($id)
	{
		$this->mod_transaksi->updateT('tbl_transaksi',['id_transaksi' => $id]);
		$this->session->set_flashdata('berhasil', 'berhasil bayar');
		redirect('master/transaksi','refresh');
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/master/Transaksi.php */