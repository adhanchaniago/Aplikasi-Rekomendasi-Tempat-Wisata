<?php
class Model_jarak extends CI_Model{
	
	public function getjarak() {
		$data = $this->db->query('SELECT jarak.`id` as id, jarak.`id_wisata` AS id_wisata, wisata.`nama` AS nama, jarak.`jarak` AS jarak FROM jarak JOIN wisata ON wisata.`id` = jarak.`id_wisata` order by wisata.`id`');
		return $data;
	}

	public function simpanjarak($table, $data){
		return $this->db->insert($table, $data);
	}

	public function edit_jarak($where= "") {
		$data = $this->db->query('SELECT jarak.`id` as id, jarak.`id_wisata` AS id_wisata, wisata.`nama` AS nama, jarak.`jarak` AS jarak FROM jarak JOIN wisata ON wisata.`id` = jarak.`id_wisata` '.$where);
		return $data;
	}

	public function update_jarak($data){
        $this->db->where('id',$data['id']);
        $this->db->update('jarak',$data);
    }

    public function Hapus($table,$where){
		return $this->db->delete($table,$where);
	}

	public function getKriteria() {
		$data = $this->db->query('SELECT * FROM kriteria_jarak');
		return $data;
	}

	public function getDerajat() {
		$data = $this->db->query('SELECT wisata.`nama` AS nama, jarak.`jarak` AS jarak, jarak.`dekat` AS dekat, jarak.`sedang` AS sedang, jarak.`jauh` AS jauh FROM jarak JOIN wisata ON wisata.`id` = jarak.`id_wisata`');
		return $data;
	}
}
