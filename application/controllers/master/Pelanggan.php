<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
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
			'judul'	=> 'Master Pelanggan',
		);
		$this->andi->sugara('master/pelanggan/index',$data);
	}

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/master/Pelanggan.php */