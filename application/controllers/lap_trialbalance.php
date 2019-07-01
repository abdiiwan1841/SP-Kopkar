<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_trialbalance extends OperatorController {
public function __construct() {
		parent::__construct();
		$this->load->helper('fungsi');
		$this->load->model(['general_m','jurnal_umum_m']);
	}

	public function index() {
		$this->load->library("pagination");

		$this->data['judul_browser'] = 'Laporan';
		$this->data['judul_utama'] = 'Laporan';
		$this->data['judul_sub'] = 'Trial Balance';

		$this->data['css_files'][] = base_url() . 'assets/easyui/themes/default/easyui.css';
		$this->data['css_files'][] = base_url() . 'assets/easyui/themes/icon.css';
		$this->data['js_files'][] = base_url() . 'assets/easyui/jquery.easyui.min.js';

		#include tanggal
		$this->data['css_files'][] = base_url() . 'assets/extra/bootstrap_date_time/css/bootstrap-datetimepicker.min.css';
		$this->data['js_files'][] = base_url() . 'assets/extra/bootstrap_date_time/js/bootstrap-datetimepicker.min.js';
		$this->data['js_files'][] = base_url() . 'assets/extra/bootstrap_date_time/js/locales/bootstrap-datetimepicker.id.js';
		$this->data['data_akun'] = $this->jurnal_umum_m->get_akun_trial_balance()->result();
		$this->data['jurnal_umum_m'] = $this->jurnal_umum_m;
			#include seach
		$this->data['css_files'][] = base_url() . 'assets/theme_admin/css/daterangepicker/daterangepicker-bs3.css';
		$this->data['js_files'][] = base_url() . 'assets/theme_admin/js/plugins/daterangepicker/daterangepicker.js';


		$this->data['isi'] = $this->load->view('lap_trialbalance_v', $this->data, TRUE);
		$this->load->view('themes/layout_utama_v', $this->data);
	}

	function cetak() {
		$anggota = $this->lap_anggota_m->lap_data_anggota();
		if($anggota == FALSE) {
			//redirect('lap_anggota');
			echo 'DATA KOSONG';
			exit();
		}
	}
}
