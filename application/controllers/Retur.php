<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_retur');
        $this->load->model('m_transaksi');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Retur',
            'retur' => $this->m_retur->get_all(),
            'isi' => 'v_pesanan_masuk', // Ganti ke view yang sudah ada
        ];
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function ajukan()
    {
        $this->form_validation->set_rules('alasan', 'Alasan Retur', 'required', ['required' => '%s harus diisi!']);
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/bukti-retur/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('bukti_retur')) {
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
            } else {
                $upload_data = $this->upload->data();
                $data = [
                    'id_transaksi' => $this->input->post('id_transaksi'),
                    'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                    'alasan' => $this->input->post('alasan'),
                    'bukti_retur' => $upload_data['file_name'],
                    'status_retur' => 0, // 0: menunggu, 1: diterima, 2: ditolak
                    'tgl_retur' => date('Y-m-d H:i:s')
                ];
                $this->m_retur->insert($data);
                $this->session->set_flashdata('pesan', 'Pengajuan retur berhasil dikirim!');
            }
            redirect('pesanan_saya');
        }
        redirect('pesanan_saya');
    }

    public function acc($id_retur)
    {
        $this->m_retur->update(['id_retur' => $id_retur, 'proses_retur' => 1]);
        $this->session->set_flashdata('pesan', 'Retur diterima!');
        redirect('admin/pesanan_masuk'); // Redirect ke pesanan masuk admin
    }

    // Barang sudah dikirim customer ke admin
    public function kirim_barang($id_retur)
    {
        $this->m_retur->update_proses($id_retur, 2);
        $this->session->set_flashdata('pesan', 'Barang retur sudah dikirim ke admin!');
        redirect('pesanan_saya');
    }

    // Barang sudah diterima admin
    public function terima_barang($id_retur)
    {
        $this->m_retur->update_proses($id_retur, 3);
        $this->session->set_flashdata('pesan', 'Barang retur sudah diterima admin!');
        redirect('admin/pesanan_masuk');
    }

    public function tolak($id_retur)
    {
        $this->m_retur->update(['id_retur' => $id_retur, 'proses_retur' => 4]);
        $this->session->set_flashdata('pesan', 'Retur ditolak!');
        redirect('admin/pesanan_masuk'); // Redirect ke pesanan masuk admin
    }
}