<?php
class Model_wisata extends CI_Model{
	
	public function getWisata($where= "") {
		$data = $this->db->query('SELECT * FROM wisata'.$where);
		return $data;
	}

	public function getWisata2() {
		$data = $this->db->query('SELECT wisata.*, harga.`harga`, fasilitas.`fasilitas`, pengunjung.`pengunjung`, jarak.`jarak` FROM wisata
			JOIN harga ON wisata.`id` = harga.`id_wisata`
			JOIN fasilitas ON wisata.`id` = fasilitas.`id_wisata`
			JOIN pengunjung ON wisata.`id` = pengunjung.`id_wisata`
			JOIN jarak ON wisata.`id` = jarak.`id_wisata`;');
		return $data;
	}

	public function simpanWisata($table, $data){
		return $this->db->insert($table, $data);
	}

	public function edit_wisata($where= "") {
		$data = $this->db->query('select * from wisata '.$where);
		return $data;
	}

	public function detail_wisata($where= "") {
		$data = $this->db->query('select * from wisata '.$where);
		return $data;
	}

	public function update_wisata($data){
        $this->db->where('id',$data['id']);
        $this->db->update('wisata',$data);
    }

    public function Hapus($table,$where){
		return $this->db->delete($table,$where);
	}

	public function get_fuzzyfikasi($where= "") {
		$data = $this->db->query('SELECT hasil_fuzzy.*, wisata.`nama` AS nama FROM hasil_fuzzy JOIN wisata ON hasil_fuzzy.`id_wisata` = wisata.`id`'.$where);
		return $data;
	}

	public function getCari() {
		$data = $this->db->query('SELECT hasil_pencarian.`id_wisata`,
				hasil_pencarian.`nama` AS nama,  
				wisata.`alamat` AS alamat,
				wisata.`deskripsi` AS deskripsi,
				wisata.`foto` AS foto,
				hasil_pencarian.`firestrength`,
				harga.`harga` AS harga , 
				fasilitas.`fasilitas` AS fasilitas,
				pengunjung.`pengunjung` AS pengunjung,
				jarak.`jarak` AS jarak
			FROM hasil_pencarian 
			JOIN harga ON hasil_pencarian.`id_wisata` = harga.`id_wisata`
			JOIN fasilitas ON hasil_pencarian.`id_wisata` = fasilitas.`id_wisata`
			JOIN pengunjung ON hasil_pencarian.`id_wisata` = pengunjung.`id_wisata`
			JOIN jarak ON hasil_pencarian.`id_wisata` = jarak.`id_wisata`
			JOIN wisata ON hasil_pencarian.`id_wisata` = wisata.`id`
			WHERE firestrength != 0 ORDER BY firestrength DESC;');
		return $data;
	}

	public function detail_wisata2($where= "") {
		$data = $this->db->query('SELECT wisata.`id`,
	wisata.`nama` AS nama,  
	wisata.`alamat` AS alamat,
	wisata.`deskripsi` AS deskripsi,
	wisata.`foto` AS foto,
	harga.`harga` AS harga , 
	fasilitas.`fasilitas` AS fasilitas,
	pengunjung.`pengunjung` AS pengunjung,
	jarak.`jarak` AS jarak
FROM wisata 
JOIN harga ON wisata.`id` = harga.`id_wisata`
JOIN fasilitas ON wisata.`id` = fasilitas.`id_wisata`
JOIN pengunjung ON wisata.`id` = pengunjung.`id_wisata`
JOIN jarak ON wisata.`id` = jarak.`id_wisata` '.$where);
		return $data;
	}

}
