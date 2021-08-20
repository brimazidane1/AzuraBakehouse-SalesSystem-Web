<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct(); //method constructor ci
        $this->load->library('form_validation');
        $this->load->model('Users_model', '', TRUE);
    }

    //halaman login
    public function index()
    {
        //cek session
        $role = $this->db->get('role')->num_rows();
        $this->db->join('role', 'role.id_role=users.id_role');
        $users = $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row_array();

        if ($this->session->userdata('id_role')) {
            for ($i = 0; $i <= $role; $i++) {
                if ($this->session->userdata('id_role') == $i) {
                    redirect($users['role']);
                }
            }
        }

        //rules inputan form
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'AZURA BAKEHOUSE | Inventory & Sales System';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi login sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //get data user
        $users = $this->db->get_where('users', ['username' => $username])->row_array();

        if ($users) {
            //usernya ada
            if (password_verify($password, $users['password'])) {
                $data = [
                    'id' => $users['id'],
                    'nama' => $users['nama'],
                    'username' => $users['username'],
                    'id_role' => $users['id_role']
                ];
                //session nama akun dan rolenya
                $this->session->set_userdata($data);

                //get jumlah role
                $role = $this->db->get('role')->num_rows();

                for ($i = 0; $i <= $role; $i++) {
                    if ($users['id_role'] == $i) {
                        redirect($users['role']);
                    }
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Username atau password anda salah!
                  </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Maaf, akun tersebut tidak terdaftar!
              </div>'
            );
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_role');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
               Anda telah keluar dari akun anda!
              </div>'
        );
        redirect('auth');
    }

    public function blocked()
    {
        //baca session dari form login
        $this->db->join('role', 'role.id_role=users.id_role');
        $data['users'] = $this->db->get_where('users', ['id' =>
        $this->session->userdata('id')])->row_array();

        //get jumlah role
        $role = $this->db->get('role')->num_rows();

        //get id role user login
        $this->db->join('role', 'role.id_role=users.id_role');
        $users = $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row_array();

        for ($i = 0; $i < $role; $i++) {
            if ($users['id_role'] == $i) {
                $this->load->view($users['role'] . '/blocked', $data);
            }
        }
    }
}
