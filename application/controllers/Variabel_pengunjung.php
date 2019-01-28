<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variabel_pengunjung extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('model_pengunjung');
		$this->load->model('model_wisata');
	}

	public function index()
	{
		$data = array('daftar_pengunjung' => $this->model_pengunjung->getpengunjung()->result_array(),);
		$this->load->view('admin/daftar_pengunjung', $data);
	}

	public function tambah_pengunjung()
	{
		$data = array('daftar_wisata' => $this->model_wisata->getWisata()->result_array(),);
		$this->load->view('admin/tambah_pengunjung', $data);
	}

	public function simpan_pengunjung(){
	    $id_pengunjung = '';
	    $id_wisata = $_POST['id_wisata'];
	    $pengunjung     = $_POST['pengunjung'];

	    $data = array(  
	      'id'=> $id_pengunjung,
	      'id_wisata'=> $id_wisata,
	      'pengunjung' => $pengunjung,
	      );

	    $this->model_pengunjung->simpanpengunjung('pengunjung', $data);
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> pengunjung Wisata Berhasil Ditambahkan
	    	</div>");
	    redirect('variabel_pengunjung');
  	}

  	public function edit_pengunjung($kode = 0){
	    $row = $this->model_pengunjung->edit_pengunjung("where pengunjung.`id`  = '$kode'")->result_array();

	    $data = array(
	      'id' => $row[0]['id'],
	      'id_wisata' => $row[0]['id_wisata'],
	      'nama' => $row[0]['nama'],
	      'pengunjung' => $row[0]['pengunjung'],
	    );
	    $this->load->view('admin/edit_pengunjung', $data);
  	}

  	public function update_pengunjung(){
	    $data = array(
	      'id' => $this->input->post('id'),
	      'id_wisata' => $this->input->post('id_wisata'),
	      'pengunjung' => $this->input->post('pengunjung'),
	      );

	    $res = $this->model_pengunjung->update_pengunjung($data);
	    if($res=1){
	      header('location:'.base_url().'variabel_pengunjung');
	      $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data pengunjung Berhasil Diedit
	    	</div>");
	    }
	}

	public function hapus_pengunjung($kode = 0){
	    $result = $this->model_pengunjung->Hapus('pengunjung',array('id' => $kode));
	    if($result == 1){
	      header('location:'.base_url().'variabel_pengunjung');
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data pengunjung Wisata Berhasil Dihapus
	    	</div>");
		}
	}

	public function set_kriteria_pengunjung()
	{
		$data = array('kriteria_pengunjung' => $this->model_pengunjung->getKriteria()->result_array(),);
		$this->load->view('admin/set_pengunjung', $data);
	}

	public function proses_set_pengunjung(){
	    $id_kriteria_pengunjung = '';
	    $sepi   = $_POST['sepi'];
	    $biasa  = $_POST['biasa'];
	    $ramai   = $_POST['ramai'];

	    $x1 = $biasa - $sepi; // parameter pembagi 1
	    $x2 = $ramai - $biasa; // parameter pembagi 2

	    $data = array(  
	      'id_kriteria_pengunjung'=> $id_kriteria_pengunjung,
	      'sepi'=> $sepi,
	      'biasa' => $biasa,
	      'ramai' => $ramai,
	      'x1' => $x1,
	      'x2' => $x2,
	    );
	    $this->db->query('TRUNCATE kriteria_pengunjung;');
	    $this->model_pengunjung->simpanpengunjung('kriteria_pengunjung', $data);

	    // kriteria sepi
	    $ambil_pengunjung = $this->db->query('SELECT id, pengunjung FROM pengunjung;');
		foreach ($ambil_pengunjung->result_array() as $row) {
		    $id        = $row['id'];
		    $pengunjung     = $row['pengunjung'];

		    if($pengunjung <= $sepi){
		    	$kriteria_sepi = 1;

		    }elseif ($sepi <= $pengunjung AND $pengunjung <= $biasa){
		    	$hitung = ($biasa - $pengunjung)/$x1;
		    	$kriteria_sepi = round($hitung, 2);

		    }elseif($pengunjung >= $biasa){
		    	$kriteria_sepi = 0;
		    }

		    $update_sepi = $this->db->query("UPDATE pengunjung SET sepi = $kriteria_sepi WHERE id = $id;");
		    $update_sepi2 = $this->db->query("UPDATE hasil_fuzzy SET pengunjung_sepi = $kriteria_sepi WHERE id_wisata = $id;");
		}

		// kriteria biasa
		$ambil_pengunjung = $this->db->query('SELECT id, pengunjung FROM pengunjung;');
		foreach ($ambil_pengunjung->result_array() as $row) {
		    $id        = $row['id'];
		    $pengunjung     = $row['pengunjung'];

		    if($pengunjung >= $ramai OR $pengunjung <= $sepi){
		    	$kriteria_biasa = 0;

		    }elseif ($sepi <= $pengunjung AND $pengunjung <= $biasa){
		    	$hitung = ($pengunjung - $sepi)/$x1;
		    	$kriteria_biasa = round($hitung, 2);

		    }elseif($biasa <= $pengunjung AND $pengunjung <= $ramai){
		    	$hitung2 = ($ramai - $pengunjung)/$x2;
		    	$kriteria_biasa = round($hitung2, 2);
		    }

		    $update_biasa = $this->db->query("UPDATE pengunjung SET biasa = $kriteria_biasa WHERE id = $id;");
		    $update_biasa2 = $this->db->query("UPDATE hasil_fuzzy SET pengunjung_biasa = $kriteria_biasa WHERE id_wisata = $id;");
		}


		// kriteria ramai
		$ambil_pengunjung = $this->db->query('SELECT id, pengunjung FROM pengunjung;');
		foreach ($ambil_pengunjung->result_array() as $row) {
		    $id        = $row['id'];
		    $pengunjung     = $row['pengunjung'];

		    if($pengunjung <= $biasa){
		    	$kriteria_ramai = 0;

		    }elseif ($biasa <= $pengunjung AND $pengunjung <= $ramai){
		    	$hitung = ($pengunjung - $biasa)/$x2;
		    	$kriteria_ramai = round($hitung, 2);

		    }elseif($pengunjung >= $ramai){
		    	$kriteria_ramai = 1;
		    }
		    echo "$kriteria_ramai <br>";
		    $update_ramai = $this->db->query("UPDATE pengunjung SET ramai = $kriteria_ramai WHERE id = $id;");
		    $update_ramai2 = $this->db->query("UPDATE hasil_fuzzy SET pengunjung_ramai = $kriteria_ramai WHERE id_wisata = $id;");
		}
	    redirect('variabel_pengunjung/set_kriteria_pengunjung');
  	}

  	public function derajat_pengunjung()
	{
		$data = array('derajat_anggota_pengunjung' => $this->model_pengunjung->getDerajat()->result_array(),);
		$this->load->view('admin/anggota_pengunjung', $data);
	}
}
