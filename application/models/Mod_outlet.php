<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_outlet extends CI_Model {
	var $table = 'outlet';
	var $column_order 	= array('nama','alamat','tlp', null);
	var $column_search 	= array('nama','alamat','tlp');
	var $order 			= array('id_outlet'=>'asc');

	private function _get_datatables_query()
	{
		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) -1 == $i)
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
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function ambilPaket($table,$where,$wheree)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where($wheree);
		return $this->db->get();
	}
	public function ambilHarga($table,$where,$wheree,$whereee)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where($wheree);
		$this->db->where($whereee);
		return $this->db->get();
	}
	public function ambilSementara()
	{
		$this->db->select('*');
		$this->db->from('sementara');
		$this->db->join('jenis', 'sementara.id_jenis_paket = jenis.id_jenis_paket', 'left');
		$this->db->where('id_user', $this->session->userdata('id'));
		return $this->db->get();
	}

}

/* End of file Mod_outlet.php */
/* Location: ./application/models/Mod_outlet.php */