<?php
class Model_fasilitas extends CI_Model{
	
	public function getfasilitas() {
		$data = $this->db->query('SELECT fasilitas.`id` as id, fasilitas.`id_wisata` AS id_wisata, wisata.`nama` AS nama, fasilitas.`fasilitas` AS fasilitas FROM fasilitas JOIN wisata ON wisata.`id` = fasilitas.`id_wisata` order by wisata.`id`');
		return $data;
	}

	public function simpanfasilitas($table, $data){
		return $this->db->insert($table, $data);
	}

	public function edit_fasilitas($where= "") {
		$data = $this->db->query('SELECT fasilitas.`id` as id, fasilitas.`id_wisata` AS id_wisata, wisata.`nama` AS nama, fasilitas.`fasilitas` AS fasilitas FROM fasilitas JOIN wisata ON wisata.`id` = fasilitas.`id_wisata` '.$where);
		return $data;
	}

	public function update_fasilitas($data){
        $this->db->where('id',$data['id']);
        $this->db->update('fasilitas',$data);
    }

    public function Hapus($table,$where){
		return $this->db->delete($table,$where);
	}

	public function getKriteria() {
		$data = $this->db->query('SELECT * FROM kriteria_fasilitas');
		return $data;
	}

	public function getDerajat() {
		$data = $this->db->query('SELECT wisata.`nama` AS nama, fasilitas.`fasilitas` AS fasilitas, fasilitas.`sedikit` AS sedikit, fasilitas.`cukup` AS cukup, fasilitas.`banyak` AS banyak FROM fasilitas JOIN wisata ON wisata.`id` = fasilitas.`id_wisata`');
		return $data;
	}
}
