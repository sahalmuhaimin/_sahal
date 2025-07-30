<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_retur extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('tbl_retur', $data);
    }

    public function get_all()
    {
        $this->db->select('tbl_retur.*, tbl_transaksi.no_order, tbl_pelanggan.nama_pelanggan');
        $this->db->from('tbl_retur');
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_retur.id_transaksi', 'left');
        $this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_retur.id_pelanggan', 'left');
        $this->db->order_by('tbl_retur.id_retur', 'desc');
        return $this->db->get()->result();
    }

    public function get_by_pelanggan($id_pelanggan)
    {
        $this->db->select('tbl_retur.*, tbl_transaksi.no_order');
        $this->db->from('tbl_retur');
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_retur.id_transaksi', 'left');
        $this->db->where('tbl_retur.id_pelanggan', $id_pelanggan);
        $this->db->order_by('tbl_retur.id_retur', 'desc');
        return $this->db->get()->result();
    }

    public function update($data)
    {
        $this->db->where('id_retur', $data['id_retur']);
        $this->db->update('tbl_retur', $data);
    }

    public function update_proses($id_retur, $proses_retur)
    {
        $this->db->where('id_retur', $id_retur);
        $this->db->update('tbl_retur', ['proses_retur' => $proses_retur]);
    }
}