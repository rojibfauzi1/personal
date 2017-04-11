<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/M_login');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function aksi_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
	
		$where = array(
			'username'=>$username,
			'password'=>md5($password)
			);

		$cek = $this->M_login->cek_login('admin',$where)->num_rows();

		if($cek > 0){

			$data_session = array(
				'nama'=>$username,
				'status' => 'login'
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("index.php/admin/Dashboard"));
		}else{
			echo "Username & password salah";
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url("index.php/Login"));
	}
}

?>