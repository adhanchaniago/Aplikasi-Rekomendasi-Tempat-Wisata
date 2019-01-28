<?php
class Model_harga extends CI_Model{
	
	public function getHarga() {
		$data = $this->db->query('SELECT harga.`id` as id, harga.`id_wisata` AS id_wisata, wisata.`nama` AS nama, harga.`harga` AS harga FROM harga JOIN wisata ON wisata.`id` = harga.`id_wisata` order by wisata.`id`');
		return $data;
	}

	public function simpanHarga($table, $data){
		return $this->db->insert($table, $data);
	}

	public function edit_harga($where= "") {
		$data = $this->db->query('SELECT harga.`id` as id, harga.`id_wisata` AS id_wisata, wisata.`nama` AS nama, harga.`harga` AS harga FROM harga JOIN wisata ON wisata.`id` = harga.`id_wisata` '.$where);
		return $data;
	}

	public function update_harga($data){
        $this->db->where('id',$data['id']);
        $this->db->update('harga',$data);
    }

    public function Hapus($table,$where){
		return $this->db->delete($table,$where);
	}

	public function getKriteria() {
		$data = $this->db->query('SELECT * FROM kriteria_harga');
		return $data;
	}

	public function getDerajat() {
		$data = $this->db->query('SELECT wisata.`nama` AS nama, harga.`harga` AS harga, harga.`murah` AS murah, harga.`sedang` AS sedang, harga.`mahal` AS mahal FROM harga JOIN wisata ON wisata.`id` = harga.`id_wisata`');
		return $data;
	}
}
