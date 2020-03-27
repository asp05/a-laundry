<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
	function __construct($foo = null)
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
		$this->load->model('mod_pelanggan');
	}
	public function index()
	{
		$data = array(
			'judul'	=> 'Master Pelanggan',
			'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array()
		);
		$this->andi->sugara('master/pelanggan/index',$data);
	}
	function ajax_list()
	{
		$list 	= $this->mod_pelanggan->get_datatables();
		$no 	= $_POST['start'];
		$data 	= array();
		foreach ($list as $x) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $x->nama;  	
			$row[] = $x->jenis_kelamin;  	
			$row[] = $x->tlp;
			$row[] = $this->btn($x);
			$data[]= $row;  	
		}  
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_pelanggan->count_all(),
			"recordsFiltered" => $this->mod_pelanggan->count_filtered(),
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
		$button 	.= '<a href="'.base_url('master/outlet/edit/' .base64_encode($x->id_member)).'" class="dropdown-item" title="">Edit</a>';
		$button 	.= '<a href="'.base_url('master/outlet/delete/' .base64_encode($x->id_member)).'" class="dropdown-item hapus" title="">Hapus</a>';
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
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'judul' => 'Tambah Member',
				'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array()
			);
			$this->andi->sugara('master/pelanggan/tambah',$data);
		} else {
			$data = array(
				'nama'			=> $this->input->post('nama'),
				'alamat'		=> $this->input->post('alamat'),
				'jenis_kelamin'	=> $this->input->post('jenis_kelamin'),
				'tlp'			=> $this->input->post('tlp'),
				'status'		=> 1,
			);
			$q = $this->mc->simpan('member',$data);
			if ($q['status'] == 'berhasil') {
				$this->session->set_flashdata('pelanggan', 'berhasil ditambahkan');
				redirect('master/pelanggan','refresh');
			}else{
				$this->session->set_flashdata('eror', 'gagal ditambahkan');
				redirect('master/pelanggan','refresh');
			}
		}
	}
	public function validasi()
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
		$this->form_validation->set_rules('tlp', 'telepon', 'trim|required|numeric|is_unique[member.tlp]');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		$this->form_validation->set_message('is_unique','{field} sudah tersedia');
		$this->form_validation->set_message('numeric','{field} harus menggunakan karakter angka');
	}

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/master/Pelanggan.php */