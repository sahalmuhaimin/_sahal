<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Gambar Barang</h3>
        </div>

        <div class="card-body">
            <?php if ($this->session->flashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>
                        <?= $this->session->flashdata('pesan') ?>
                    </h5>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-striped" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Cover</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $no = 1;
                    foreach ($gambarbarang as $gb => $value) : ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $value->nama_barang ?></td>
                            <td class="align-middle">
                                <img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="100px">
                            </td>
                            <td class="align-middle">
                                <a href="<?= base_url('gambarbarang/add/' . $value->id_barang) ?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Add Gambar
                                </a>
                                <button data-toggle="modal" data-target="#delete" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
