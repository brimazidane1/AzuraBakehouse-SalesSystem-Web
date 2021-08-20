<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Produk_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // start tabel produk for server side
    var $column_order = array(null, 'kode_produk', 'nama_produk', 'harga_produk'); //set column field database for datatable orderable
    var $column_search = array('kode_produk', 'nama_produk'); //set column field database for datatable searchable
    var $order = array('id_produk' => 'desc'); // default order

    private function _get_produk()
    {
        $this->db->select('*');
        $this->db->from('produk');

        // //custom filter
        // if ($this->input->post('pilih_periode') == "" && $this->input->post('pilih_status') == "") {
        //     $this->db->group_by('id_produk');
        // } else {
        //     if ($this->input->post('pilih_periode') != "" && $this->input->post('pilih_status') == "") {
        //         $this->db->where('id_periode', $this->input->post('pilih_periode'));
        //         $this->db->group_by('id_produk');
        //     } else if ($this->input->post('pilih_periode') == "" && $this->input->post('pilih_status') != "") {
        //         $this->db->where('activity.status_activity', $this->input->post('pilih_status'));
        //         $this->db->group_by('id_produk');
        //     } else {
        //         $this->db->where('id_periode', $this->input->post('pilih_periode'));
        //         $this->db->where('activity.status_activity', $this->input->post('pilih_status'));
        //         $this->db->group_by('id_produk');
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
        $this->_get_produk();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_produk();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('produk');
        return $this->db->count_all_results();
    }
    // end tabel produk


    //query
    public function insert_produk($data)
    {
        $this->db->insert('produk', $data);
        return $this->db->insert_id();
    }

    public function update_produk($data, $where)
    {
        $this->db->update('produk', $data, $where);
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

    public function delete_produk($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('produk');
    }

    public function get_by_id($id_produk) //edit progress 
    {
        $this->db->select("* FROM produk WHERE id_produk = '" . $id_produk . "'");
        $query = $this->db->get();

        return $query->row();
    }
    //end query
}
