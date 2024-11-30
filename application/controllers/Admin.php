<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->login_kah();	//Memastikan hanya yang sudah login dapat akses fungsi ini
	}


	public function login_kah()
	{
		if ($this->session->has_userdata('username') && $this->session->userdata('id_level') == 1)
			return TRUE;
		else
			redirect(base_url('logout'));
	}


	public function index()
	{
		$data['judul']	= 'Selamat Datang di Dashboard IoT by Arif';
		$data['page']	= 'home';
		$data['jml_topic']	= $this->m_umum->jumlah_record_tabel('topik');
		$data['jml_device']	= $this->m_umum->jumlah_record_tabel('device_list');
		$this->tampil($data);
	}

	//============================== DEVICE_ID ==============================
	public function device_id()
	{
		$data['judul'] = 'Data Device Id';
		$data['page'] = 'device_id';
		$data['device_id'] = $this->m_admin->dt_device();
		$this->tampil($data);
	}

	public function device_tambah()
	{
		$data['judul'] = 'Tambah Device Id';
		$data['page'] = 'device_tambah';

		$this->form_validation->set_rules(
			'device_id',
			'Device_id',
			'required|min_length[6]|max_length[30]',
			array('required' => '%s harus diisi.')
		);
	
		$data['ddgh'] = $this->m_admin->dropdown_gh();
		$data['ddnode'] = $this->m_admin->dropdown_node();

		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_admin->dt_device_tambah();
			redirect(base_url('admin/device_id'));
		}
	}

	public function device_edit($id = FALSE)
	{
		$data['judul'] = 'Tambah Device Id';
		$data['page'] = 'device_edit';

		$this->form_validation->set_rules(
			'device_id',
			'Device_id',
			'required|min_length[0]|max_length[30]',
			array('required' => '%s harus diisi.')
		);
	
		$data['ddgh'] = $this->m_admin->dropdown_gh();
		$data['ddnode'] = $this->m_admin->dropdown_node();
		$data['d'] = $this->m_umum->cari_data('device_list', 'device_id', $id);

		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_admin->dt_device_edit($id);
			redirect(base_url('admin/device_id'));
		}
	}

	public function device_hapus($id)
	{
		$this->m_admin->sensor_del($id);
		$this->m_umum->hapus_data('device_list', 'device_id', $id);
		redirect(base_url('admin/device_ID'));
	}
	public function data_hapus($id)
	{
		$this->m_admin->sensor_del($id);
		redirect(base_url('admin/device_ID'));
	}


	//============================== Topic ==============================
	public function topic()
	{
		$data['judul'] = 'Data Topic';
		$data['page'] = 'topic';
		$data['topic'] = $this->m_admin->dt_topic();
		$this->tampil($data);
	}

	public function tambah_topik()
	{
		$data['judul'] = 'Add New Topic';
		$data['page'] = 'tambah_topik';

		$this->form_validation->set_rules('topic_name', 'Isikan Nama guru', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_admin->topik_tambah();
			redirect(base_url('admin/topic'));
		}
	}

	public function topik_edit($id = FALSE)
	{
		$data['judul'] = 'EDIT data Guru TPA Aisyiah Attaqwa';
		$data['page'] = 'topik_edit';

		$this->form_validation->set_rules(
			'topic_name',
			'Topic Name',
			'required|min_length[0]|max_length[30]',
			array('required' => '%s harus diisi.')
		);
		$data['d'] = $this->m_umum->cari_data('topik', 'id', $id);

		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_admin->dt_topik_edit($id);
			redirect(base_url('admin/topic'));
		}
	}

	public function topik_hapus($id)
	{
		$this->m_umum->hapus_data('topik', 'id', $id);
		redirect(base_url('admin/topic'));
	}

	//============================== kelas ==============================
	public function kelas()
	{
		$data['judul'] = 'Data kelas TPA Aisyiah';
		$data['page'] = 'kelas';
		$data['kelas'] = $this->m_admin->dt_kelas();
		$this->tampil($data);
	}

	public function kelas_tambah()
	{
		$data['judul'] = 'Tambah Data kelas TPA Aisyiah';
		$data['page'] = 'kelas_tambah';

		$this->form_validation->set_rules('nama_kelas', 'Isikan Nama kelas', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_admin->kelas_tambah();
			redirect(base_url('admin/kelas'));
		}
	}

	public function kelas_edit($id = FALSE)
	{
		$data['judul'] = 'EDIT data kelas TPA Aisyiah Attaqwa';
		$data['page'] = 'kelas_edit';

		$this->form_validation->set_rules(
			'nama_kelas',
			'Nama kelas',
			'required|min_length[3]|max_length[30]',
			array('required' => '%s harus diisi.')
		);
		$data['d'] = $this->m_umum->cari_data('kelas', 'id_kelas', $id);

		if ($this->form_validation->run() === FALSE) {
			$this->tampil($data);
		} else {
			$this->m_admin->dt_kelas_edit($id);
			redirect(base_url('admin/kelas'));
		}
	}

	public function kelas_hapus($id)
	{
		$this->m_umum->hapus_data('kelas', 'id_kelas', $id);
		redirect(base_url('admin/kelas'));
	}

	//============================== DATA LOGGING ==============================
	public function data_logging($id = NULL)
	{
		$data['judul'] = 'Rekap Data Sensor';
		$data['page'] = 'data_logging';
		$data['dddevice'] = $this->m_admin->dropdown_device();
		$data['sensor'] = $this->m_admin->dt_sensor($id);
		$this->tampil($data);
	}
	public function sensor_hapus($id)
	{
		$this->m_umum->hapus_data('topik', 'id', $id);
		redirect(base_url('admin/topic'));
	}

	//============ Tools ===============
	function dd_cek($str)    //Untuk Validasi DropDown jika tidak dipilih
	{
		if ($str == '-Pilih-') {
			$this->form_validation->set_message('dd_cek', 'Harus dipilih');
			return FALSE;
		} else
			return TRUE;
	}

	function tampil($data)
	{
		$this->load->view('admin/header', $data);
		$this->load->view('admin/isi');
		$this->load->view('admin/footer');
	}
}