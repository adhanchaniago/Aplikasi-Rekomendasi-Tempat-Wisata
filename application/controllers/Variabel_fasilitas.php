<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variabel_fasilitas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('model_fasilitas');
		$this->load->model('model_wisata');
	}

	public function index()
	{
		$data = array('daftar_fasilitas' => $this->model_fasilitas->getfasilitas()->result_array(),);
		$this->load->view('admin/daftar_fasilitas', $data);
	}

	public function tambah_fasilitas()
	{
		$data = array('daftar_wisata' => $this->model_wisata->getWisata()->result_array(),);
		$this->load->view('admin/tambah_fasilitas', $data);
	}

	public function simpan_fasilitas(){
	    $id_fasilitas = '';
	    $id_wisata = $_POST['id_wisata'];
	    $fasilitas     = $_POST['fasilitas'];

	    $data = array(  
	      'id'=> $id_fasilitas,
	      'id_wisata'=> $id_wisata,
	      'fasilitas' => $fasilitas,
	      );

	    $this->model_fasilitas->simpanfasilitas('fasilitas', $data);
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> fasilitas Wisata Berhasil Ditambahkan
	    	</div>");
	    redirect('variabel_fasilitas');
  	}

  	public function edit_fasilitas($kode = 0){
	    $row = $this->model_fasilitas->edit_fasilitas("where fasilitas.`id`  = '$kode'")->result_array();

	    $data = array(
	      'id' => $row[0]['id'],
	      'id_wisata' => $row[0]['id_wisata'],
	      'nama' => $row[0]['nama'],
	      'fasilitas' => $row[0]['fasilitas'],
	    );
	    $this->load->view('admin/edit_fasilitas', $data);
  	}

  	public function update_fasilitas(){
	    $data = array(
	      'id' => $this->input->post('id'),
	      'id_wisata' => $this->input->post('id_wisata'),
	      'fasilitas' => $this->input->post('fasilitas'),
	      );

	    $res = $this->model_fasilitas->update_fasilitas($data);
	    if($res=1){
	      header('location:'.base_url().'variabel_fasilitas');
	      $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data fasilitas Berhasil Diedit
	    	</div>");
	    }
	}

	public function hapus_fasilitas($kode = 0){
	    $result = $this->model_fasilitas->Hapus('fasilitas',array('id' => $kode));
	    if($result == 1){
	      header('location:'.base_url().'variabel_fasilitas');
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data fasilitas Wisata Berhasil Dihapus
	    	</div>");
		}
	}

	public function set_kriteria_fasilitas()
	{
		$data = array('kriteria_fasilitas' => $this->model_fasilitas->getKriteria()->result_array(),);
		$this->load->view('admin/set_fasilitas', $data);
	}

	public function proses_set_fasilitas(){
	    $id_kriteria_fasilitas = '';
	    $sedikit   = $_POST['sedikit'];
	    $cukup  = $_POST['cukup'];
	    $banyak   = $_POST['banyak'];

	    $x1 = $cukup - $sedikit; // parameter pembagi 1
	    $x2 = $banyak - $cukup; // parameter pembagi 2

	    $data = array(  
	      'id_kriteria_fasilitas'=> $id_kriteria_fasilitas,
	      'sedikit'=> $sedikit,
	      'cukup' => $cukup,
	      'banyak' => $banyak,
	      'x1' => $x1,
	      'x2' => $x2,
	    );
	    $this->db->query('TRUNCATE kriteria_fasilitas;');
	    $this->model_fasilitas->simpanfasilitas('kriteria_fasilitas', $data);

	    // kriteria sedikit
	    $ambil_fasilitas = $this->db->query('SELECT id, fasilitas FROM fasilitas;');
		foreach ($ambil_fasilitas->result_array() as $row) {
		    $id        = $row['id'];
		    $fasilitas     = $row['fasilitas'];

		    if($fasilitas <= $sedikit){
		    	$kriteria_sedikit = 1;

		    }elseif ($sedikit <= $fasilitas AND $fasilitas <= $cukup){
		    	$hitung = ($cukup - $fasilitas)/$x1;
		    	$kriteria_sedikit = round($hitung, 2);

		    }elseif($fasilitas >= $cukup){
		    	$kriteria_sedikit = 0;
		    }

		    $update_sedikit = $this->db->query("UPDATE fasilitas SET sedikit = $kriteria_sedikit WHERE id = $id;");
		    $update_sedikit2 = $this->db->query("UPDATE hasil_fuzzy SET fas_sedikit = $kriteria_sedikit WHERE id_wisata = $id;");
		}

		// kriteria cukup
		$ambil_fasilitas = $this->db->query('SELECT id, fasilitas FROM fasilitas;');
		foreach ($ambil_fasilitas->result_array() as $row) {
		    $id        = $row['id'];
		    $fasilitas     = $row['fasilitas'];

		    if($fasilitas >= $banyak OR $fasilitas <= $sedikit){
		    	$kriteria_cukup = 0;

		    }elseif ($sedikit <= $fasilitas AND $fasilitas <= $cukup){
		    	$hitung = ($fasilitas - $sedikit)/$x1;
		    	$kriteria_cukup = round($hitung, 2);

		    }elseif($cukup <= $fasilitas AND $fasilitas <= $banyak){
		    	$hitung2 = ($banyak - $fasilitas)/$x2;
		    	$kriteria_cukup = round($hitung2, 2);
		    }

		    $update_cukup = $this->db->query("UPDATE fasilitas SET cukup = $kriteria_cukup WHERE id = $id;");
		    $update_cukup2 = $this->db->query("UPDATE hasil_fuzzy SET fas_cukup = $kriteria_cukup WHERE id_wisata = $id;");
		}


		// kriteria banyak
		$ambil_fasilitas = $this->db->query('SELECT id, fasilitas FROM fasilitas;');
		foreach ($ambil_fasilitas->result_array() as $row) {
		    $id        = $row['id'];
		    $fasilitas     = $row['fasilitas'];

		    if($fasilitas <= $cukup){
		    	$kriteria_banyak = 0;

		    }elseif ($cukup <= $fasilitas AND $fasilitas <= $banyak){
		    	$hitung = ($fasilitas - $cukup)/$x2;
		    	$kriteria_banyak = round($hitung, 2);

		    }elseif($fasilitas >= $banyak){
		    	$kriteria_banyak = 1;
		    }
		    echo "$kriteria_banyak <br>";
		    $update_banyak = $this->db->query("UPDATE fasilitas SET banyak = $kriteria_banyak WHERE id = $id;");
		    $update_banyak2 = $this->db->query("UPDATE hasil_fuzzy SET fas_banyak = $kriteria_banyak WHERE id_wisata = $id;");
		}
	    redirect('variabel_fasilitas/set_kriteria_fasilitas');
  	}

  	public function derajat_fasilitas()
	{
		$data = array('derajat_anggota_fasilitas' => $this->model_fasilitas->getDerajat()->result_array(),);
		$this->load->view('admin/anggota_fasilitas', $data);
	}
}
