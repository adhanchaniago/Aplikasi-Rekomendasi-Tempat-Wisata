<?php
class Login_model extends CI_Model{
	function auth_akun($username,$password){
		$query=$this->db->query("SELECT * FROM admin WHERE username='$username' AND pass=MD5('$password') LIMIT 1");
		return $query;
	}
}
