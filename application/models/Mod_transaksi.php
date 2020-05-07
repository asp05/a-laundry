<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_transaksi extends CI_Model {

	var $table = 'tbl_transaksi';
	var $column_search = array('kode_invoice','nama','status','status_bayar','bayar_awal');
	var $column_order = array('nama','status','status_bayar','bayar_awal',null);
	var $order = array('tbl_transaksi.id_transaksi' => 'desc');
	private function _get_dataTables()
	{
		$this->join();
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
			$this->db->group_by($this->column_order[$_POST['order']['0']['column']],[$_POST['order']['0']['dir']]);
		}elseif (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_dataTables()
	{
		$this->_get_dataTables();
		if ($_POST['length'] != 1)
		$this->db->limit($_POST['length'],$_POST['start']);
		$query = $this->db->get();
		return $query->result();	
	}
	public function count_filtered()
	{
		$this->_get_dataTables();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	private function join()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('detail_transaksi', 'tbl_transaksi.id_transaksi = detail_transaksi.id_transaksi', 'left');
		$this->db->group_by('kode_invoice');
	}
	public function updateStatus($table,$data,$id)
	{
		$this->db->where($id);
		return $this->db->update($table, $data);
	}
	public function ambilStruk($id)
	{
		$this->db->select('t.id_transaksi,t.kode_invoice,t.nama as nama_member,t.alamat as alamat_member,t.tlp as tlp_member,t.tgl_mulai,t.batas_waktu,t.biaya_tambahan,t.diskon,t.pajak,t.bayar_awal,t.status_bayar,t.tgl_bayar,dt.satuan,dt.qty,dt.keterangan,o.nama,o.alamat,o.tlp,u.nama_user,p.nama_paket,j.nama_jenis');
		$this->db->from('tbl_transaksi as t');
		$this->db->join('detail_transaksi as dt', 't.id_transaksi = dt.id_transaksi', 'left');
		$this->db->join('outlet as o', 't.id_outlet = o.id_outlet', 'left');
		$this->db->join('user as u', 't.id_user = u.id_user', 'left');
		$this->db->join('paket as p', 'dt.id_paket = p.id_paket', 'left');
		$this->db->join('jenis as j', 'p.jenis_paket = j.id_jenis_paket', 'left');
		$this->db->where($id);
		return $this->db->get();
	}
	public function mengambil($table,$data = null)
    {
    	if ($data != null) {
    		$this->db->order_by('id_histori', 'desc');
    		return $this->db->get_where($table,$data);
    	}elseif($data ==null){
    		return $this->db->get($table);
    	}else{
            return array('status' => 'gagal');
        }
    }
    public function updateT($data,$id)
    {
    	$this->db->where($id);
    	return $this->db->update($data, ['status_bayar' => 'dibayar']);
    }
}

/* End of file Mod_transaksi.php */
/* Location: ./application/models/Mod_transaksi.php */