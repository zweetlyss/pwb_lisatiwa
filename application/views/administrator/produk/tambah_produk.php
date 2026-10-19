<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><?= html_escape($title) ?></h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="<?= base_url('admin/produk/tambah') ?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" required>
                            <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="categori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k['id_kategori'] ?>">
                                        <?= html_escape($k['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('categori_id', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="<?= set_value('harga') ?>" required>
                            <?= form_error('harga', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?= set_value('stok') ?>">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"><?= set_value('deskripsi') ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('admin/produk') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>