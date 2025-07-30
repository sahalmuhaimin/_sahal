<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{
    private $api_key = '319dc17e18b12c2b04865459325a90f5';

    // api key hanya 100 per hari jika sudah limit gak bisa atau ganti api key dengan salah satu disini
    // 319dc17e18b12c2b04865459325a90f5
    // 4ceac9c2ec533e44382cb54cb9778cf4
    // elHz6yH85bcfb810a5157e137Cz3ZbMo
    // PJL6RFtBec80a95cc7c4b2c0AFZf2N4Z
    // OsEfRlnX0c6eeb3aeb0d968cXkipviSK


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
    }


    public function search_city()
    {
        $search = $this->input->get('search');
        if (!$search) {
            echo json_encode([]);
            return;
        }

        $url = 'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=' . urlencode($search);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "key: $this->api_key"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo json_encode(['error' => $err]);
            return;
        }

        $response = json_decode($response, true);

        if (!isset($response['data'])) {
            echo json_encode([]);
            return;
        }

        $result = array_map(function($item) {
            return [
                'id' => $item['id'],
                'label' => $item['label'],
                'province_name' => $item['province_name'],
                'city_name' => $item['city_name'],
                'district_name' => $item['district_name'],
                'subdistrict_name' => $item['subdistrict_name'],
                'zip_code' => $item['zip_code'],
            ];
        }, $response['data']);

        echo json_encode($result);
    }
    

    public function ekspedisi()
    {
        echo '<option value="">--Pilih Ekspedisi--</option>';
        echo '<option value="jne">JNE</option>';
        echo '<option value="tiki">TIKI</option>';
        echo '<option value="pos">POS Indonesia</option>';
    }
    

    public function paket()
    {
        $id_kota_asal = $this->input->post('origin');
        $ekspedisi = $this->input->post('courier');
        $id_kota_tujuan = $this->input->post('destination');
        $berat = $this->input->post('weight');

        if (empty($id_kota_asal) || empty($id_kota_tujuan) || empty($ekspedisi) || empty($berat)) {
            echo '<option value="">Data tidak lengkap</option>';
            return;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
                CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "origin=" . $id_kota_asal . "&destination=" . $id_kota_tujuan .
                    "&weight=" . $berat . "&courier=" . $ekspedisi,
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: $this->api_key"
                ),
            ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        // if ($err) {
        //     echo '<option value="">Koneksi Error: '.$err.'</option>';
        //     return;
        // }

        $result = json_decode($response, true);

        // if (!isset($result['meta']) || $result['meta']['code'] != 200) {
        //     $message = $result['meta']['message'] ?? 'Terjadi kesalahan';
        //     echo '<option value="">Error: '.$message.'</option>';
        //     return;
        // }

        $services = $result['data'] ?? [];

        if (empty($services)) {
            echo '<option value="">Tidak ada layanan tersedia</option>';
            return;
        }

        echo '<option value="">-- Pilih Paket --</option>';
        foreach ($services as $service) {
            $layanan = $service['service']; // contoh: JTR, REG
            $biaya = $service['cost'];
            $etd = isset($service['etd']) ? preg_replace('/[^0-9\-]/', '', $service['etd']) : '?';
            $deskripsi = $service['description'] ?? '';

            echo '<option value="'.$layanan.'" data-cost="'.$biaya.'" data-etd="'.$etd.'">';
            echo strtoupper($layanan).' - Rp '.number_format($biaya, 0, ',', '.').' ('.$deskripsi.', '.$etd.' Hari)';
            echo '</option>';
        }
    }





}
