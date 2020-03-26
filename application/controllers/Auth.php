<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			redirect('master/home','refresh');
		}
		$this->validasi();
		if ($this->form_validation->run() == false) {
			$this->andi->login('template/login');
		}else{
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');
			$q 			= $this->mc->mengambil('user',["username" => $username])->row_array();
			if ($q) {
			 	if (password_verify($password, $q['password'])) {
			 		$data = array(
			 			'nama' 	=> $q['nama_user'],
			 			'id'	=> $q['id_user'],
			 			'role'	=> $q['role'],
			 		);
			 		$this->session->set_userdata( $data );
			 		$this->session->set_flashdata('berhasil', 'anda berhasil login');
			 		if ($data['role'] == 'admin') {
			 			redirect('master/home','refresh');
			 		}elseif ($data['role'] == 'kasir') {
			 			$this->session->set_flashdata('eror', 'sesi kasir tersedia di dekstop');
			 			redirect('auth','refresh');
			 		}
			 	}else{
			 		$this->session->set_flashdata('eror', 'username/password salah');
			 		redirect('auth','refresh');
			 	}
			 }else{
			 	$this->session->set_flashdata('eror', 'tidak ada user');
			 	redirect('auth','refresh');
			 } 
		}	
	}
	public function validasi()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth','refresh');
		die();
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */