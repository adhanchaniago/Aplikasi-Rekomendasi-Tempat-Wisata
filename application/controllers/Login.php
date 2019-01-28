<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function auth(){
        $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);

        $cek_akun=$this->login_model->auth_akun($username, $password);

        if($cek_akun->num_rows() > 0){ //jika login sebagai kepala
			$data=$cek_akun->row_array();
    		$this->session->set_userdata('masuk',TRUE);
	        if($data['level']=='1'){ //Akses admin
	            $this->session->set_userdata('akses','1');
	            redirect('admin');

	        }else{  // jika username dan password tidak ditemukan atau salah
				$url=base_url();
				echo $this->session->set_flashdata('msg','Username Atau Password Salah');
				redirect($url);
			}
        }else{
        	$this->session->set_flashdata('pesan','Username Atau Password Salah');
        	redirect('login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
