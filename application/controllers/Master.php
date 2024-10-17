<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('./vendor/autoload.php');

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input
 * @property Crud $Crud
 * @property CI_Output $output
 * @property CI_Upload $upload
 */

class Master extends CI_Controller
{
	public function __construct()
	{
		//$this->load->model('Crud');
		parent::__construct();
	}
	protected function notifiaksi($param)
	{
		if ($param == 1) {
			$this->session->set_flashdata('success', 'proses berhasil');
		} else {
			$this->session->set_flashdata('error', $param);
		}
	}
	protected function cekadmin()
	{
		if ($this->session->userdata('user_level') != 1 && $this->session->userdata('user_login') != true) {
			redirect(site_url());
		}
	}
	protected function ceklogin()
	{
		if ($this->session->userdata('user_level') == 1 && $this->session->userdata('user_login') == true) {
			redirect(site_url('dashboard/admin'));
		}
	}
	protected function fileupload($path, $file)
	{
		$config = array(
			'upload_path' => $path,
			'allowed_types' => 'pdf',
			'max_size' => 5000, //5MN
			'encrypt_name' => true, //ENCTYPT
		);
		$this->load->library('upload', $config);
		return $this->upload->do_upload($file);
	}
	protected function downloadfile($path, $file)
	{
		$link = $path . $file;
		if (file_exists($link)) {
			$url = file_get_contents($link);
			force_download($file, $url);
		} else {
			$this->session->set_flashdata('error', 'File tidak ditemukan');
		}
	}
	protected function matauang($param)
	{
		$level1 = str_replace('Rp ', '', $param);
		$level2 = str_replace('.', '', $level1);
		return $level2;
	}
	protected function dumpdata($data)
	{
		echo "<pre>";
		print_r($data);
	}
	protected function menu($levelakses)
	{
		$main_menu = array(
			'tabel' => 'menu',
			'where' => array(array('menu_is_mainmenu' => '0'), array('menu_status' => '1'), array('menu_akses_level' => $levelakses)),
			'order' => array('kolom' => 'menu_urutan', 'orderby' => 'ASC'),
		);
		$menu_akhir = array();
		$menu = $this->Crud->read($main_menu)->result();
		if (count($menu) > 0) {
			foreach ($menu as $index => $row) {
				$menu_akhir[$index] = $row;
				$sub_menu = array(
					'tabel' => 'menu',
					'where' => array('menu_is_mainmenu ' => $row->menu_id),
				);
				$submenu = $this->Crud->read($sub_menu)->result();
				if (count($submenu) > 0) {
					$menu_akhir[$index]->status = 1;
					//$submenu=array();
					$menu_akhir[$index]->submenu = $submenu;
				} else {
					$menu_akhir[$index]->status = 0;
					$menu_akhir[$index]->submenu = 0;
				}
			}
		}
		return $menu_akhir;
	}
	protected function menu_backend($levelakses)
	{
		$main_menu = array(
			'tabel' => 'menu',
			'where' => array(array('menu_is_mainmenu' => '0'), array('menu_status' => '1'), array('menu_akses_level' => $levelakses), array('menu_akses' => 1)),
			'order' => array('kolom' => 'menu_urutan', 'orderby' => 'ASC'),
		);
		$menu_akhir = array();
		$menu = $this->Crud->read($main_menu)->result();
		if (count($menu) > 0) {
			foreach ($menu as $index => $row) {
				$menu_akhir[$index] = $row;
				$sub_menu = array(
					'tabel' => 'menu',
					'where' => array('menu_is_mainmenu ' => $row->menu_id),
				);
				$submenu = $this->Crud->read($sub_menu)->result();
				if (count($submenu) > 0) {
					$menu_akhir[$index]->status = 1;
					//$submenu=array();
					$menu_akhir[$index]->submenu = $submenu;
				} else {
					$menu_akhir[$index]->status = 0;
					$menu_akhir[$index]->submenu = 0;
				}
			}
		}
		return $menu_akhir;
	}
	protected function prosescetak($data)
	{
		$nama_dokumen = $data['judul'];

		require_once('./vendor/autoload.php');

		// Inisialisasi mPDF dengan pengaturan default
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'A4-L',
			'margin_left' => 15,
			'margin_right' => 15,
			'margin_top' => 15,
			'margin_bottom' => 15,
			'margin_header' => 0,
			'margin_footer' => 0,
		]);

		// Set Header
		// $mpdf->SetHTMLHeader('
		// 	<div style="text-align: left; font-weight: bold;">
		// 		<p>RPTRA Jakarta Timur</p>' . $nama_dokumen . '
		// 	</div>
		// ');

		// Set Footer
		$mpdf->SetHTMLFooter('
			<table width="100%">
				<tr>
					<td width="33%">{DATE j-m-Y}</td>
					<td width="33%" align="center">{PAGENO}/{nbpg}</td>
					<td width="33%" style="text-align: right;">' . $nama_dokumen . '</td>
				</tr>
			</table>
		');

		// Tulis konten HTML ke dalam PDF
		$mpdf->WriteHTML($data['view']);

		// Output file PDF
		$mpdf->Output($nama_dokumen . ".pdf", 'I');
	}

	protected function barcode($param)
	{
		include "./asset/phpqrcode/qrlib.php";
		$tempdir = "./barcode/";
		#parameter inputan
		$isi_teks = $param;
		$namafile = $param . '.png';
		$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
		$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
		$padding = 0;
		QRCode::png($isi_teks, $tempdir . $namafile, $quality, $ukuran, $padding);
		$path = "barcode/" . $namafile;
		return base_url($path);
	}
}
