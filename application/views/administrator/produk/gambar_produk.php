<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><?= html_escape($title) ?></h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <?= $this->session->flashdata('pesan'); ?>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Unggah Gambar Baru</h3>
                </div>
                <form action="<?= base_url('admin/produk/gambar/' . $produk['id_produk']) ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih File Gambar</label>
                            <input type="file" name="nama_gambar" class="form-control-file" required>
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF, WEBP (Maks: 2MB)</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Unggah</button>
                        <a href="<?= base_url('admin/produk') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Produk</a>
                    </div>
                </form>
            </div>

            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Daftar Gambar Produk</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if (!empty($gambar)): ?>
                            <?php foreach ($gambar as $g): ?>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="card h-100 text-center">
                                        <img src="<?= base_url('assets/images/produk/' . $g['nama_gambar']) ?>" class="card-img-top p-2" style="height: 180px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <button type="button" class="btn btn-warning btn-xs mb-1" data-toggle="modal" data-target="#modalUbah<?= $g['id_gambar'] ?>">
                                                <i class="fas fa-sync"></i> Ganti Gambar
                                            </button>
                                            <a href="<?= base_url('admin/produk/gambar/hapus/' . $g['id_gambar']) ?>" class="btn btn-danger btn-xs mb-1" onclick="return confirm('Hapus gambar ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Ubah Gambar -->
                                <div class="modal fade" id="modalUbah<?= $g['id_gambar'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ganti Gambar</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('admin/produk/gambar/ubah/' . $g['id_gambar']) ?>" method="post" enctype="multipart/form-data">
                                                <div class="modal-body text-center">
                                                    <img src="<?= base_url('assets/images/produk/' . $g['nama_gambar']) ?>" class="img-fluid mb-3" style="max-height: 150px;">
                                                    <div class="form-group text-left">
                                                        <label>Pilih Gambar Pengganti</label>
                                                        <input type="file" name="nama_gambar" class="form-control-file" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center text-muted">
                                <p>Belum ada gambar untuk produk ini.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>