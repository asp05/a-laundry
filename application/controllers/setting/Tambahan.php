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
			'pajak'	=> $this->mc->mengambil('pajak')->result(),
			'diskon'	=> $this->mc->mengambil('diskon')->result()
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
	public function editdiskon()
	{
		$a = $this->input->post('id');
		$id = base64_decode($a);
		$data['diskon'] = $this->mc->mengambil('diskon',['id_diskon' => $id])->row_array();

		$this->load->view('master/tambahan/edit_diskon', $data);
	}
	public function edit_pajak($id)
	{
		$id = base64_decode($id);
		if ($this->input->post('persentase') != null || $this->input->post('persentase') != '') {
			$data['persentase'] = $this->input->post('persentase');
		}else{
			$data['persentase'] = 0;
		}
		$q = $this->mc->ubah('pajak',$data,['id_pajak' => $id]);
		if ($q['status'] == 'berhasil') {
			$this->session->set_flashdata('tambahan', 'pajak berhasil di ubah');
			redirect('setting/tambahan','refresh');
		}else{
			$this->session->set_flashdata('eror', 'pajak gagal diubah');
			redirect('setting/tambahan','refresh');
		}
	}
	public function edit_diskon($id)
	{
		$this->form_validation->set_rules('diskon', 'diskon', 'trim|numeric');
		$this->form_validation->set_rules('tgl_mulai', 'tgl_mulai', 'trim|required');
		$this->form_validation->set_rules('tgl_selesai', 'tgl_selesai', 'trim|required');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		if ($this->form_validation->run()) {
			$id = base64_decode($id);
			if ($this->input->post('diskon') != null || $this->input->post('diskon') != '') {
				$data['diskon'] = $this->input->post('diskon');
			}else{
				$data['diskon'] = 0;
			}
			$data['tgl_mulai'] = $this->input->post('tgl_mulai');
			$data['tgl_selesai'] = $this->input->post('tgl_selesai');
			$q = $this->mc->ubah('diskon',$data,['id_diskon' => $id]);
			if ($q['status'] == 'berhasil') {
				$this->session->set_flashdata('tambahan', 'diskon berhasil di ubah');
				redirect('setting/tambahan','refresh');
			}else{
				$this->session->set_flashdata('eror', 'diskon gagal diubah');
				redirect('setting/tambahan','refresh');
			}
		}else{
			$this->session->set_flashdata('eror', 'diskon gagal diubah');
				redirect('setting/tambahan','refresh');
		}
	}

}

/* End of file Tambahan.php */
/* Location: ./application/controllers/setting/Tambahan.php */