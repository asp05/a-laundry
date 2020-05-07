<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mod_user');
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth','refresh');
		}
	}
	public function index()
	{
		$data = array(
			'judul'	=> 'Master User',
			'outlet'=> $this->mc->mengambil('outlet')->result(),
			'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
		);
		$this->andi->sugara('master/user/index',$data);
	}
	function ajax_list()
	{
		$list 	= $this->mod_user->get_datatables();
		$no 	= $_POST['start'];
		$data 	= array();
		foreach ($list as $x) {
			$no++;
			$row 	= array();
			$row[]	= $no;
			$row[]	= '<img src="'.base_url('assets/dist/img/'.$x->gambar).'" class="img img-fluid" style="width:100px;" alt="profil user">';
			$row[]	= $x->nama_user;
			$row[]	= $x->nama;
			$row[]	= $x->role;
			$row[]	= $this->button($x);
			$data[]	= $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mod_user->count_all(),
			"recordsFiltered" => $this->mod_user->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	private function button($x)
	{
		$button = '<div class="dropdown">';
		$button .= '<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
		$button .= 'Aksi';
		$button .= '</button>';
		$button .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
		$button 	.= '<a href="'.base_url('master/user/edit/' .base64_encode($x->id_user)).'" class="dropdown-item" title="">Edit</a>';
		$button 	.= '<a href="'.base_url('master/user/delete/' .base64_encode($x->id_user)).'" class="dropdown-item hapus" title="">Hapus</a>';
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
	public function delete($id)
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = FALSE;
		$id = base64_decode($id);
		$q = $this->mc->menghapus('user',['id_user' => $id]);
		if ($q['status'] == 'berhasil') {
			$this->session->set_flashdata('user', 'berhasil dihapus');
			redirect('master/user','refresh');
		}
		$this->db->db_debug = $db_debug;
		$db_error = $this->db->error();
		if ($db_error) {
			$this->session->set_flashdata('eror', 'gagal dihapus');
			redirect('master/user','refresh');
		}
	}
	public function tambah()
	{
		$this->validasi();
		if ($this->form_validation->run() == false) {
			$data = array(
				'judul'	=> 'Tambah User',
				'outlet'=> $this->mc->mengambil('outlet')->result(),
				'user'	=> $this->mc->mengambil_user('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
			);	
			$this->andi->sugara('master/user/tambah',$data);
		}else{
			$this->upload();
			if ( ! $this->upload->do_upload('gambar')){
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('eror', $error);
				redirect('master/user/tambah','refresh');
				return false;
			}
			else{
				$foto = $this->upload->data();
			}
			$data = array(
				'nama_user' => $this->input->post('nama_user'),
				'username'	=> $this->input->post('username'),
				'password'	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'id_outlet'	=> $this->input->post('outlet'),
				'role'		=> $this->input->post('role'),
				'gambar'	=> $foto['file_name']
			);
			$q = $this->mc->simpan('user',$data);
			if ($q['status'] == 'berhasil') {
				$this->session->set_flashdata('user', 'berhasil ditambahkan');
				redirect('master/user','refresh');
			}else{
				$this->session->set_flashdata('eror', 'gagal ditambahkan');
				redirect('master/user','refresh');
			}
		}	
	}
	public function edit($id)
	{
		$id = base64_decode($id);
		$this->valid();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'judul'		=> 'Edit User',
				'user'		=> $this->mc->mengambil_user('user',['id_user'=>$id])->row_array(),
				'outlet'	=> $this->mc->mengambil('outlet')->result(),
				'user'	=> $this->mc->mengambil('user',['nama_user' => $this->session->userdata('nama')])->row_array(),
			);
			$this->andi->sugara('master/user/edit',$data);
		}else{
			$data = array(
				'nama_user' => $this->input->post('nama_user'),
				'username'	=> $this->input->post('username'),
				'id_outlet'	=> $this->input->post('outlet'),
				'role'		=> $this->input->post('role'),
			);
			if ($_FILES['gambar']['name'] != null) {
				$this->upload();
				if ( ! $this->upload->do_upload('gambar')){
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('eror', $error);
					redirect(base_url().'master/user/edit/'.base64_encode($id),'refresh');
					return false;
				}
				else{
					$foto = $this->upload->data();
				}
				$data['gambar'] = $foto['file_name'];
			}else{
				$data['gambar'] = $this->input->post('gbr_lama');
			}
			$q = $this->mc->ubah('user',$data,['id_user' => $id]);
			if ($q['status'] == 'berhasil') {
				$this->session->set_flashdata('user', 'berhasil diubah');
				redirect('master/user','refresh');
			}else{
				$this->session->set_flashdata('eror', 'gagal diubah');
				redirect('master/user','refresh');
			}
		}
	}
	private function upload()
	{
		$config['upload_path']	 	= './assets/dist/img/';
		$config['allowed_types'] 	= 'jpeg|jpg|png|JPEG|JPG|PNG';
		$config['max_size']  		= '2000';
		$config['file_name'] 		= 'usr'.time();
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
	}
	private function validasi()
	{
		$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password1', 'repassword', 'trim|required|matches[password]');
		$this->form_validation->set_rules('outlet', 'outlet', 'trim|required');
		$this->form_validation->set_rules('role', 'posisi', 'trim|required');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		$this->form_validation->set_message('matches','{field} harus match dengan {param}');
		$this->form_validation->set_message('min_length','{field} minimal {param} karakter');
		$this->form_validation->set_message('is_unique','{field} sudah digunakan');
	}
	private function valid()
	{
		$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('outlet', 'outlet', 'trim|required');
		$this->form_validation->set_rules('role', 'posisi', 'trim|required');
		$this->form_validation->set_message('required','{field} tidak boleh kosong');
		$this->form_validation->set_message('matches','{field} harus match dengan {param}');
		$this->form_validation->set_message('min_length','{field} minimal {param} karakter');
		$this->form_validation->set_message('is_unique','{field} sudah digunakan');
	}


}

/* End of file User.php */
/* Location: ./application/controllers/master/User.php */