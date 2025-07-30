<div class="row">
    <div class="col-sm-12">

        <?php
        if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
            echo $this->session->flashdata('pesan');
            echo '</h5></div>';
        }
        ?>

        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                            href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                            aria-selected="true">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                            href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                            aria-selected="false">Diproses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                            href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                            aria-selected="false">Dikirim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                            href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings"
                            aria-selected="false">Selesai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-retur-tab" data-toggle="pill"
                            href="#custom-tabs-four-retur" role="tab" aria-controls="custom-tabs-four-retur"
                            aria-selected="false">Retur</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                        aria-labelledby="custom-tabs-four-home-tab">
                        <table class="table table-bordered">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal Order</th>
                                <th>Ekspedisi</th>
                                <th>Total Bayar</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($belum_bayar as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order; ?></td>
                                    <td><?= $value->tgl_order; ?></td>
                                    <td>
                                        <b><?= $value->ekspedisi; ?></b><br>
                                        Paket : <?= $value->paket; ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0); ?><br>
                                    </td>
                                    <td>
                                        <b>Rp. <?= number_format($value->total_bayar, 0); ?></b><br>
                                        <?php if ($value->status_bayar == 0) { ?>
                                            <span class="badge badge-warning">Belum Bayar</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Sudah Bayar</span><br>
                                            <span class="badge badge-secondary">Menunggu Verifikasi</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($value->status_bayar == 0) { ?>
                                            <a href="<?= base_url('pesanan_saya/bayar/' . $value->id_transaksi) ?>"
                                                class="btn btn-sm btn-flat btn-primary">Bayar</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!-- DATA DIPROSES -->
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-four-profile-tab">
                        <table class="table table-bordered">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal Order</th>
                                <th>Ekspedisi</th>
                                <th>Total Bayar</th>

                            </tr>
                            <?php foreach ($diproses as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order; ?></td>
                                    <td><?= $value->tgl_order; ?></td>
                                    <td>
                                        <b><?= $value->ekspedisi; ?></b><br>
                                        Paket : <?= $value->paket; ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0); ?><br>
                                    </td>
                                    <td>
                                        <b>Rp. <?= number_format($value->total_bayar, 0); ?></b><br>
                                        <span class="badge badge-success">Terverifikasi</span><br>
                                        <span class="badge badge-secondary">Diproses/Dikemas</span>
                                    </td>

                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!-- /DATA DIPROSES -->
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-four-messages-tab">
                        <table class="table table-bordered">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal Order</th>
                                <th>Ekspedisi</th>
                                <th>Total Bayar</th>
                                <th>No. Resi</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($dikirim as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order; ?></td>
                                    <td><?= $value->tgl_order; ?></td>
                                    <td>
                                        <b><?= $value->ekspedisi; ?></b><br>
                                        Paket : <?= $value->paket; ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0); ?><br>
                                    </td>
                                    <td>
                                        <b>Rp. <?= number_format($value->total_bayar, 0); ?></b><br>
                                        <span class="badge badge-success">Dikirim</span><br>
                                    </td>
                                    <td>
                                        <h4><?= $value->no_resi; ?><br></h4>
                                    </td>
                                    <td>
                                        <?php if (!empty($value->bukti_kirim)) { ?>
                                            <button data-toggle="modal" data-target="#diterima<?= $value->id_transaksi ?>"
                                                class="btn btn-sm btn-primary">Diterima</button>
                                        <?php } else { ?>
                                            <span class="badge badge-warning">Menunggu Bukti Pengiriman</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!-- Tab Selesai -->
                    <?php
                    // Buat array id_transaksi yang sudah pernah retur
                    $retur_transaksi_ids = [];
                    if (!empty($retur)) {
                        foreach ($retur as $r) {
                            $retur_transaksi_ids[] = $r->id_transaksi;
                        }
                    }
                    ?>
                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                        aria-labelledby="custom-tabs-four-settings-tab">
                        <table class="table table-bordered">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal Order</th>
                                <th>Ekspedisi</th>
                                <th>Total Bayar</th>
                                <th>No. Resi</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($selesai as $key => $value) { ?>
                                <tr>
                                    <td><?= $value->no_order; ?></td>
                                    <td><?= $value->tgl_order; ?></td>
                                    <td>
                                        <b><?= $value->ekspedisi; ?></b><br>
                                        Paket : <?= $value->paket; ?><br>
                                        Ongkir : <?= number_format($value->ongkir, 0); ?><br>
                                    </td>
                                    <td>
                                        <b>Rp. <?= number_format($value->total_bayar, 0); ?></b>
                                    </td>
                                    <td>
                                        <h4><?= $value->no_resi; ?><br></h4>
                                    </td>
                                    <td>
                                        <?php if (in_array($value->id_transaksi, $retur_transaksi_ids)) { ?>
                                            <span class="badge badge-info">Retur</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Selesai</span><br>
                                            <button data-toggle="modal" data-target="#modalRetur<?= $value->id_transaksi ?>"
                                                class="btn btn-warning btn-sm mt-2">Retur</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-retur" role="tabpanel"
                        aria-labelledby="custom-tabs-four-retur-tab">
                        <table class="table table-bordered">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal Retur</th>
                                <th>Alasan</th>
                                <th>Bukti Retur</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($retur as $r) { ?>
                                <tr>
                                    <td><?= $r->no_order ?></td>
                                    <td><?= $r->tgl_retur ?></td>
                                    <td><?= $r->alasan ?></td>
                                    <td>
                                        <?php if ($r->bukti_retur) { ?>
                                            <a href="<?= base_url('assets/bukti-retur/' . $r->bukti_retur) ?>" target="_blank">
                                                <img src="<?= base_url('assets/bukti-retur/' . $r->bukti_retur) ?>" width="100">
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($r->proses_retur == 0) {
                                            echo '<span class="badge badge-warning">Menunggu ACC</span>';
                                        } elseif ($r->proses_retur == 1) {
                                            echo '<span class="badge badge-success">Diterima, silakan kirim barang!</span><br>';
                                            echo '<a href="' . base_url('retur/kirim_barang/' . $r->id_retur) . '" class="btn btn-primary btn-sm mt-2">Saya Sudah Kirim Barang</a>';
                                        } elseif ($r->proses_retur == 2) {
                                            echo '<span class="badge badge-info">Barang dalam pengiriman ke admin</span>';
                                        } elseif ($r->proses_retur == 3) {
                                            echo '<span class="badge badge-success">Retur Selesai (Barang diterima admin)</span>';
                                        } elseif ($r->proses_retur == 4) {
                                            echo '<span class="badge badge-danger">Retur Ditolak</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<?php foreach ($dikirim as $key => $value) { ?>
    <div class="modal fade" id="diterima<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pesanan Diterima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Pesanan Sudah Diterima .. ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('pesanan_saya/diterima/' . $value->id_transaksi) ?>"
                        class="btn btn-primary">Iya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<?php foreach ($dikirim as $key => $value) { ?>
    <div class="modal fade" id="modalRetur<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Permohonan Retur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pesanan_saya/retur/' . $value->id_transaksi) ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Alasan Retur</label>
                            <textarea name="alasan" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Bukti Retur</label>
                            <input type="file" name="bukti_retur" class="form-control" accept="image/*" required>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<?php foreach ($selesai as $value) { ?>
    <div class="modal fade" id="modalRetur<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('retur/ajukan') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajukan Retur Barang</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_transaksi" value="<?= $value->id_transaksi ?>">
                        <div class="form-group">
                            <label>Alasan Retur</label>
                            <textarea name="alasan" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Bukti Foto Barang</label>
                            <input type="file" name="bukti_retur" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ajukan Retur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>