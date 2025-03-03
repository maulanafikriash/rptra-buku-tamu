<?php
defined('BASEPATH') or exit('No direct script access allowed');
//include controller master 
include APPPATH . 'controllers/Master.php';

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input
 * @property Crud $Crud
 * @property CI_Output $output
 * @property CI_Upload $upload
 */

class admin extends Master
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud');

		$this->cekadmin();
	}
	//VARIABEL
	private $master_tabel = "bukutamu"; //Mendefinisikan Nama Tabel
	private $id = "bukutamu_id";	//Menedefinisaikan Nama Id Tabel
	private $default_url = "bukutamu/admin/"; //Mendefinisikan url controller
	private $default_view = "bukutamu/admin/"; //Mendefinisiakn defaul view
	private $view = "template/backend"; //Mendefinisikan Tamplate Root
	private $path = './upload/';

	private function global_set($data)
	{
		$data = array(
			'menu' => 'bukutamu', //Seting menu yang aktif
			'menu_submenu' => false,
			'headline' => $data['headline'], //Deskripsi Menu
			'url' => $data['url'], //Deskripsi URL yang dilewatkan dari function
			'ikon' => "fa fa-tasks",
			'view' => "views/bukutamu/admin/index.php",
			'detail' => false,
			'cetak' => false,
			'edit' => true,
			'delete' => true,
			'download' => false,
		);
		return (object)$data; //MEMBUAT ARRAY DALAM BENTUK OBYEK
	}
	private function hapus_file($id)
	{
		$query = array(
			'tabel' => $this->master_tabel,
			'where' => array(array($this->id => $id)),
		);
		$file = $this->Crud->read($query)->row();
		unlink($this->path . $file->bukutamu_file);
	}
	public function index()
	{
		$global_set = array(
			'headline' => 'buku tamu',
			'url' => $this->default_url,
		);
		$global = $this->global_set($global_set);
		//CEK SUBMIT DATA
		if ($this->input->post('bukutamu_nama')) {
			//PROSES SIMPAN
			$data = array(
				'bukutamu_idkegiatan' => $this->input->post('bukutamu_idkegiatan'),
				'bukutamu_nama' => $this->input->post('bukutamu_nama'),
				'bukutamu_date' => date('Y-m-d', strtotime($this->input->post('bukutamu_date'))),
				'bukutamu_alamat' => $this->input->post('bukutamu_alamat'),
				'bukutamu_email' => $this->input->post('bukutamu_email'),
				'bukutamu_notlp' => $this->input->post('bukutamu_notlp'),
				'bukutamu_instansi' => $this->input->post('bukutamu_instansi'),
				'bukutamu_jeniskelamin' => $this->input->post('bukutamu_jeniskelamin'),
			);

			$query = array(
				'data' => $data,
				'tabel' => $this->master_tabel,
			);
			$insert = $this->Crud->insert($query);
			if ($insert) {
				$dt['success'] = 'input data berhasil';
			} else {
				$dt['error'] = 'input data error';
			}
			return $this->output->set_output(json_encode($dt));
		} else {
			$data = array(
				'global' => $global,
				'menu' => $this->menu_backend($this->session->userdata('user_level')),
			);
			$this->load->view($this->view, $data);
		}
	}
	public function tabel()
	{
		$global_set = array(
			'headline' => 'buku tamu',
			'url' => $this->default_url,
		);
		//LOAD FUNCTION GLOBAL SET
		$global = $this->global_set($global_set);
		//PROSES TAMPIL DATA
		$kegiatan = array(
			'tabel' => 'kegiatan',
			'where' => array(array('kegiatan_aktif' => 1)),
		);
		$kegiatan = $this->Crud->read($kegiatan)->row();
		$query = array(
			'tabel' => $this->master_tabel,
			'where' => array(array('bukutamu_idkegiatan' => $kegiatan->kegiatan_id)),
			'order' => array('kolom' => $this->id, 'orderby' => 'DESC'),
		);
		$data = array(
			'global' => $global,
			'data' => $this->Crud->read($query)->result(),
			'kegiatan' => $kegiatan,
		);
		$this->load->view($this->default_view . 'tabel', $data);
	}
	public function edit_kegiatan()
	{
		$global_set = array(
			'headline' => 'edit data',
			'url' => $this->default_url,
		);
		$global = $this->global_set($global_set);
		$id = $this->input->post('id');
		if ($this->input->post('bukutamu_nama')) {
			//PROSES SIMPAN
			$data = array(
				'bukutamu_nama' => $this->input->post('bukutamu_nama'),
				'bukutamu_date' => date('Y-m-d', strtotime($this->input->post('bukutamu_date'))),
				'bukutamu_keterangan' => $this->input->post('bukutamu_keterangan'),
			);
			$file = 'fileupload';
			if ($_FILES[$file]['name']) {
				if ($this->fileupload($this->path, $file)) {
					$this->hapus_file($id);
					$file = $this->upload->data('file_name');
					$data['bukutamu_file'] = $file;
				} else {
					$dt['error'] = $this->upload->display_errors();
					return $this->output->set_output(json_encode($dt));
					exit();
				}
			}
			$query = array(
				'data' => $data,
				'tabel' => $this->master_tabel,
				'where' => array($this->id => $id),
			);
			$update = $this->Crud->update($query);
			if ($update) {
				$dt['success'] = 'update data berhasil';
			} else {
				$dt['error'] = 'input data error';
			}
			return $this->output->set_output(json_encode($dt));
		} else {
			$query = array(
				'tabel' => $this->master_tabel,
				'where' => array(array($this->id => $id))
			);
			$data = array(
				'data' => $this->Crud->read($query)->row(),
				'global' => $global,
				'menu' => $this->menu(0),
			);
			$this->load->view($this->default_view . 'edit-kegiatan', $data);
		}
	}
	public function edit_tamu()
	{
		$global_set = array(
			'headline' => 'edit data',
			'url' => $this->default_url,
		);
		$global = $this->global_set($global_set);
		$id = $this->input->post('id');
		if ($this->input->post('bukutamu_nama')) {
			//PROSES SIMPAN
			$data = array(
				'bukutamu_idkegiatan' => $this->input->post('bukutamu_idkegiatan'),
				'bukutamu_nama' => $this->input->post('bukutamu_nama'),
				'bukutamu_date' => date('Y-m-d', strtotime($this->input->post('bukutamu_date'))),
				'bukutamu_alamat' => $this->input->post('bukutamu_alamat'),
				'bukutamu_email' => $this->input->post('bukutamu_email'),
				'bukutamu_notlp' => $this->input->post('bukutamu_notlp'),
				'bukutamu_instansi' => $this->input->post('bukutamu_instansi'),
				'bukutamu_jeniskelamin' => $this->input->post('bukutamu_jeniskelamin'),
			);
			$query = array(
				'data' => $data,
				'tabel' => $this->master_tabel,
				'where' => array($this->id => $id),
			);
			$update = $this->Crud->update($query);
			if ($update) {
				$dt['success'] = 'update data berhasil';
			} else {
				$dt['error'] = 'input data error';
			}
			return $this->output->set_output(json_encode($dt));
		} else {
			$query = array(
				'tabel' => $this->master_tabel,
				'where' => array(array($this->id => $id))
			);
			$data = array(
				'data' => $this->Crud->read($query)->row(),
				'global' => $global,
				'menu' => $this->menu(0),
			);
			$this->load->view($this->default_view . 'edit-tamu', $data);
		}
	}
	public function add()
	{
		$global_set = array(
			'submenu' => false,
			'headline' => 'add data',
			'url' => $this->default_url, //AKAN DIREDIRECT KE INDEX
		);
		$global = $this->global_set($global_set);
		$id = $this->input->post('id');
		$data = array(
			'global' => $global,
			'idkegiatan' => $id,
		);
		$this->load->view($this->default_view . 'add', $data);
	}
	public function hapus()
	{
		$id = $this->input->post('id');
		$query = array(
			'tabel' => $this->master_tabel,
			'where' => array($this->id => $id),
		);
		$delete = $this->Crud->delete($query);
		if ($delete) {
			$dt['success'] = 'hapus data berhasil';
		} else {
			$dt['error'] = 'input data error';
			$dt['msg'] = $delete;
		}
		return $this->output->set_output(json_encode($dt));
	}
	public function download($file = null)
	{
		if ($file) {
			$this->downloadfile($this->path, $file);
		} else {
			$this->session->set_flashdata('error', 'File tidak ditemukan');
			redirect(site_url($this->default_url));
		}
	}
	public function cetakbukutamu($id)
	{
		$query = array(
			'select' => 'b.*',
			'tabel' => 'kegiatan a',
			'join' => array(array('tabel' => 'bukutamu b', 'ON' => 'b.bukutamu_idkegiatan=a.kegiatan_id', 'jenis' => 'INNER')),
			'where' => array(array('md5(a.kegiatan_id)' => $id)),
		);
		$bukutamu = $this->Crud->join($query)->result();
		$kegiatan = array(
			'tabel' => 'kegiatan',
			'where' => array(array('md5(kegiatan_id)' => $id)),
		);
		$kegiatan = $this->Crud->read($kegiatan)->row();
		$param = 'akprind1574-' . $kegiatan->kegiatan_id;
		$qrcode = $this->barcode($param);
		$data = array(
			'data' => $bukutamu,
			'kegiatan' => $kegiatan,
			'qrcode' => $qrcode,
		);
		$view = $this->load->view('laporan/bukutamu', $data, true);
		$pdf = array(
			'judul' => $kegiatan->kegiatan_nama,
			'view' => $view,
		);
		$this->prosescetak($pdf);
	}
}
