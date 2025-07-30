<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-shopping-cart"></i> Checkout
                <small class="float-right">Date: <?= date('d-m-Y'); ?></small>
            </h4>
        </div>
        <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Barang</th>
                        <th>Total Harga</th>
                        <th>Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    <?php
                    $tot_berat = 0;
                    foreach ($this->cart->contents() as $items) {
                        $barang = $this->m_home->detail_barang($items['id']);
                        $berat = $items['qty'] * $barang->berat;
                        $tot_berat = $tot_berat + $berat;
                    ?>
                        <tr>
                            <td><?php echo $items['qty']; ?></td>
                            <td>Rp. <?php echo number_format($items['price'], 0); ?></td>
                            <td><?php echo $items['name']; ?></td>
                            <td>Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
                            <td><?= $berat ?> gr</td>
                        </tr>
                        <?php $i++; ?>

                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php
    echo validation_errors('<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-exclamation-triangle"></i> Alert! ', '</div>');
    ?>
    <?php
    echo form_open('belanja/checkout');
    $no_order = date('Ymd') . strtoupper(random_string('alnum', 8));

    ?>
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-sm-8 invoice-col">
            To :
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group position-relative">
                        <label>Cari Kota Tujuan</label>
                        <textarea id="search_city" class="form-control" placeholder="Misal: Bandung" rows="2"></textarea>
                        <div id="city_results" class="list-group" style="position: absolute; z-index: 9999; width: 100%; max-height: 200px; overflow-y: auto;"></div>
                    </div>
                </div>



                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ekspedisi</label>
                        <select name="ekspedisi" id="ekspedisi" class="form-control"></select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Paket</label>
                        <select name="paket" id="paket" class="form-control"></select>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <input name="alamat" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kode POS</label>
                        <input name="kode_pos" id="zip_code" class="form-control" required readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input name="nama_penerima" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Grand Total:</th>
                        <th>Rp. <?php echo number_format($this->cart->total(), 0); ?></th>
                    </tr>
                    <tr>
                        <th>Berat:</th>
                        <th><?= $tot_berat; ?> gr</th>
                    </tr>
                    <tr>
                        <th>Ongkir:</th>
                        <th><label id="ongkir"></label></th>
                    </tr>
                    <tr>
                        <th>Total Bayar:</th>
                        <th><label id="total_bayar"></label></th>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Simpan Transaksi -->
    <input name="no_order" value="<?= $no_order ?>" type="hidden">
    <input name="estimasi" type="hidden">
    <input name="ongkir" type="hidden">
    <input name="berat" type="hidden" value="<?= $tot_berat ?>"><br>
    <input name="grand_total" type="hidden" value="<?= $this->cart->total() ?>">
    <input name="total_bayar" type="hidden">
    <!-- End Simpan Transaksi -->


    <!-- Hidden Inputs -->
    <input type="hidden" name="city_id" id="destination_city_id">
    <input type="hidden" name="kota" id="destination_city_name">
    <input type="hidden" name="provinsi" id="destination_province_name">
    <input type="hidden" name="district_name" id="district_name">
    <input type="hidden" name="subdistrict_name" id="subdistrict_name">
    <!-- <input type="text" name="zip_code" id="zip_code"> -->

    <input type="hidden" id="kota_asal" name="kota_asal" value="17473">

    <!-- Simpan Rinci Transaksi -->
    <?php
    $i = 1;
    foreach ($this->cart->contents() as $items) {
        echo form_hidden('qty' . $i++, $items['qty']);
    }
    ?>
    <!-- End Simpan Rinci Transaksi -->

    <div class="row no-print">
        <div class="col-12">
            <a href="<?= base_url('belanja') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali</a>
            <a href="<?= base_url('belanja/checkout') ?>" onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

            <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Proses Checkout
            </button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<!-- /.invoice -->

<script>
    $(document).ready(function() {
        // 1. Pencarian Kota Tujuan
        $('#search_city').on('input', function() {
            let keyword = $(this).val();

            if (keyword.length < 3) {
                $('#city_results').empty();
                return;
            }

            $.ajax({
                url: "<?= base_url('rajaongkir/search_city') ?>",
                method: 'GET',
                data: {
                    search: keyword
                },
                dataType: 'json',
                success: function(response) {
                    let html = '';
                    response.forEach(function(item) {
                        html += `
                        <a href="#" class="list-group-item city-item"
                            data-id="${item.id}"
                            data-province="${item.province_name}"
                            data-city="${item.city_name}"
                            data-district="${item.district_name}"
                            data-subdistrict="${item.subdistrict_name}"
                            data-zipcode="${item.zip_code}">
                            ${item.label}
                        </a>`;
                    });
                    $('#city_results').html(html);
                },
                error: function(err) {
                    console.log('City search error:', err);
                }
            });
        });

        // 2. Ketika Kota Dipilih
        $(document).on('click', '.city-item', function(e) {
            e.preventDefault();
            const idKota = $(this).data('id');
            const subdistrict = $(this).data('subdistrict');
            const district = $(this).data('district');
            const city = $(this).data('city');
            const province = $(this).data('province');
            const zip = $(this).data('zipcode');

            // Tampilkan lokasi di input dan simpan ke hidden field
            $('#search_city').val(`${subdistrict}, ${district}, ${city}, ${province}, ${zip}`);
            $('#destination_city_id').val(idKota);
            $('#destination_city_name').val(city);
            $('#destination_province_name').val(province);
            $('#district_name').val(district);
            $('#subdistrict_name').val(subdistrict);
            $('#zip_code').val(zip);
            $('#city_results').empty();

            // 3. Ambil Daftar Ekspedisi
            $.ajax({
                url: "<?= base_url('rajaongkir/ekspedisi') ?>",
                method: "GET",
                success: function(data) {
                    $('#ekspedisi').html(data);

                    // Langsung load paket untuk ekspedisi pertama
                    loadPaket();
                },
                error: function(err) {
                    console.log('Load ekspedisi error:', err);
                }
            });
        });

        // 4. Ketika Ekspedisi Diubah
        $(document).on('change', '#ekspedisi', function() {
            loadPaket();
        });

        // 5. Fungsi untuk Memuat Paket Pengiriman
        function loadPaket() {
            let ekspedisi = $('#ekspedisi').val();
            let kota_asal = $('#kota_asal').val();
            let kota_tujuan = $('#destination_city_id').val();
            let total_berat = <?= $tot_berat ?>;

            // console.log('Mengambil paket dengan parameter:', {
            //     courier: ekspedisi,
            //     origin: kota_asal,
            //     destination: kota_tujuan,
            //     weight: total_berat
            // });

            if (ekspedisi && kota_asal && kota_tujuan && total_berat) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('rajaongkir/paket') ?>",
                    data: {
                        origin: kota_asal,
                        courier: ekspedisi,
                        destination: kota_tujuan,
                        weight: total_berat
                    },
                    success: function(response) {
                        // console.log('Response paket:', response);
                        $("#paket").html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error load paket:', error);
                        $("#paket").html('<option value="">Gagal memuat paket</option>');
                    }
                });
            } else {
                $("#paket").html('<option value="">Lengkapi data terlebih dahulu</option>');
            }
        }

        // 6. Perbaiki event handler untuk paket yang dipilih
        $('#paket').on('change', function() {
            let selectedOption = $(this).find('option:selected');
            let ongkir = selectedOption.data('cost') || 0;
            let estimasi = selectedOption.data('etd') || '?';

            let total_bayar = parseInt(<?= $this->cart->total() ?>) + parseInt(ongkir);

            $('input[name="ongkir"]').val(ongkir);
            $('input[name="estimasi"]').val(estimasi);
            $('input[name="total_bayar"]').val(total_bayar);

            $('#ongkir').text('Rp ' + new Intl.NumberFormat().format(ongkir));
            $('#total_bayar').text('Rp ' + new Intl.NumberFormat().format(total_bayar));
        });


    });
</script>



<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('4bc5ccb5eab937c6eff4', {
        cluster: 'ap1',
        encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        addData(data);
    });

    function addData(data) {
        var str = '';
        for (var z in data) {
            str += '<p><span><b>' + data[z].id_pengirim + '</b></span> - <span>' + data[z].message + '</span></p>'
        }
        $('#pesan').html(str);
    }
</script>

<script>
    function store() {
        var value = {
            message: $('#message').val(),
            id_pengirim: $('#id_pengirim').val(),
            id_penerima: $('#id_penerima').val()
        }
        $.ajax({
            url: '<?= site_url(); ?>/chat/store',
            type: 'POST',
            data: value,
            dataType: 'JSON'
        });
    }
</script>