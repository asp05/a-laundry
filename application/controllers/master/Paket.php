<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {
	function __construct($foo = null)
	{
		parent::__construct();
		$this->load->model('mod_paket');
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
	}
	public function index()
	{
		$data = array(
			'judul'	=> 'Master Paket',
			'outlet'=> $this->mc->mengambil('outlet')->result(),
			'jenis'=> $this->mc->mengambil('jenis')->result(),
			'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
		);
		$this->andi->sugara('master/paket/index',$data);
	}
	public function ajax_list()
	{
		$list 	= $this->mod_paket->get_datatables();
		$no 	= $_POST['start'];
		$data 	= array();
		foreach ($list as $x) {
			$no++;
			$row 	= array();
			$row[]	= $no;
			$row[]	= $x->nama;
			$row[]	= $x->nama_jenis;
			$row[]	= $x->nama_paket;
			$row[]	= 'Rp.'.number_format($x->harga,2);
			$row[]	= $this->btn($x);
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_paket->count_all(),
			"recordsFiltered" => $this->mod_paket->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	private function btn($x)
	{
		$button = '<div class="dropdown">';
		$button .= '<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
		$button .= 'Aksi';
		$button .= '</button>';
		$button .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
		$button 	.= '<a href="'.base_url('master/paket/edit/' .base64_encode($x->id_paket)).'" class="dropdown-item" title="">Edit</a>';
		$button 	.= '<a href="'.base_url('master/paket/delete/' .base64_encode($x->id_paket)).'" class="dropdown-item hapus" title="">Hapus</a>';
		$button .= '</div>';
		$button .= '</div>';
		$button .= "<script>
				$('.hapus').on('click',function(e) {
				    e.preventDefault();
				    const href = $(this).attr('href')
				    Swal.fire({
				      title : 'Apakah anda yakin hapus?',
				      type  : 'warning',
				      showCancelButton : true,
				      confirmButtonColor: '#3085d6',
				      cancelButtonColor: '#d33',
				      confirmButtonText: 'Hapus',
				      cancelButtonText: 'Batal'
				    }).then((result) => {
				      if (result.value) {
				        document.location.href = href;
				      }
				    })
			  	})
		</script>";
		return $button;
	}
	public function tambah()
	{
		$this->validasi();
		if ($this->form_validation->run() == false) {
			$data = array(
				'judul'	=> 'Tambah Paket',
				'outlet'=> $this->mc->mengambil('outlet')->result(),
				'jenis'=> $this->mc->mengambil('jenis')->result(),
				'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
			);
			$this->andi->sugara('master/paket/tambah',$data);
		}else{
			$data = array(
				'id_outlet' 	=> $this->input->post('outlet'),
				'jenis_paket'	=> $this->input->post('jenis_paket'),
				'nama_paket'	=> $this->input->post('nama_paket'),
			);
			$v = $this->mc->mengambil('paket',$data);
			if ($v->num_rows() > 0) {
				$data = array(
					'judul'	=> 'Tambah Paket',
					'outlet'=> $this->mc->mengambil('outlet')->result(),
					'jenis'=> $this->mc->mengambil('jenis')->result(),
					'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
				);
				$this->session->set_flashdata('error', 'sudah tersedia di outlet');
				$this->andi->sugara('master/paket/tambah',$data);
			}else{
				$data['harga'] = $this->input->post('ha');
				$this->mc->simpan('paket',$data);
				$this->session->set_flashdata('paket', 'berhasil ditambahkan');
				redirect('master/paket','refresh');
			}
		}
	}
	public function ambilJenis()
	{
		$nama = $this->input->post('nama_paket');
		$jenis = $this->input->post('jenis_paket');

		if ($nama == 'satuan') {
			$paket = $this->mc->satuan('jenis',['id_jenis_paket' => $jenis])->row_array();
		}
		if ($nama == 'kiloan') {
			$paket = $this->mc->kiloan('jenis',['id_jenis_paket' => $jenis])->row_array();
		}
		$data = array('data' => $paket);
		echo json_encode($data);
		
	}
	private function validasi()
	{
		$this->form_validation->set_rules('outlet', 'outlet', 'trim|required');
		$this->form_validation->set_rules('nama_paket', 'nama paket', 'trim|required');
		$this->form_validation->set_rules('jenis_paket', 'jenis paket', 'trim|required');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
	}
	private function valid()
	{
		$this->form_validation->set_rules('harga', 'harga', 'trim|required|numeric');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		$this->form_validation->set_message('number','{field} hanya bisa dengan angka');
	}
	public function delete($id)
	{
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$id = base64_decode($id);
			$data = $this->mc->menghapus('paket',['id_paket' => $id]);
			if ($data['status'] == 'berhasil') {
				$this->session->set_flashdata('paket', 'berhasil dihapus');
				redirect('master/paket','refresh');
			}
			$this->db->db_debug = $db_debug;
			$db_error = $this->db->error();
			if ($db_error) {
				$this->session->set_flashdata('eror', 'gagal dihapus');
				redirect('master/paket','refresh');
			}
		} catch (Exception $e) {
			echo "error";	
		}
	}
	public function edit($id)
	{
		$this->valid();
		if ($this->form_validation->run() == false) {
			$id = base64_decode($id);
			$data = array(
				'judul'	=> 'Edit Paket',
				'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
				'outlet'=> $this->mc->mengambil('outlet')->result(),
				'jenis'=> $this->mc->mengambil('jenis')->result(),
				'paket'=> $this->mc->mengambil('paket',['id_paket' => $id])->row_array()
			);
			$this->andi->sugara('master/paket/edit',$data);
		}else{
			$id = base64_decode($id);
			$data = array(
				'harga'	=> $this->input->post('harga')
			);
			$q = $this->mc->ubah('paket',$data,['id_paket' => $id]);
			if ($q['status'] == 'berhasil') {
				$this->session->set_flashdata('paket', 'berhasil di ubah');
				redirect('master/paket','refresh');
			}else{
				$this->session->set_flashdata('eror', 'berhasil di ubah');
				redirect('master/paket','refresh');
			}
		}
	}

}

/* End of file Paket.php */
/* Location: ./application/controllers/master/Paket.php */