<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variabel_harga extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('model_harga');
		$this->load->model('model_wisata');
	}

	public function index()
	{
		$data = array('daftar_harga' => $this->model_harga->getHarga()->result_array(),);
		$this->load->view('admin/daftar_harga', $data);
	}

	public function tambah_harga()
	{
		$data = array('daftar_wisata' => $this->model_wisata->getWisata()->result_array(),);
		$this->load->view('admin/tambah_harga', $data);
	}

	public function simpan_harga(){
	    $id_harga = '';
	    $id_wisata = $_POST['id_wisata'];
	    $harga     = $_POST['harga'];

	    $data = array(  
	      'id'=> $id_harga,
	      'id_wisata'=> $id_wisata,
	      'harga' => $harga,
	      );

	    $this->model_harga->simpanHarga('harga', $data);
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Harga Wisata Berhasil Ditambahkan
	    	</div>");
	    redirect('variabel_harga');
  	}

  	public function edit_harga($kode = 0){
	    $row = $this->model_harga->edit_harga("where harga.`id`  = '$kode'")->result_array();

	    $data = array(
	      'id' => $row[0]['id'],
	      'id_wisata' => $row[0]['id_wisata'],
	      'nama' => $row[0]['nama'],
	      'harga' => $row[0]['harga'],
	    );
	    $this->load->view('admin/edit_harga', $data);
  	}

  	public function update_harga(){
	    $data = array(
	      'id' => $this->input->post('id'),
	      'id_wisata' => $this->input->post('id_wisata'),
	      'harga' => $this->input->post('harga'),
	      );

	    $res = $this->model_harga->update_harga($data);
	    if($res=1){
	      header('location:'.base_url().'variabel_harga');
	      $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data Harga Berhasil Diedit
	    	</div>");
	    }
	}

	public function hapus_harga($kode = 0){
	    $result = $this->model_harga->Hapus('harga',array('id' => $kode));
	    if($result == 1){
	      header('location:'.base_url().'variabel_harga');
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data Harga Wisata Berhasil Dihapus
	    	</div>");
		}
	}

	public function set_kriteria_harga()
	{
		$data = array('kriteria_harga' => $this->model_harga->getKriteria()->result_array(),);
		$this->load->view('admin/set_harga', $data);
	}

	public function proses_set_harga(){
	    $id_kriteria_harga = '';
	    $murah   = $_POST['murah'];
	    $sedang  = $_POST['sedang'];
	    $mahal   = $_POST['mahal'];

	    $x1 = $sedang - $murah; // parameter pembagi 1
	    $x2 = $mahal - $sedang; // parameter pembagi 2

	    $data = array(  
	      'id_kriteria_harga'=> $id_kriteria_harga,
	      'murah'=> $murah,
	      'sedang' => $sedang,
	      'mahal' => $mahal,
	      'x1' => $x1,
	      'x2' => $x2,
	    );
	    $this->db->query('TRUNCATE kriteria_harga;');
	    $this->model_harga->simpanHarga('kriteria_harga', $data);

	    // kriteria murah
	    $ambil_harga = $this->db->query('SELECT id, harga FROM harga;');
		foreach ($ambil_harga->result_array() as $row) {
		    $id        = $row['id'];
		    $harga     = $row['harga'];

		    if($harga <= $murah){
		    	$kriteria_murah = 1;

		    }elseif ($murah <= $harga AND $harga <= $sedang){
		    	$hitung = ($sedang - $harga)/$x1;
		    	$kriteria_murah = round($hitung, 2);

		    }elseif($harga >= $sedang){
		    	$kriteria_murah = 0;
		    }

		    $update_murah = $this->db->query("UPDATE harga SET murah = $kriteria_murah WHERE id = $id;");
		    $update_murah2 = $this->db->query("UPDATE hasil_fuzzy SET harga_murah = $kriteria_murah WHERE id_wisata = $id;");
		}

		// kriteria sedang
		$ambil_harga = $this->db->query('SELECT id, harga FROM harga;');
		foreach ($ambil_harga->result_array() as $row) {
		    $id        = $row['id'];
		    $harga     = $row['harga'];

		    if($harga >= $mahal OR $harga <= $murah){
		    	$kriteria_sedang = 0;

		    }elseif ($murah <= $harga AND $harga <= $sedang){
		    	$hitung = ($harga - $murah)/$x1;
		    	$kriteria_sedang = round($hitung, 2);

		    }elseif($sedang <= $harga AND $harga <= $mahal){
		    	$hitung2 = ($mahal - $harga)/$x2;
		    	$kriteria_sedang = round($hitung2, 2);
		    }

		    $update_sedang = $this->db->query("UPDATE harga SET sedang = $kriteria_sedang WHERE id = $id;");
		     $update_sedang2 = $this->db->query("UPDATE hasil_fuzzy SET harga_sedang = $kriteria_sedang WHERE id_wisata = $id;");
		}


		// kriteria mahal
		$ambil_harga = $this->db->query('SELECT id, harga FROM harga;');
		foreach ($ambil_harga->result_array() as $row) {
		    $id        = $row['id'];
		    $harga     = $row['harga'];

		    if($harga <= $sedang){
		    	$kriteria_mahal = 0;

		    }elseif ($sedang <= $harga AND $harga <= $mahal){
		    	$hitung = ($harga - $sedang)/$x2;
		    	$kriteria_mahal = round($hitung, 2);

		    }elseif($harga >= $mahal){
		    	$kriteria_mahal = 1;
		    }
		    echo "$kriteria_mahal <br>";
		    $update_mahal = $this->db->query("UPDATE harga SET mahal = $kriteria_mahal WHERE id = $id;");
		     $update_mahal2 = $this->db->query("UPDATE hasil_fuzzy SET harga_mahal = $kriteria_mahal WHERE id_wisata = $id;");
		}
	    redirect('variabel_harga/set_kriteria_harga');
  	}

  	public function derajat_harga()
	{
		$data = array('derajat_anggota_harga' => $this->model_harga->getDerajat()->result_array(),);
		$this->load->view('admin/anggota_harga', $data);
	}
}
