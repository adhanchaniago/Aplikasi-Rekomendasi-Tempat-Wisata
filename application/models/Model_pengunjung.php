<?php
class Model_pengunjung extends CI_Model{
	
	public function getpengunjung() {
		$data = $this->db->query('SELECT pengunjung.`id` as id, pengunjung.`id_wisata` AS id_wisata, wisata.`nama` AS nama, pengunjung.`pengunjung` AS pengunjung FROM pengunjung JOIN wisata ON wisata.`id` = pengunjung.`id_wisata` order by wisata.`id`');
		return $data;
	}

	public function simpanpengunjung($table, $data){
		return $this->db->insert($table, $data);
	}

	public function edit_pengunjung($where= "") {
		$data = $this->db->query('SELECT pengunjung.`id` as id, pengunjung.`id_wisata` AS id_wisata, wisata.`nama` AS nama, pengunjung.`pengunjung` AS pengunjung FROM pengunjung JOIN wisata ON wisata.`id` = pengunjung.`id_wisata` '.$where);
		return $data;
	}

	public function update_pengunjung($data){
        $this->db->where('id',$data['id']);
        $this->db->update('pengunjung',$data);
    }

    public function Hapus($table,$where){
		return $this->db->delete($table,$where);
	}

	public function getKriteria() {
		$data = $this->db->query('SELECT * FROM kriteria_pengunjung');
		return $data;
	}

	public function getDerajat() {
		$data = $this->db->query('SELECT wisata.`nama` AS nama, pengunjung.`pengunjung` AS pengunjung, pengunjung.`sepi` AS sepi, pengunjung.`biasa` AS biasa, pengunjung.`ramai` AS ramai FROM pengunjung JOIN wisata ON wisata.`id` = pengunjung.`id_wisata`');
		return $data;
	}
}
