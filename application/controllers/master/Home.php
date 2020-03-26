<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
	}
	public function index()
	{
		$data = array(
			'judul'	=> 'Home',
			'userr'	=> $this->mc->mengambil('user')->num_rows(),
			'jenis'	=> $this->mc->mengambil('jenis')->num_rows(),
			'outlet'=> $this->mc->mengambil('outlet',FALSE)->num_rows(),
			'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
		);
		$this->andi->sugara('master/home',$data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/master/Home.php */