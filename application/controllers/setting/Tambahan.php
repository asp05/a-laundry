<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambahan extends CI_Controller {
	function __construct($foo = null)
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
	}
	public function index()
	{
		$data = array(
			'judul'	=> 'Tambahan Bayaran',
			'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
			'pajak'	=> $this->mc->mengambil('pajak')->result()
		);
		$this->andi->sugara('master/tambahan/index',$data);
	}
	public function edit()
	{
		$a = $this->input->post('id');
		$id = base64_decode($a);
		$data['pajak'] = $this->mc->mengambil('pajak',['id_pajak' => $id])->row_array();

		$this->load->view('master/tambahan/edit_pajak', $data);
	}

}

/* End of file Tambahan.php */
/* Location: ./application/controllers/setting/Tambahan.php */