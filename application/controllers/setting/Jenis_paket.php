<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_paket extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('mod_jenis');
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
	}
	public function index()
	{
		$data = array(
			'judul'	=> 'Jenis Paket',
			'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array()
		);
		$this->andi->sugara('master/jenis/index',$data);
	}
	public function ajax_list()
	{
		$list = $this->mod_jenis->get_datatables();
		$data = array();
		$no   = $_POST['start'];
		foreach ($list as $x) {
		 	$row = array();
		 	$no++;
		 	$row[] = $no;
		 	$row[] = ucwords($x->nama_jenis);
		 	$row[] = 'Rp.'.number_format($x->kiloan,2);
		 	$row[] = 'Rp.'.number_format($x->satuan,2);
		 	$row[] = $this->btn($x);
		 	$data[]= $row;
		 }
		 $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_jenis->count_all(),
			"recordsFiltered" => $this->mod_jenis->count_filtered(),
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
		$button 	.= '<a href="'.base_url('setting/jenis_paket/edit/' .base64_encode($x->id_jenis_paket)).'" class="dropdown-item" title="">Edit</a>';
		$button 	.= '<a href="'.base_url('setting/jenis_paket/delete/' .base64_encode($x->id_jenis_paket)).'" class="dropdown-item hapus" title="">Hapus</a>';
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
	private function validasi()
	{
		$this->form_validation->set_rules('nama_jenis', 'jenis', 'trim|required|is_unique[jenis.nama_jenis]');
		$this->form_validation->set_rules('kiloan', 'kiloan', 'trim|required|numeric');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required|numeric');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		$this->form_validation->set_message('numeric','{field} hanya boleh dengan angka');
		$this->form_validation->set_message('is_unique','{field} sudah tersedia');
	}
	public function tambah()
	{
		$this->validasi();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'judul' => 'Tambah Jenis',
				'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array()
			);
			$this->andi->sugara('master/jenis/tambah',$data);
		}else{
			$data = array(
				'nama_jenis' => $this->input->post('nama_jenis'),
				'kiloan'	 =>	$this->input->post('kiloan'),
				'satuan'	 =>	$this->input->post('satuan'),
			);
			$q = $this->mc->simpan('jenis',$data);
			if ($q['status'] == 'berhasil') {
				$this->session->set_flashdata('jenis', 'berhasil ditambahkan');
				redirect('setting/jenis_paket','refresh');
			}else{
				$this->session->set_flashdata('eror', 'gagal ditambahkan');
				redirect('setting/jenis_paket','refresh');
			}
		}
	}
	public function delete($id)
	{
		$id = base64_decode($id);
		$q = $this->mc->menghapus('jenis',['id_jenis_paket'=>$id]);
		if ($q['status'] == 'berhasil') {
			$this->session->set_flashdata('jenis', 'berhasil dihapus');
			redirect('setting/Jenis_paket','refresh');
		}else{
			$this->session->set_flashdata('eror', 'gagal dihapus');
			redirect('setting/Jenis_paket','refresh');
		}
	}
	public function edit($id)
	{
		$this->form_validation->set_rules('kiloan', 'kiloan', 'trim|required|numeric');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required|numeric');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		$this->form_validation->set_message('numeric','{field} hanya boleh dengan angka');
		if ($this->form_validation->run() == false) {
			$id 	= base64_decode($id); 
			$data 	= array(
				'judul'	=> 'Edit Paket',
				'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
				'jenis'	=> $this->mc->mengambil('jenis',['id_jenis_paket' => $id])->row_array()
			);
			$this->andi->sugara('master/jenis/edit',$data);
		}else{
			$data = array(
				'kiloan'	=> $this->input->post('kiloan'),
				'satuan'	=> $this->input->post('satuan'),
			);
			$id = base64_decode($id);
			$q = $this->mc->ubah('jenis',$data,['id_jenis_paket' => $id]);
			if ($q['status'] == 'berhasil') {
				$this->session->set_flashdata('jenis', 'berhasil diubah');
				redirect('setting/jenis_paket','refresh');
			}else{
				$this->session->set_flashdata('eror', 'gagal diubah');
				redirect('setting/jenis_paket','refresh');
			}
		}
	}

}

/* End of file Jenis_paket.php */
/* Location: ./application/controllers/setting/Jenis_paket.php */