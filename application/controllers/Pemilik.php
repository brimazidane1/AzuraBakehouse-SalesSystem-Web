<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemilik extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_model', '', TRUE);
		$this->load->model('Konsinyi_model', '', TRUE);
		$this->load->model('Persediaan_model', '', TRUE);
		$this->load->model('Penjualan_model', '', TRUE);
		$this->load->model('Users_model', '', TRUE);

		//cek session dan role
		cek_login();
	}

	public function index()
	{
		$data['title'] = "Profile";

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemilik/profile', $data);
		$this->load->view('templates/footer');
	}

	//menu kelola user
	public function kelola_user()
	{
		$data['title'] = "Kelola User";

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		//model
		$data['get_users'] = $this->Users_model->get();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemilik/kelola_user', $data);
		$this->load->view('templates/footer');
	}

	public function register()
	{
		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		//rules inputan form
		$this->form_validation->set_rules('nama', 'Nama User', 'required|trim');

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
			'is_unique' => 'Username tersebut sudah ada!',
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[repeat_password]', [
			'matches' => 'Password tidak cocok!',
			'min_length' => 'Password minimal 6 karakter!'
		]);
		$this->form_validation->set_rules('repeat_password', 'Password', 'required|matches[password]');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required|min_length[11]|max_length[13]', [
			'min_length' => 'No HP minimal 11 digit!',
			'max_length' => 'No HP maximal 13 digit!'
		]);
		$this->form_validation->set_rules('pilih_role', 'Role', 'required');

		//load data role
		$data['daftar_role'] = $this->Users_model->get_role();
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Register';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('pemilik/register', $data);
			$this->load->view('templates/auth_footer');
		} else {
			if ($this->input->post('pilih_role') == 7) {
				$data = [
					'nama' => htmlspecialchars($this->input->post('nama', true)),
					'username' => htmlspecialchars($this->input->post('username', true)),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'no_hp' => $this->input->post('no_hp'),
					'id_role' => $this->input->post('pilih_role'),
				];
				$this->db->insert('users', $data);
				$id_user = $this->db->insert_id();

				$data2 = [
					'vendor_mitra' => "",
					'nama_mitra' => "",
					'pic_mitra' => "",
					'kode_bank_mitra' => "",
					'nama_bank_mitra' => "",
					'no_rek_mitra' => "",
					'nama_rek_mitra' => "",
					'telp_mitra' => "",
					'id_user' => $id_user
				];
				$this->db->insert('cgl_mitra', $data2);

				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-check"></i>Success!</h5>
					User telah berhasil ditambahkan!
				</div>'
				);
				redirect('pemilik/kelola_user');
			} else {
				$data = [
					'nama' => htmlspecialchars($this->input->post('nama', true)),
					'username' => htmlspecialchars($this->input->post('username', true)),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'no_hp' => $this->input->post('no_hp'),
					'id_role' => $this->input->post('pilih_role'),
				];

				$this->db->insert('users', $data);
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-check"></i>Success!</h5>
					User telah berhasil ditambahkan!
				</div>'
				);
				redirect('pemilik/kelola_user');
			}
		}
	}

	public function reset_user($id)
	{
		$data['title'] = "Reset Password";

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		//baca id dari reset 
		$data['reset_user'] = $this->db->get_where('users', ['id' => $id])->row_array();

		//validasi form
		$this->form_validation->set_rules('passwordBaru1', 'Password Baru', 'required|min_length[6]|matches[passwordBaru2]', [
			'matches' => 'Maaf, password yang anda masukkan tidak cocok!',
			'min_length' => 'Password harus diisi dengan minimal 6 karakter!'
		]);
		$this->form_validation->set_rules(
			'passwordBaru2',
			'Ulangi Password',
			'required'
		);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('pemilik/reset_user', $data);
			$this->load->view('templates/footer');
		} else {

			$passwordBaru1 = $this->input->post('passwordBaru1');
			$passwordBaru2 = $this->input->post('passwordBaru2');
			$id = $this->input->post('id');

			if ($passwordBaru1 != $passwordBaru2) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Password yang anda masukkan tidak cocok!
                  </div>'
				);
				redirect('pemilik/reset_user/' . $id);
			} else {
				//password benar dan ganti password
				$passwordHash = password_hash($passwordBaru1, PASSWORD_DEFAULT);
				$this->db->set('password', $passwordHash);
				$this->db->where('id', $id);
				$this->db->update('users');

				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-check"></i>Success!</h5>
					Password user telah berhasil direset!
				  </div>'
				);
				redirect('pemilik/kelola_user');
			}
		}
	}

	public function edit_user($id)
	{

		$data['title'] = 'Edit User';

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		//baca id dari reset 
		$data['user'] = $this->db->get_where('users', ['id' => $id])->row_array();

		//load data role
		$data['daftar_role'] = $this->Users_model->get_role();

		//validasi form
		$this->form_validation->set_rules('nama', 'Nama User', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required');
		$this->form_validation->set_rules('pilih_role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('pemilik/edit_user', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Users_model->edit_user($id);

			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-check"></i>Success!</h5>
				Data user telah berhasil diperbarui!
			  </div>'
			);
			redirect('pemilik/kelola_user');
		}
	}
	//end menu kelola user

	//load ajax data produk
	function get_ajax_produk()
	{
		$list = $this->Produk_model->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $item->kode_produk;
			$row[] = $item->nama_produk;
			$row[] = rupiah($item->harga_produk);
			// add html for aksi
			$row[] = '<div>
				<a class="btn btn-success btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_produk(' . "'" . $item->id_produk . "'" . ')"><span class="fas fa-pencil-alt"></span> Edit</a>
				<a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_produk(' . "'" . $item->id_produk . "'" . ')"><span class="fas fa-trash"></span> Hapus</a>
				</div>';

			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Produk_model->count_all(),
			"recordsFiltered" => $this->Produk_model->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function data_produk()
	{
		$data['title'] = "Data Produk";

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemilik/data_produk', $data);
		$this->load->view('templates/footer');
	}

	public function insert_produk_ajax()
	{
		//validasi inputan
		$this->_validate_insert_produk();

		//random code
		$random_hash = md5(uniqid(rand(), true));

		//insert ke database
		$data = array(
			'kode_produk' => "P" . substr($random_hash, 0, 5),
			'nama_produk' => $this->input->post('nama_produk'),
			'harga_produk' => $this->input->post('harga_produk')
		);
		$id = $this->Produk_model->insert_produk($data);

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "menambahkan produk dengan nama " . $this->input->post('nama_produk'),
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit_produk_ajax($id_produk)
	{
		//cek doc id terakhir pada tagihan
		$data = $this->Produk_model->get_by_id($id_produk);

		echo json_encode($data);
	}

	public function update_produk_ajax()
	{
		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		$this->_validate_update_produk();

		//cek id
		$id = $this->input->post('id_produk');

		$data = array(
			'nama_produk' => $this->input->post('nama_produk'),
			'harga_produk' => $this->input->post('harga_produk')
		);
		$this->Produk_model->update_produk($data, [
			'id_produk' => $id,
		]);

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "mengedit produk dengan nama " . $this->input->post('nama_produk'),
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		echo json_encode(array("status" => TRUE));
	}

	public function delete_produk_ajax($id)
	{
		$produk = $this->db->get_where('produk', ['id_produk' => $id])->row_array();

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "menghapus produk dengan nama " . $produk['nama_produk'],
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		$this->Produk_model->delete_produk($id);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_insert_produk()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_produk') == '') {
			$data['inputerror'][] = 'nama_produk';
			$data['error_string'][] = 'Nama Produk wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harga_produk') == '') {
			$data['inputerror'][] = 'harga_produk';
			$data['error_string'][] = 'Harga Produk wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_update_produk()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_produk') == '') {
			$data['inputerror'][] = 'nama_produk';
			$data['error_string'][] = 'Nama Produk wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harga_produk') == '') {
			$data['inputerror'][] = 'harga_produk';
			$data['error_string'][] = 'Harga Produk wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	//end menu data produk

	//load ajax data konsinyi
	function get_ajax_konsinyi()
	{
		$list = $this->Konsinyi_model->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $item->kode_konsinyi;
			$row[] = $item->nama_konsinyi;
			$row[] = $item->alamat_konsinyi;
			$row[] = $item->nohp_konsinyi;
			// add html for aksi
			$row[] = '<div>
				<a class="btn btn-success btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_konsinyi(' . "'" . $item->id_konsinyi . "'" . ')"><span class="fas fa-pencil-alt"></span> Edit</a>
				<a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_konsinyi(' . "'" . $item->id_konsinyi . "'" . ')"><span class="fas fa-trash"></span> Hapus</a>
				</div>';

			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Konsinyi_model->count_all(),
			"recordsFiltered" => $this->Konsinyi_model->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function data_konsinyi()
	{
		$data['title'] = "Data Konsinyi";

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemilik/data_konsinyi', $data);
		$this->load->view('templates/footer');
	}

	public function insert_konsinyi_ajax()
	{
		//validasi inputan
		$this->_validate_insert_konsinyi();

		//random code
		$random_hash = md5(uniqid(rand(), true));

		//insert ke database
		$data = array(
			'kode_konsinyi' => "C" . substr($random_hash, 0, 5),
			'nama_konsinyi' => $this->input->post('nama_konsinyi'),
			'alamat_konsinyi' => $this->input->post('alamat_konsinyi'),
			'nohp_konsinyi' => $this->input->post('nohp_konsinyi'),
		);
		$id = $this->Konsinyi_model->insert_konsinyi($data);

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "menambahkan konsinyi dengan nama " . $this->input->post('nama_konsinyi'),
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit_konsinyi_ajax($id_konsinyi)
	{
		$data = $this->Konsinyi_model->get_by_id($id_konsinyi);

		echo json_encode($data);
	}

	public function update_konsinyi_ajax()
	{
		$this->_validate_update_konsinyi();

		//cek id
		$id = $this->input->post('id_konsinyi');

		$data = array(
			'nama_konsinyi' => $this->input->post('nama_konsinyi'),
			'alamat_konsinyi' => $this->input->post('alamat_konsinyi'),
			'nohp_konsinyi' => $this->input->post('nohp_konsinyi'),
		);
		$this->Konsinyi_model->update_konsinyi($data, [
			'id_konsinyi' => $id,
		]);

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "mengedit konsinyi dengan nama " . $this->input->post('nama_konsinyi'),
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_konsinyi_ajax($id)
	{
		$konsinyi = $this->db->get_where('konsinyi', ['id_konsinyi' => $id])->row_array();

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "menghapus konsinyi dengan nama " . $konsinyi['nama_konsinyi'],
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		$this->Konsinyi_model->delete_konsinyi($id);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_insert_konsinyi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_konsinyi') == '') {
			$data['inputerror'][] = 'nama_konsinyi';
			$data['error_string'][] = 'Nama Konsinyi wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('alamat_konsinyi') == '') {
			$data['inputerror'][] = 'alamat_konsinyi';
			$data['error_string'][] = 'Alamat Konsinyi wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nohp_konsinyi') == '') {
			$data['inputerror'][] = 'nohp_konsinyi';
			$data['error_string'][] = 'No Hp Konsinyi wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_update_konsinyi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_konsinyi') == '') {
			$data['inputerror'][] = 'nama_konsinyi';
			$data['error_string'][] = 'Nama Konsinyi wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('alamat_konsinyi') == '') {
			$data['inputerror'][] = 'alamat_konsinyi';
			$data['error_string'][] = 'Alamat Konsinyi wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nohp_konsinyi') == '') {
			$data['inputerror'][] = 'nohp_konsinyi';
			$data['error_string'][] = 'No Hp Konsinyi wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	//end menu data konsinyi

	//load ajax data persediaan
	function get_ajax_persediaan()
	{
		$list = $this->Persediaan_model->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $no . ".";
			$row[] = $item->kode_persediaan;
			$row[] = $item->kode_produk . " - " . $item->nama_produk;
			$row[] = rupiah($item->harga_produk);
			$row[] = $item->jumlah_persediaan;
			$row[] = $item->satuan_persediaan;
			$row[] = $item->tanggal_masuk;
			$row[] = $item->tanggal_exp;
			// add html for aksi
			$row[] = '<div>
					<a class="btn btn-success btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_persediaan(' . "'" . $item->id_persediaan . "'" . ')"><span class="fas fa-pencil-alt"></span> Edit</a>
					<a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_persediaan(' . "'" . $item->id_persediaan . "'" . ')"><span class="fas fa-trash"></span> Hapus</a>
					</div>';

			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Persediaan_model->count_all(),
			"recordsFiltered" => $this->Persediaan_model->count_filtered(),
			"data" => $data,
		);
		// output to json format
		echo json_encode($output);
	}

	public function data_persediaan()
	{
		$data['title'] = "Data Persediaan";

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		//dropdown produk
		$data['daftar_produk'] = $this->db->get('produk')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemilik/data_persediaan', $data);
		$this->load->view('templates/footer');
	}

	public function insert_persediaan_ajax()
	{
		//validasi inputan
		$this->_validate_insert_persediaan();

		//random code
		$random_hash = md5(uniqid(rand(), true));

		//insert ke database
		$data = array(
			'id_produk' => $this->input->post('id_produk'),
			'kode_persediaan' => "PS" . substr($random_hash, 0, 5),
			'jumlah_persediaan' => $this->input->post('jumlah_persediaan'),
			'satuan_persediaan' => $this->input->post('satuan_persediaan'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'tanggal_exp' => $this->input->post('tanggal_exp'),
		);
		$id = $this->Persediaan_model->insert_persediaan($data);

		//insert log 
		$produk = $this->db->get_where('produk', ['id_produk' => $this->input->post('id_produk')])->row_array();

		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "menambahkan persediaan produk " . $produk['nama_produk'],
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit_persediaan_ajax($id_persediaan)
	{
		//cek doc id terakhir pada tagihan
		$data = $this->Persediaan_model->get_by_id($id_persediaan);

		echo json_encode($data);
	}

	public function update_persediaan_ajax()
	{
		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		$this->_validate_update_persediaan();

		//cek id
		$id = $this->input->post('id_persediaan');

		$data = array(
			'id_produk' => $this->input->post('id_produk'),
			'jumlah_persediaan' => $this->input->post('jumlah_persediaan'),
			'satuan_persediaan' => $this->input->post('satuan_persediaan'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'tanggal_exp' => $this->input->post('tanggal_exp'),
		);
		$this->Persediaan_model->update_persediaan($data, [
			'id_persediaan' => $id,
		]);

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "mengedit persediaan produk id " . $this->input->post('id_produk'),
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_persediaan_ajax($id)
	{
		$persediaan = $this->db->get_where('persediaan', ['id_persediaan' => $id])->row_array();
		$produk = $this->db->get_where('produk', ['id_produk' => $persediaan['id_produk']])->row_array();

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "menghapus persediaan produk " . $produk['nama_produk'],
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		$this->Persediaan_model->delete_persediaan($id);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_insert_persediaan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_produk') == '') {
			$data['inputerror'][] = 'id_produk';
			$data['error_string'][] = 'Produk wajib dipilih';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jumlah_persediaan') == '') {
			$data['inputerror'][] = 'jumlah_persediaan';
			$data['error_string'][] = 'Jumlah Persediaan wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('satuan_persediaan') == '') {
			$data['inputerror'][] = 'satuan_persediaan';
			$data['error_string'][] = 'Satuan Persediaan wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_masuk') == '') {
			$data['inputerror'][] = 'tanggal_masuk';
			$data['error_string'][] = 'Tanggal Masuk wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_exp') == '') {
			$data['inputerror'][] = 'tanggal_exp';
			$data['error_string'][] = 'Tanggal Expired wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_update_persediaan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if ($this->input->post('id_produk') == '') {
			$data['inputerror'][] = 'id_produk';
			$data['error_string'][] = 'Produk wajib dipilih';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jumlah_persediaan') == '') {
			$data['inputerror'][] = 'jumlah_persediaan';
			$data['error_string'][] = 'Jumlah Persediaan wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('satuan_persediaan') == '') {
			$data['inputerror'][] = 'satuan_persediaan';
			$data['error_string'][] = 'Satuan Persediaan wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_masuk') == '') {
			$data['inputerror'][] = 'tanggal_masuk';
			$data['error_string'][] = 'Tanggal Masuk wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_exp') == '') {
			$data['inputerror'][] = 'tanggal_exp';
			$data['error_string'][] = 'Tanggal Expired wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	//end menu data persediaan

	//load ajax data penjualan
	function get_ajax_penjualan()
	{
		$list = $this->Penjualan_model->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		$total_order = 0;
		foreach ($list as $item) {
			$no++;
			$total_order = $total_order + $item->total_penjualan;

			$row = array();
			$row[] = $no . ".";
			$row[] = $item->kode_penjualan;
			$row[] = $item->tanggal_penjualan;
			$row[] = $item->nama_konsinyi;
			$row[] = $item->nama_produk_penjualan;
			$row[] = $item->jumlah_penjualan . " " . $item->satuan_penjualan;
			$row[] = rupiah($item->harga_produk_penjualan);
			$row[] = rupiah($item->total_penjualan);
			if ($item->status_penjualan == 0) {
				$row[] = "Belum Lunas";
			} else {
				$row[] = "Lunas";
			}

			// add html for aksi
			$row[] = '<div>
						<a class="btn btn-success btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_penjualan(' . "'" . $item->id_penjualan . "'" . ')"><span class="fas fa-pencil-alt"></span> Edit</a>
						</div>';

			$data[] = $row;
		}
		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->Penjualan_model->count_all(),
			"recordsFiltered" => $this->Penjualan_model->count_filtered(),
			"data" => $data,
			"total" => rupiah($total_order)
		);
		// output to json format
		echo json_encode($output);
	}

	public function data_penjualan()
	{
		$data['title'] = "Data Penjualan";

		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		//dropdown produk
		$data['daftar_produk'] = $this->db->get('produk')->result_array();

		//dropdown konsinyi
		$data['daftar_konsinyi'] = $this->db->get('konsinyi')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemilik/data_penjualan', $data);
		$this->load->view('templates/footer');
	}

	//FIFO pada penjualan
	public function insert_penjualan_ajax()
	{
		//validasi inputan
		$this->_validate_insert_penjualan();

		//inputan
		$id_konsinyi = $this->input->post('id_konsinyi');
		$id_produk = $this->input->post('id_produk');
		$tanggal_penjualan = $this->input->post('tanggal_penjualan');
		$jumlah_penjualan = $this->input->post('jumlah_penjualan');
		$satuan_penjualan = "";
		$status_penjualan = $this->input->post('status_penjualan');

		//get total seluruh stok produk yang (belum exp dan jumlah persediaan masih ada/lebih besar dari 0)
		$this->db->select_sum('jumlah_persediaan');
		$this->db->where('tanggal_masuk <= "' . $tanggal_penjualan . '"');
		$this->db->where('tanggal_exp >= "' . $tanggal_penjualan . '"');
		$this->db->where('id_produk', $id_produk);
		$this->db->where('jumlah_persediaan >', 0);
		$stok = $this->db->get('persediaan')->row_array();

		$total_stok = $stok['jumlah_persediaan'];

		//get seluruh data persediaan yang (belum exp dan jumlah persediaan masih ada/lebih besar dari 0)
		$this->db->select('id_persediaan, id_produk, jumlah_persediaan, satuan_persediaan, tanggal_masuk');
		$this->db->where('tanggal_masuk <= "' . $tanggal_penjualan . '"');
		$this->db->where('tanggal_exp >= "' . $tanggal_penjualan . '"');
		$this->db->where('id_produk', $id_produk);
		$this->db->where('jumlah_persediaan >', 0);
		$this->db->order_by('tanggal_masuk', 'asc');
		$persediaan = $this->db->get('persediaan')->result_array();

		//bandingkan jika jumlah penjualan masih lebih kecil dari keseluruhan stok yang ada (berarti masih ada)
		if ($jumlah_penjualan <= $total_stok) {
			//looping setiap persediaan yang ada tadi
			foreach ($persediaan as $p) {
				//cek jumlah penjualan (selama masih belum 0 akan dilakukan perulangan kepersediaan yang ada berdasarkan FIFO)
				if ($jumlah_penjualan > 0) {
					//get satuan
					$satuan_penjualan = $p['satuan_persediaan'];

					// temporary jumlah_penjualan untuk pengurangan setiap persediaan yang ada
					$temp_jumlah_penjualan = $jumlah_penjualan;

					//proses pengurangan dari persediaan yang ada
					$jumlah_penjualan = $jumlah_penjualan - $p['jumlah_persediaan'];

					//cek apakah jumlah penjualan masih ada lagi atau tidak (jika ya berarti persediaan pada fifo urutan pertama belum mencukupi)
					if ($jumlah_penjualan > 0) {
						//jadi jumlah persediaan langsung di set 0
						$jumlah_persediaan = 0;
					} else {
						//jika tidak berarti persedian pada fifo urutan pertama telah mencukupi penjualan (dan langsung kurangi persediaan tsb)
						$jumlah_persediaan = $p['jumlah_persediaan'] - $temp_jumlah_penjualan;
					}

					//update persediaan
					$data = array('jumlah_persediaan' => $jumlah_persediaan);
					$this->Persediaan_model->update_persediaan($data, ['id_persediaan' => $p['id_persediaan']]);
				}
			}
			//random kode
			$random_hash = md5(uniqid(rand(), true));

			//get data produk
			$produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();

			//insert data penjualan
			$data = array(
				'id_konsinyi' => $id_konsinyi,
				'kode_penjualan' => "PJ" . substr($random_hash, 0, 5),
				'tanggal_penjualan' => $tanggal_penjualan,
				'kode_produk_penjualan' => $produk['kode_produk'],
				'nama_produk_penjualan' => $produk['nama_produk'],
				'jumlah_penjualan' => $this->input->post('jumlah_penjualan'),
				'satuan_penjualan' => $satuan_penjualan,
				'harga_produk_penjualan' => $produk['harga_produk'],
				'total_penjualan' => $produk['harga_produk'] * $this->input->post('jumlah_penjualan'),
				'status_penjualan' => $status_penjualan,
				'id_user' => $this->session->userdata('id')
			);
			$id = $this->Penjualan_model->insert_penjualan($data);

			echo json_encode(array("status" => TRUE, "persediaan" => TRUE));
		} else {
			//persediaan produk tidak mencukupi
			echo json_encode(array("status" => TRUE, "persediaan" => FALSE));
		}
	}

	public function edit_penjualan_ajax($id_penjualan)
	{
		//cek doc id terakhir pada tagihan
		$data = $this->Penjualan_model->get_by_id($id_penjualan);

		echo json_encode($data);
	}

	public function update_penjualan_ajax()
	{
		//baca session dari form login
		$this->db->join('role', 'role.id_role=users.id_role');
		$data['users'] = $this->db->get_where('users', ['id' =>
		$this->session->userdata('id')])->row_array();

		$this->_validate_update_penjualan();

		//cek id
		$id = $this->input->post('id_penjualan');

		$data = array(
			'status_penjualan' => $this->input->post('status_penjualan'),
		);
		$this->Penjualan_model->update_penjualan($data, [
			'id_penjualan' => $id,
		]);

		//insert log 
		$penjualan = $this->db->get_where('penjualan', ['id_penjualan' => $id])->row_array();

		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "mengedit penjualan dengan kode " . $penjualan['kode_penjualan'],
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_penjualan_ajax($id)
	{
		$penjualan = $this->db->get_where('penjualan', ['id_penjualan' => $id])->row_array();

		//insert log 
		$data = array(
			'tgl_activity' => date("Y-m-d h:i:s"),
			'id_user' => $this->session->userdata('id'),
			'ket_activity' => "menghapus penjualan dengan kode " . $penjualan['kode_penjualan'],
			'ip' => $this->input->ip_address()
		);
		$this->db->insert('activity', $data);

		$this->Penjualan_model->delete_penjualan($id);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_insert_penjualan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_konsinyi') == '') {
			$data['inputerror'][] = 'id_konsinyi';
			$data['error_string'][] = 'Konsinyi wajib dipilih';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggal_penjualan') == '') {
			$data['inputerror'][] = 'tanggal_penjualan';
			$data['error_string'][] = 'Tanggal Penjualan wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jumlah_penjualan') == '') {
			$data['inputerror'][] = 'jumlah_penjualan';
			$data['error_string'][] = 'Jumlah wajib diisi';
			$data['status'] = FALSE;
		}

		if ($this->input->post('status_penjualan') == '') {
			$data['inputerror'][] = 'status_penjualan';
			$data['error_string'][] = 'Status wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	private function _validate_update_penjualan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('status_penjualan') == '') {
			$data['inputerror'][] = 'status_penjualan';
			$data['error_string'][] = 'Status wajib diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	//end menu data penjualan


}
