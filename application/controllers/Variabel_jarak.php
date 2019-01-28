<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variabel_jarak extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('model_jarak');
		$this->load->model('model_wisata');
	}

	public function index()
	{
		$data = array('daftar_jarak' => $this->model_jarak->getjarak()->result_array(),);
		$this->load->view('admin/daftar_jarak', $data);
	}

	public function tambah_jarak()
	{
		$data = array('daftar_wisata' => $this->model_wisata->getWisata()->result_array(),);
		$this->load->view('admin/tambah_jarak', $data);
	}

	public function simpan_jarak(){
	    $id_jarak = '';
	    $id_wisata = $_POST['id_wisata'];
	    $jarak     = $_POST['jarak'];

	    $data = array(  
	      'id'=> $id_jarak,
	      'id_wisata'=> $id_wisata,
	      'jarak' => $jarak,
	      );

	    $this->model_jarak->simpanjarak('jarak', $data);
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> jarak Wisata Berhasil Ditambahkan
	    	</div>");
	    redirect('variabel_jarak');
  	}

  	public function edit_jarak($kode = 0){
	    $row = $this->model_jarak->edit_jarak("where jarak.`id`  = '$kode'")->result_array();

	    $data = array(
	      'id' => $row[0]['id'],
	      'id_wisata' => $row[0]['id_wisata'],
	      'nama' => $row[0]['nama'],
	      'jarak' => $row[0]['jarak'],
	    );
	    $this->load->view('admin/edit_jarak', $data);
  	}

  	public function update_jarak(){
	    $data = array(
	      'id' => $this->input->post('id'),
	      'id_wisata' => $this->input->post('id_wisata'),
	      'jarak' => $this->input->post('jarak'),
	      );

	    $res = $this->model_jarak->update_jarak($data);
	    if($res=1){
	      header('location:'.base_url().'variabel_jarak');
	      $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data jarak Berhasil Diedit
	    	</div>");
	    }
	}

	public function hapus_jarak($kode = 0){
	    $result = $this->model_jarak->Hapus('jarak',array('id' => $kode));
	    if($result == 1){
	      header('location:'.base_url().'variabel_jarak');
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data jarak Wisata Berhasil Dihapus
	    	</div>");
		}
	}

	public function set_kriteria_jarak()
	{
		$data = array('kriteria_jarak' => $this->model_jarak->getKriteria()->result_array(),);
		$this->load->view('admin/set_jarak', $data);
	}

	public function proses_set_jarak(){
	    $id_kriteria_jarak = '';
	    $dekat   = $_POST['dekat'];
	    $sedang  = $_POST['sedang'];
	    $jauh   = $_POST['jauh'];

	    $x1 = $sedang - $dekat; // parameter pembagi 1
	    $x2 = $jauh - $sedang; // parameter pembagi 2

	    $data = array(  
	      'id_kriteria_jarak'=> $id_kriteria_jarak,
	      'dekat'=> $dekat,
	      'sedang' => $sedang,
	      'jauh' => $jauh,
	      'x1' => $x1,
	      'x2' => $x2,
	    );
	    $this->db->query('TRUNCATE kriteria_jarak;');
	    $this->model_jarak->simpanjarak('kriteria_jarak', $data);

	    // kriteria dekat
	    $ambil_jarak = $this->db->query('SELECT id, jarak FROM jarak;');
		foreach ($ambil_jarak->result_array() as $row) {
		    $id        = $row['id'];
		    $jarak     = $row['jarak'];

		    if($jarak <= $dekat){
		    	$kriteria_dekat = 1;

		    }elseif ($dekat <= $jarak AND $jarak <= $sedang){
		    	$hitung = ($sedang - $jarak)/$x1;
		    	$kriteria_dekat = round($hitung, 2);

		    }elseif($jarak >= $sedang){
		    	$kriteria_dekat = 0;
		    }

		    $update_dekat = $this->db->query("UPDATE jarak SET dekat = $kriteria_dekat WHERE id = $id;");
		    $update_dekat2 = $this->db->query("UPDATE hasil_fuzzy SET jarak_dekat = $kriteria_dekat WHERE id_wisata = $id;");
		}

		// kriteria sedang
		$ambil_jarak = $this->db->query('SELECT id, jarak FROM jarak;');
		foreach ($ambil_jarak->result_array() as $row) {
		    $id        = $row['id'];
		    $jarak     = $row['jarak'];

		    if($jarak >= $jauh OR $jarak <= $dekat){
		    	$kriteria_sedang = 0;

		    }elseif ($dekat <= $jarak AND $jarak <= $sedang){
		    	$hitung = ($jarak - $dekat)/$x1;
		    	$kriteria_sedang = round($hitung, 2);

		    }elseif($sedang <= $jarak AND $jarak <= $jauh){
		    	$hitung2 = ($jauh - $jarak)/$x2;
		    	$kriteria_sedang = round($hitung2, 2);
		    }

		    $update_sedang = $this->db->query("UPDATE jarak SET sedang = $kriteria_sedang WHERE id = $id;");
		    $update_sedang2 = $this->db->query("UPDATE hasil_fuzzy SET jarak_sedang = $kriteria_sedang WHERE id_wisata = $id;");
		}


		// kriteria jauh
		$ambil_jarak = $this->db->query('SELECT id, jarak FROM jarak;');
		foreach ($ambil_jarak->result_array() as $row) {
		    $id        = $row['id'];
		    $jarak     = $row['jarak'];

		    if($jarak <= $sedang){
		    	$kriteria_jauh = 0;

		    }elseif ($sedang <= $jarak AND $jarak <= $jauh){
		    	$hitung = ($jarak - $sedang)/$x2;
		    	$kriteria_jauh = round($hitung, 2);

		    }elseif($jarak >= $jauh){
		    	$kriteria_jauh = 1;
		    }
		    echo "$kriteria_jauh <br>";
		    $update_jauh = $this->db->query("UPDATE jarak SET jauh = $kriteria_jauh WHERE id = $id;");
		    $update_jauh2 = $this->db->query("UPDATE hasil_fuzzy SET jarak_jauh = $kriteria_jauh WHERE id_wisata = $id;");
		}
	    redirect('variabel_jarak/set_kriteria_jarak');
  	}

  	public function derajat_jarak()
	{
		$data = array('derajat_anggota_jarak' => $this->model_jarak->getDerajat()->result_array(),);
		$this->load->view('admin/anggota_jarak', $data);
	}
}
