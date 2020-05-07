<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CekHistori extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('mod_transaksi');
	}
	public function index()
	{
		$this->form_validation->set_rules('invoice', 'invoice', 'trim|required',['required' => 'kode invoice tidak boleh kosong']);
		if ($this->form_validation->run() == FALSE) {
			$this->andi->login('member/cekhistori');
		}else{
			$invoice = $this->input->post('invoice');
			$i = $this->mc->mengambil('tbl_transaksi',['kode_invoice' => $invoice]);
			if ($i->num_rows() > 0 ) {
				$hasil = $i->row_array();
				$this->tampilHistori(base64_encode($hasil['id_transaksi']));
			}else{
				$this->session->set_flashdata('eror', 'kode invoice tidak valid');
				redirect('member/cekHistori','refresh');
			}
		}
	}
	public function tampilHistori($id)
	{
		$id = base64_decode($id);
		$data['histori'] = $this->mod_transaksi->mengambil('histori',['id_transaksi' => $id])->result();
		$this->load->view('member/tampilhistori',$data);
	}

}

/* End of file cekHistori.php */
/* Location: ./application/controllers/member/cekHistori.php */