<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Menu_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get()
    {
        return $this->db->get_where('user_menu', 'id > 1')->result_array(); //1-20 untuk menu default user role
    }

    public function edit_menu($id)
    {
        $data = [
            'menu' => $this->input->post('menu'),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function hapus_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }
}
