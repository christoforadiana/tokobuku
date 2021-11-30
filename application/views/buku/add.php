<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Buku
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('buku') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', [], ['stok' => 0]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_buku">ID Buku</label>
                    <div class="col-md-9">
                        <input readonly value="<?= set_value('id_buku', $id_buku); ?>" name="id_buku" id="id_buku" type="text" class="form-control" placeholder="ID Buku">
                        <?= form_error('id_buku', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="judul_buku">Judul Buku</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('judul_buku'); ?>" name="judul_buku" id="judul_buku" type="text" class="form-control" placeholder="Judul Buku...">
                        <?= form_error('judul_buku', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="kategori">Kategori</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('kategori'); ?>" name="kategori" id="kategori" type="text" class="form-control" placeholder="Kategori...">
                        <?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="penerbit">Penerbit</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('penerbit'); ?>" name="penerbit" id="penerbit" type="text" class="form-control" placeholder="Penerbit...">
                        <?= form_error('penerbit', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="harga">Harga</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('harga'); ?>" name="harga" id="harga" type="text" class="form-control" placeholder="Harga...">
                        <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</bu>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>