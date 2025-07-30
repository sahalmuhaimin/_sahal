<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pesanan_masuk');
        $this->load->model('m_retur');
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'total_pesanan_selesai' => $this->m_pesanan_masuk->total_pesanan_selesai(),
            'total_barang' => $this->m_admin->total_barang(),
            'total_user' => $this->m_admin->total_user(),
            'total_kategori' => $this->m_admin->total_kategori(),
            'totalmodal' => $this->m_admin->get_total_pesanan(),
            'isi' => 'v_admin',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
    public function setting()
    {
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('kota', 'Kota', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required', array(
            'required' => '%s Harus Diisi !'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Setting',
                'setting' => $this->m_admin->data_setting(),
                'isi' => 'v_setting',
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
            $data = [
                'id'   => 1,
                'lokasi'   => $this->input->post('kota'),
                'nama_toko'   => $this->input->post('nama_toko'),
                'alamat_toko'   => $this->input->post('alamat_toko'),
                'no_telepon'   => $this->input->post('no_telepon'),

            ];
            $this->m_admin->edit($data);

            $this->session->set_flashdata('pesan', 'Setting Website Berhasil di Edit !');
            redirect('admin/setting');
        }
    }
    public function pesanan_masuk()
    {
        $data = array(
            'title' => 'Pesanan Masuk',
            'pesanan_masuk' => $this->m_pesanan_masuk->pesanan_masuk(),
            'pesanan' => $this->m_pesanan_masuk->pesanan(),
            'pesanan_diproses' => $this->m_pesanan_masuk->pesanan_diproses(),
            'pesanan_dikirim' => $this->m_pesanan_masuk->pesanan_dikirim(),
            'pesanan_selesai' => $this->m_pesanan_masuk->pesanan_selesai(),
            'retur' => $this->m_retur->get_all(), // Tambahkan ini
            'isi' => 'v_pesanan_masuk',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
    public function proses($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '1',
        );

        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil Di Proses !');
        redirect('admin/pesanan_masuk');
    }
    public function kirim($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'no_resi' => $this->input->post('no_resi'),
            'status_order' => '2',
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil Di Kirim !');
        redirect('admin/pesanan_masuk');
    }
    public function detail_pembayaran($no_order)
    {
        $data = array(
            'title' => 'Detail Pembayaran',
            'pesanan_masuk' => $this->m_pesanan_masuk->detail_pembayaran($no_order),
            'isi' => 'v_detail_pembayaran',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
    public function upload_bukti_kirim($id_transaksi)
    {
        $config['upload_path'] = './assets/bukti-kirim/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']     = '2000';
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('bukti_kirim')) {
            $upload_data = $this->upload->data();
            
            $data = array(
                'id_transaksi' => $id_transaksi,
                'bukti_kirim' => $upload_data['file_name']
            );
            
            $this->m_pesanan_masuk->update_order($data);
            $this->session->set_flashdata('pesan', 'Bukti Pengiriman Berhasil Diupload!');
        }
        
        redirect('admin/pesanan_masuk');
    }
    public function retur()
    {
        $data = array(
            'title' => 'Retur',
            'retur' => $this->m_retur->get_all(),
            'isi' => 'v_retur',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
    public function tambah_retur()
    {
        $this->form_validation->set_rules('id_pesanan', 'ID Pesanan', 'required', array(
            'required' => '%s Harus Diisi !'
        ));
        $this->form_validation->set_rules('alasan_retur', 'Alasan Retur', 'required', array(
            'required' => '%s Harus Diisi !'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Tambah Retur',
                'isi' => 'v_tambah_retur',
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
            $data = [
                'id_pesanan'   => $this->input->post('id_pesanan'),
                'alasan_retur'   => $this->input->post('alasan_retur'),
                'status_retur'   => '0',
            ];
            $this->m_retur->tambah_retur($data);

            $this->session->set_flashdata('pesan', 'Retur Berhasil Ditambahkan!');
            redirect('admin/retur');
        }
    }
    public function edit_retur($id_retur)
    {
        $this->form_validation->set_rules('alasan_retur', 'Alasan Retur', 'required', array(
            'required' => '%s Harus Diisi !'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Edit Retur',
                'retur' => $this->m_retur->get_retur_by_id($id_retur),
                'isi' => 'v_edit_retur',
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
            $data = [
                'id_retur'   => $id_retur,
                'alasan_retur'   => $this->input->post('alasan_retur'),
                'status_retur'   => $this->input->post('status_retur'),
            ];
            $this->m_retur->edit_retur($data);

            $this->session->set_flashdata('pesan', 'Retur Berhasil Di Edit!');
            redirect('admin/retur');
        }
    }
    public function hapus_retur($id_retur)
    {
        $this->m_retur->hapus_retur($id_retur);
        $this->session->set_flashdata('pesan', 'Retur Berhasil Dihapus!');
        redirect('admin/retur');
    }
}
