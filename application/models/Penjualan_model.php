<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Penjualan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // start tabel penjualan for server side
    var $column_order = array(null, 'nama_konsinyi', 'kode_penjualan', 'tanggal_penjualan', 'nama_produk_penjualan', 'harga_produk', 'jumlah_penjualan', 'total_penjualan', 'status_penjualan'); //set column field database for datatable orderable
    var $column_search = array('nama_konsinyi', 'kode_penjualan', 'tanggal_penjualan', 'nama_produk_penjualan'); //set column field database for datatable searchable
    var $order = array('id_penjualan' => 'desc'); // default order

    private function _get_penjualan()
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('konsinyi', 'konsinyi.id_konsinyi=penjualan.id_konsinyi');

        //custom filter
        if ($this->input->post('pilih_tanggal') != "") {
            $this->db->like('tanggal_penjualan', $this->input->post('pilih_tanggal'), 'after');
        }

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
        $this->_get_penjualan();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_penjualan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('konsinyi', 'konsinyi.id_konsinyi=penjualan.id_konsinyi');
        return $this->db->count_all_results();
    }
    // end tabel penjualan


    //query
    public function insert_penjualan($data)
    {
        $this->db->insert('penjualan', $data);
        return $this->db->insert_id();
    }

    public function update_penjualan($data, $where)
    {
        $this->db->update('penjualan', $data, $where);
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

    public function delete_penjualan($id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->delete('penjualan');
    }

    public function get_by_id($id_penjualan) //edit progress 
    {
        $this->db->select("* FROM penjualan 
                            INNER JOIN konsinyi ON konsinyi.id_konsinyi=penjualan.id_konsinyi
                            WHERE id_penjualan = '" . $id_penjualan . "'");
        $query = $this->db->get();

        return $query->row();
    }
    //end query
}
