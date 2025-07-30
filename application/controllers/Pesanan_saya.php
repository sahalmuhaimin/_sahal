<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_pesanan_masuk');
        $this->load->model('m_retur'); // Tambahkan ini
    }

    public function index()
    {
        $data = array(
            'title' => 'Pesanan Saya',
            'belum_bayar' => $this->m_transaksi->belum_bayar(),
            'diproses' => $this->m_transaksi->diproses(),
            'dikirim' => $this->m_transaksi->dikirim(),
            'selesai' => $this->m_transaksi->selesai(),
            'retur' => $this->m_retur->get_by_pelanggan($this->session->userdata('id_pelanggan')), // Tambahkan ini
            'isi' => 'v_pesanan_saya',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function bayar($id_transaksi)
    {
        $this->form_validation->set_rules(
            'atas_nama',
            'Atas Nama',
            'required',
            array('required' => '%s Harus Diisi !')
        );

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']      = './assets/bukti_bayar/';
            $config['allowed_types']    = 'jpg|png|gif|jpeg';
            $this->upload->initialize($config);
            $field_name   = 'bukti_bayar';
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Pembayaran',
                    'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
                    'rekening' => $this->m_transaksi->rekening(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'v_bayar',
                );
                $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/bukti_bayar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'id_transaksi' => $id_transaksi,
                    'atas_nama' => $this->input->post('atas_nama'),
                    'nama_bank' => $this->input->post('nama_bank'),
                    'no_rek' => $this->input->post('no_rek'),
                    'status_bayar' => '1',
                    'bukti_bayar' => $upload_data['uploads']['file_name'],
                );
                $this->m_transaksi->upload_buktibayar($data);

                $this->session->set_flashdata('pesan', 'Bukti Pembayaran Berhasil Di Upload !');
                redirect('pesanan_saya');
            }
        }
        $data = array(
            'title' => 'Pembayaran',
            'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
            'rekening' => $this->m_transaksi->rekening(),
            'isi' => 'v_bayar',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function diterima($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '3',
        );
        $this->m_pesanan_masuk->update_order($data);
        // Ambil barang yang dibeli
        $rinci = $this->db->get_where('tbl_rinci_transaksi', ['no_order' => $this->db->get_where('tbl_transaksi', ['id_transaksi' => $id_transaksi])->row()->no_order])->result();
        // Simpan id_transaksi di session untuk rating
        $this->session->set_userdata('rating_transaksi', $id_transaksi);
        $this->session->set_flashdata('pesan', 'Pesanan Telah Di Terima ! Silakan beri rating.');
        redirect('pesanan_saya/rating/' . $id_transaksi);
    }

    public function rating($id_transaksi)
    {
        $this->load->model('m_rating');
        // Ambil no_order dulu
        $transaksi = $this->db->get_where('tbl_transaksi', ['id_transaksi' => $id_transaksi])->row();
        $no_order = $transaksi ? $transaksi->no_order : null;

        // Pastikan $no_order tidak null
        if (!$no_order) {
            show_error('Transaksi tidak ditemukan');
        }

        // JOIN tbl_rinci_transaksi dengan tbl_barang
        $this->db->select('tbl_rinci_transaksi.*, tbl_barang.nama_barang');
        $this->db->from('tbl_rinci_transaksi');
        $this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left');
        $this->db->where('tbl_rinci_transaksi.no_order', $no_order);
        $rinci = $this->db->get()->result();

        if ($this->input->post()) {
            foreach ($rinci as $r) {
                $rating = $this->input->post('rating_' . $r->id_barang);
                $review = $this->input->post('review_' . $r->id_barang);
                if ($rating) {
                    $data = [
                        'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                        'id_barang' => $r->id_barang,
                        'rating' => $rating,
                        'review' => $review,
                    ];
                    $this->m_rating->insert($data);
                }
            }
            $this->session->set_flashdata('pesan', 'Terima kasih atas rating Anda!');
            redirect('pesanan_saya');
        }
        $data = [
            'title' => 'Beri Rating',
            'rinci' => $rinci,
            'isi' => 'v_rating',
        ];
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function cod($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'metode_bayar' => 'COD',
            'status_bayar' => '1', // Pembayaran akan dilakukan saat barang sampai
            'status_order' => '1', // Status diproses
            'catatan' => $this->input->post('catatan')
        );
        
        $this->m_transaksi->update_transaksi($data);
        $this->session->set_flashdata('pesan', 'Pesanan COD Berhasil Diproses!');
        redirect('pesanan_saya');
    }
}
