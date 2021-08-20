<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Users_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get()
    {
        $this->db->join('role', 'role.id_role=users.id_role');
        return $this->db->get('users')->result_array();
    }

    function get_users_mitra()
    {
        $this->db->where('id_role', 7);
        return $this->db->get('users')->result_array();
    }


    function get_role()
    {
        $this->db->order_by('role', 'asc');
        $query = $this->db->get('role');
        return $query->result_array();
    }

    public function edit_user($id)
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'no_hp' => $this->input->post('no_hp'),
            'id_role' => $this->input->post('pilih_role'),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('users', $data);
    }

    public function edit_user_mitra($id)
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'no_hp' => $this->input->post('no_hp'),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('users', $data);
    }

    public function hapus_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
}
