<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_wisata');
	}

	public function index()
	{
		$this->load->view('user/index');
	}

	public function wisata()
	{
		$data = array('daftar_wisata' => $this->model_wisata->getWisata2()->result_array(),);
		$this->load->view('user/wisata', $data);
	}

	public function cari_wisata(){
		$hapus_data = $this->db->query("TRUNCATE hasil_pencarian");

	    $harga      = $this->input->post('harga');
	    $fasilitas  = $this->input->post('fasilitas');
	    $pengunjung = $this->input->post('pengunjung');
	    $jarak 		= $this->input->post('jarak');

	    $cari_wisata = $this->db->query("
	    	SELECT wisata.`nama`, hasil_fuzzy.`id_wisata` as id_wisata, $harga as kriteria_1, $fasilitas as kriteria_2, $pengunjung as kriteria_3, $jarak as kriteria_4 FROM wisata 
	    	INNER JOIN hasil_fuzzy ON wisata.`id` = hasil_fuzzy.`id_wisata` 
	    	WHERE $harga>=0 
	    	AND $fasilitas>=0 
	    	AND $pengunjung>=0 
	    	AND $jarak>=0 
	    		ORDER BY $harga
	    		AND $fasilitas
	    		AND $pengunjung 
	    		AND $jarak DESC;"
	    );

		foreach ($cari_wisata->result_array() as $row) {
		    $nama       = $row['nama'];
		    $id_wisata  = $row['id_wisata'];
		    $kriteria_1 = $row['kriteria_1'];
		    $kriteria_2 = $row['kriteria_2'];
		    $kriteria_3 = $row['kriteria_3'];
		    $kriteria_4 = $row['kriteria_4'];
		    $id = '';

		    if($kriteria_1<$kriteria_2 AND $kriteria_1<$kriteria_3 AND $kriteria_1<$kriteria_4){
		    	$firestrength = $kriteria_1;
		    }elseif ($kriteria_2<$kriteria_1 AND $kriteria_2<$kriteria_3 AND $kriteria_2<$kriteria_4) {
		    	$firestrength = $kriteria_2;
		    }elseif ($kriteria_3<$kriteria_1 AND $kriteria_3<$kriteria_2 AND $kriteria_3<$kriteria_4) {
		    	$firestrength = $kriteria_3;
		    }elseif ($kriteria_4<$kriteria_1 AND $kriteria_4<$kriteria_2 AND $kriteria_4<$kriteria_3) {
		    	$firestrength = $kriteria_4;	
		    }elseif ($kriteria_1==1 AND $kriteria_2==1 AND $kriteria_3==1 AND $kriteria_4==1) {
		    	$firestrength = 1;	
		    }else{
		    	$firestrength = 0;
		    }

		    $data = array(
		    	'id_hasil' => $id,
		    	'id_wisata' =>$id_wisata,
		    	'nama' => $nama,
	     		'kriteria_1' => $kriteria_1,
	     		'kriteria_2' => $kriteria_2,
	     		'kriteria_3' => $kriteria_3,
	     		'kriteria_4' => $kriteria_4,
	     		'firestrength' => $firestrength,
	      	);
	      	$this->model_wisata->simpanWisata('hasil_pencarian', $data);

		}

		$data = array('hasil_cari' => $this->model_wisata->getCari()->result_array(),);
		$this->load->view('user/hasil_cari', $data);
	    //redirect('admin/daftar_wisata');
    }

    public function detail_wisata($kode = 0){
	    $row = $this->model_wisata->detail_wisata2("WHERE wisata.`id` = '$kode'")->result_array();

	    $data = array(
	      'nama' => $row[0]['nama'],
	      'alamat' => $row[0]['alamat'],
	      'deskripsi' => $row[0]['deskripsi'],
	      'foto' => $row[0]['foto'],
	      'harga' => $row[0]['harga'],
	      'fasilitas' => $row[0]['fasilitas'],
	      'pengunjung' => $row[0]['pengunjung'],
	      'jarak' => $row[0]['jarak'],
	    );
	    $this->load->view('user/detail_wisata', $data);
  	}

  	public function tentang()
	{
		$this->load->view('user/tentang');
	}

}
