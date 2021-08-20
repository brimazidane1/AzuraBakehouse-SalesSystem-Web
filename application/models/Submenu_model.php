<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Submenu_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get()
    {
        $this->db->order_by('user_menu.menu');
        $this->db->join('user_menu', 'user_menu.id=user_sub_menu.id_user_menu');
        return $this->db->get('user_sub_menu')->result_array();
    }

    public function edit_submenu($id)
    {
        $data = [
            'id_user_menu' => $this->input->post('pilih_menu'),
            'judul' => $this->input->post('judul'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
        ];
        $this->db->where('id_sub', $this->input->post('id_sub'));
        $this->db->update('user_sub_menu', $data);
    }

    public function hapus_submenu($id)
    {
        $this->db->where('id_sub', $id);
        $this->db->delete('user_sub_menu');
    }
}
