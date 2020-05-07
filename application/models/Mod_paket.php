<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_paket extends CI_Model {

	var $table = 'paket';
	var $column_order = array('nama','nama_jenis','nama_paket','harga',null);
	var $column_search = array('nama','nama_jenis','nama_paket','harga');
	var $order = array('paket.id_outlet' => 'asc');

	private function join()
	{
		$this->db->select('*');
		$this->db->from('paket');
		$this->db->join('outlet', 'paket.id_outlet = outlet.id_outlet', 'left');
		$this->db->join('jenis', 'paket.jenis_paket = jenis.id_jenis_paket', 'left');
	}
	public function _get_datatable()
	{
		if ($this->input->post('outlet') != '' || $this->input->post('outlet') != null) {
			$this->db->where('nama', $this->input->post('outlet'));
		}
		if ($this->input->post('jenis') != '' || $this->input->post('jenis') != null) {
			$this->db->like('nama_jenis', $this->input->post('jenis'));
		}
		if ($this->input->post('nama') != '' || $this->input->post('nama') != null) {
			$this->db->where('nama_paket', $this->input->post('nama'));
		}
		$this->db->from($this->join());
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) -1 == $i) 
					$this->db->group_end();
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}elseif (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables()
	{
		$this->_get_datatable();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatable();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function updateQty($table,$data1,$data2,$data3,$pos)
	{
		$this->db->set('qty','qty+'.$pos,FALSE);
		$this->db->where($data2);
		$this->db->where($data3);
		$this->db->where($data1);
		if ($this->db->update($table)) {
			return array('status' => 'berhasil');	
		}else{
			return array('status' => 'gagal');	
		}
	}
	public function ambilQTY($table,$data1,$data2,$data3)
	{
		$this->db->where($data2);
		$this->db->where($data3);
		$this->db->where($data1);
		return $this->db->get($table);
	}
}

/* End of file Mod_paket.php */
/* Location: ./application/models/Mod_paket.php */