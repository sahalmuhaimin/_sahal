<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
    }

    public function index()
    {
        $this->load->model('m_rating');
        $barang = $this->m_home->get_all_data();
        foreach ($barang as $b) {
            $b->avg_rating = round($this->m_rating->get_avg_rating($b->id_barang), 1);
            $b->count_rating = $this->m_rating->get_count_rating($b->id_barang);
        }
        $data = array(
            'title' => 'Home',
            'barang' => $barang,
            'isi' => 'v_home',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
    public function kategori($id_kategori)
    {
        $kategori2 = $this->m_home->kategori($id_kategori);

        $data = array(
            'title' => 'Kategori Barang : ' . $kategori2->nama_kategori,
            'barang' => $this->m_home->get_all_data_barang($id_kategori),
            'isi' => 'v_kategori_barang',

        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
    public function detail_barang($id_barang)
    {
        $this->load->model('m_rating');
        $avg_rating = round($this->m_rating->get_avg_rating($id_barang), 1);
        $count_rating = $this->m_rating->get_count_rating($id_barang);

        // Ambil review beserta nama pelanggan
        $this->db->select('tbl_rating.*, tbl_pelanggan.nama_pelanggan');
        $this->db->from('tbl_rating');
        $this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_rating.id_pelanggan', 'left');
        $this->db->where('tbl_rating.id_barang', $id_barang);
        $this->db->order_by('tbl_rating.tgl_rating', 'desc');
        $reviews = $this->db->get()->result();

        $data = array(
            'title' => 'Detail Barang : ',
            'gambar' => $this->m_home->gambar_barang($id_barang),
            'barang' => $this->m_home->detail_barang($id_barang),
            'avg_rating' => $avg_rating,
            'count_rating' => $count_rating,
            'reviews' => $reviews,
            'isi' => 'v_detail_barang',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
}
