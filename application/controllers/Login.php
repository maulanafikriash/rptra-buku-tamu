<?php
include APPPATH . 'controllers/Master.php';

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input
 * @property Crud $Crud
 * @property CI_Output $output
 * @property CI_Upload $upload
 */

class Login extends Master
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Crud');
	}
	private $master_tabel = 'user';
	private $id = 'id';

	function index()
	{
		$this->ceklogin();
		$this->load->view('template/login');
		//redirect(site_url('crud/admin'));
	}
	function aksi_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = array(
			'tabel' => $this->master_tabel,
			'where' => array(array('user_username' => $username), array('user_password' => $password)),
			'limit' => 1,
		);
		$cek_user = $this->Crud->read($query);
		if ($cek_user->num_rows() == 1) {
			$user = $cek_user->row();
			$dt_session = array(
				'user_id' => $user->user_id,
				'user_username' => $user->user_username,
				'user_nama' => $user->user_nama,
				'user_level' => $user->user_level,
				'user_terdaftar' => date('d-m-Y', strtotime($user->user_terdaftar)),
				'user_login' => true,
			);
			$this->session->set_userdata($dt_session);
			if ($this->session->userdata('user_level') == 1) {
				redirect(site_url("kegiatan/admin"));
				//echo "login";
			} else {
				redirect(site_url("dashboard/user"));
			}
		} else {
			$this->session->set_flashdata('error', 'username tidak ditemukan');
			redirect(base_url('Login'));
		}
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}
}
