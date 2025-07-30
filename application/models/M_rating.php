<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rating extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('tbl_rating', $data);
    }

    public function get_avg_rating($id_barang)
    {
        $this->db->select_avg('rating');
        $this->db->where('id_barang', $id_barang);
        $query = $this->db->get('tbl_rating');
        return $query->row()->rating;
    }

    public function get_user_rating($id_pelanggan, $id_barang)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_barang', $id_barang);
        return $this->db->get('tbl_rating')->row();
    }

    public function get_count_rating($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        return $this->db->get('tbl_rating')->num_rows();
    }
}