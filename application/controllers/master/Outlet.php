<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('mod_outlet');
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
	}

	public function index()
	{
		$data = array(
			'judul'	=> 'Master Outlet',
			'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
		);
		$this->andi->sugara('master/outlet/index',$data);
	}
	private function button($x)
	{
		$button = '<div class="dropdown">';
		$button .= '<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
		$button .= 'Aksi';
		$button .= '</button>';
		$button .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
		$button 	.= '<a href="'.base_url('master/outlet/edit/' .base64_encode($x->id_outlet)).'" class="dropdown-item" title="">Edit</a>';
		$button 	.= '<a href="'.base_url('master/outlet/delete/' .base64_encode($x->id_outlet)).'" class="dropdown-item hapus" title="">Hapus</a>';
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
	function ajax_list()
	{
		$list 	= $this->mod_outlet->get_datatables();
		$data 	= array();
		$no 	= $_POST['start'];
		foreach ($list as $x) {
			$no++;
			$row 	= array();
			$row[]	= $no;
			$row[]	= $x->nama;
			$row[]	= $x->alamat;
			$row[]	= $x->tlp;
			$row[]	= $this->button($x);
			$data[]	= $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_outlet->count_all(),
			"recordsFiltered" => $this->mod_outlet->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	public function tambah()
	{
		$this->validasi();
		if ($this->form_validation->run() == false) {
			$data = array(
			'judul'	=> 'Tambah Outlet',
			'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
			);
			$this->andi->sugara('master/outlet/tambah', $data);
		}else{
			$data = array(
				'nama'	=> $this->input->post("nama_outlet"),
				'tlp'			=> $this->input->post("tlp"),
				'alamat'		=> $this->input->post("alamat")
			);
			$this->mc->simpan('outlet',$data);
			$this->session->set_flashdata('outlet', 'berhasil ditambahkan');
			redirect('master/outlet','refresh');
		}
	}
	public function validasi()
	{
		$this->form_validation->set_rules('nama_outlet', 'nama outlet', 'required');
		$this->form_validation->set_rules('tlp', 'telpon', 'required|numeric');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		$this->form_validation->set_message('numeric','{field} harus mennggunakan karakter angka');
	}
	public function delete($id)
	{
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$id = base64_decode($id);
			$data = $this->mc->menghapus('outlet',['id_outlet' => $id]);
			if ($data['status'] == 'berhasil') {
				$this->session->set_flashdata('outlet', 'berhasil dihapus');
				redirect('master/outlet','refresh');
			}
			$this->db->db_debug = $db_debug;
			$db_error = $this->db->error();
			if ($db_error) {
				$this->session->set_flashdata('eror', 'gagal dihapus');
				redirect('master/outlet','refresh');
			}
		} catch (Exception $e) {
			echo "error";	
		}
	}
	public function edit($id)
	{
		$this->validasi();
		if ($this->form_validation->run() == false) {
			$id = base64_decode($id);
			$data =  array(
				'judul'		=> 'Edit Outlet',
				'outlet'	=> $this->mc->mengambil('outlet',['id_outlet' => $id])->row_array(),
				'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),	
			);
			$this->andi->sugara('master/outlet/edit',$data);
		}else{
			$id = base64_decode($id);
			$data = array(
				'nama'	=> $this->input->post('nama_outlet'),
				'alamat'	=> $this->input->post('alamat'),
				'tlp'	=> $this->input->post('tlp'),
			);
			$this->mc->ubah('outlet',$data,['id_outlet' => $id]);
			$this->session->set_flashdata('outlet', 'berhasil di ubah');
			redirect('master/outlet','refresh');
		}
	}

}

/* End of file Outlet.php */
/* Location: ./application/controllers/master/Outlet.php */