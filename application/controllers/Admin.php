<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('model_wisata');
	}

	public function index()
	{
		$this->load->view('admin/index');
	}

	public function daftar_wisata()
	{
		$data = array('daftar_wisata' => $this->model_wisata->getWisata(' ORDER BY id desc')->result_array(),);
		$this->load->view('admin/daftar_wisata', $data);
	}

	public function tambah_wisata()
	{
		$this->load->view('admin/tambah_wisata');
	}

	public function upload_wisata(){

		$id        = '';
	    $nama      = $this->input->post('nama');
	    $alamat    = $this->input->post('alamat');
	    $deskripsi = $this->input->post('deskripsi');
	    $id_wisata = '';


		//upload photo
		$config['max_size']=2048;
		$config['allowed_types']="png|jpg|jpeg";
		$config['remove_spaces']=TRUE;
		$config['overwrite']=TRUE;
		$config['upload_path']=FCPATH.'images';

		$this->load->library('upload');
		$this->upload->initialize($config);

		//ambil data image
		$this->upload->do_upload('input_gambar');
		$data_image = $this->upload->data('file_name');
		$location   = 'images/';
		$pict       = $location.$data_image;


		$data=array(
			'id'=>$id,
			'nama'=>$nama,
			'alamat'=>$alamat,
			'deskripsi'=>$deskripsi,
			'foto'=> $pict
			);
		//simpan data 
		$this->model_wisata->simpanWisata('wisata', $data);

		$ambil_fasilitas = $this->db->query('SELECT id FROM wisata;');
		foreach ($ambil_fasilitas->result_array() as $row) {
		    $id_wisata2        = $row['id'];
		}

		$id_variabel = '';
	    $data2 = array(  
	      'id'=> $id_variabel,
	      'id_wisata' => $id_wisata2,
	      );

	    $this->model_wisata->simpanWisata('harga', $data2);
	    $this->model_wisata->simpanWisata('fasilitas', $data2);
	    $this->model_wisata->simpanWisata('pengunjung', $data2);
	    $this->model_wisata->simpanWisata('jarak', $data2);

	    $id_variabel = '';
	    $data2 = array(  
	      'id_hasil_fuzzy'=> $id_variabel,
	      'id_wisata' => $id_wisata2,
	      );
	    $this->model_wisata->simpanWisata('hasil_fuzzy', $data2);

	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data Wisata Berhasil Ditambahkan
	    	</div>");
	    redirect('admin/daftar_wisata');
    }

	
  	public function edit_wisata($kode = 0){
	    $row = $this->model_wisata->edit_wisata("where id = '$kode'")->result_array();

	    $data = array(
	      'id' => $row[0]['id'],
	      'nama' => $row[0]['nama'],
	      'alamat' => $row[0]['alamat'],
	      'deskripsi' => $row[0]['deskripsi'],
	    );
	    $this->load->view('admin/edit_wisata', $data);
  	}


  	public function detail_wisata($kode = 0){
	    $row = $this->model_wisata->detail_wisata("where id = '$kode'")->result_array();

	    $data = array(
	      'id' => $row[0]['id'],
	      'nama' => $row[0]['nama'],
	      'alamat' => $row[0]['alamat'],
	      'deskripsi' => $row[0]['deskripsi'],
	      'foto' => $row[0]['foto'],
	    );
	    $this->load->view('admin/detail_wisata', $data);
  	}

  	public function update_wisata(){

  		//upload photo
		$config['max_size']=2048;
		$config['allowed_types']="png|jpg|jpeg";
		$config['remove_spaces']=TRUE;
		$config['overwrite']=TRUE;
		$config['upload_path']=FCPATH.'images';

		$this->load->library('upload');
		$this->upload->initialize($config);

		//ambil data image
		$this->upload->do_upload('input_gambar');
		$data_image = $this->upload->data('file_name');
		$location   = 'images/';
		$pict       = $location.$data_image;

	    $data = array(
	      'id' => $this->input->post('id'),
	      'nama' => $this->input->post('nama'),
	      'alamat' => $this->input->post('alamat'),
	      'deskripsi' => $this->input->post('deskripsi'),
	      'foto'=> $pict
	      );

	    $res = $this->model_wisata->update_wisata($data);
	    if($res=1){
	      header('location:'.base_url().'admin/daftar_wisata');
	      $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data Wisata Berhasil Diedit
	    	</div>");
	    }
	}

	public function hapus_wisata($kode = 0){
	    $result = $this->model_wisata->Hapus('wisata',array('id' => $kode));
	    $result = $this->model_wisata->Hapus('harga',array('id' => $kode));
	    $result = $this->model_wisata->Hapus('fasilitas',array('id' => $kode));
	    $result = $this->model_wisata->Hapus('pengunjung',array('id' => $kode));
	    $result = $this->model_wisata->Hapus('jarak',array('id' => $kode));
	    $result = $this->model_wisata->Hapus('hasil_fuzzy',array('id_wisata' => $kode));
	    if($result == 1){
	      header('location:'.base_url().'admin/daftar_wisata');
	    $this->session->set_flashdata("sukses", "
	    	<div class='alert alert-success alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Sukses!</h4> Data Wisata Berhasil Dihapus
	    	</div>");
		}
	}

	public function fuzzyfikasi()
	{
		$data = array('fuzzyfikasi' => $this->model_wisata->get_fuzzyfikasi(' ORDER BY id_hasil_fuzzy ')->result_array(),);
		$this->load->view('admin/fuzzyfikasi', $data);
	}

	public function proses(){
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
	}
}
