<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Buku
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('buku/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Buku
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($buku) :
                    foreach ($buku as $b) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['id_buku']; ?></td>
                            <td><?= $b['judul_buku']; ?></td>
                            <td><?= $b['kategori']; ?></td>
                            <td><?= $b['penerbit']; ?></td>
                            <td><?= $b['harga']; ?></td>
                            <td><?= $b['stok']; ?></td>
                            <td>
                                <a href="<?= base_url('buku/edit/') . $b['id_buku'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="<?= base_url('buku/delete/') . $b['id_buku'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>