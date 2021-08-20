<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Konsinyi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // start tabel konsinyi for server side
    var $column_order = array(null, 'kode_konsinyi', 'nama_konsinyi', 'alamat_konsinyi', 'nohp_konsinyi'); //set column field database for datatable orderable
    var $column_search = array('kode_konsinyi', 'nama_konsinyi', 'alamat_konsinyi', 'nohp_konsinyi'); //set column field database for datatable searchable
    var $order = array('id_konsinyi' => 'desc'); // default order

    private function _get_konsinyi()
    {
        $this->db->select('*');
        $this->db->from('konsinyi');

        // //custom filter
        // if ($this->input->post('pilih_periode') == "" && $this->input->post('pilih_status') == "") {
        //     $this->db->group_by('id_konsinyi');
        // } else {
        //     if ($this->input->post('pilih_periode') != "" && $this->input->post('pilih_status') == "") {
        //         $this->db->where('id_periode', $this->input->post('pilih_periode'));
        //         $this->db->group_by('id_konsinyi');
        //     } else if ($this->input->post('pilih_periode') == "" && $this->input->post('pilih_status') != "") {
        //         $this->db->where('activity.status_activity', $this->input->post('pilih_status'));
        //         $this->db->group_by('id_konsinyi');
        //     } else {
        //         $this->db->where('id_periode', $this->input->post('pilih_periode'));
        //         $this->db->where('activity.status_activity', $this->input->post('pilih_status'));
        //         $this->db->group_by('id_konsinyi');
        //     }
        // }

        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_konsinyi();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_konsinyi();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('konsinyi');
        return $this->db->count_all_results();
    }
    // end tabel konsinyi


    //query
    public function insert_konsinyi($data)
    {
        $this->db->insert('konsinyi', $data);
        return $this->db->insert_id();
    }

    public function update_konsinyi($data, $where)
    {
        $this->db->update('konsinyi', $data, $where);
        return $this->db->affected_rows();
    }

    public function insert_activity($data)
    {
        $this->db->insert('activity', $data);
        return $this->db->insert_id();
    }

    public function update_activity($data, $where)
    {
        $this->db->update('activity', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_konsinyi($id)
    {
        $this->db->where('id_konsinyi', $id);
        $this->db->delete('konsinyi');
    }

    public function get_by_id($id_konsinyi) //edit progress 
    {
        $this->db->select("* FROM konsinyi WHERE id_konsinyi = '" . $id_konsinyi . "'");
        $query = $this->db->get();

        return $query->row();
    }
    //end query
}
