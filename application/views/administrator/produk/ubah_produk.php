<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><?= html_escape($title) ?></h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <?= $this->session->flashdata('pesan'); ?>

            <div class="card card-warning">
                <form action="<?= base_url('admin/produk/ubah/' . $produk['id_produk']) ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama produk</label>
                            <input type="text" name="nama" class="form-control" value="<?= html_escape(set_value('nama', $produk['nama'])) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori produk</label>
                            <select name="categori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k['id_kategori'] ?>" <?= ($k['id_kategori'] == $produk['categori_id']) ? 'selected' : '' ?>>
                                        <?= html_escape($k['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="harga" class="form-control" value="<?= set_value('harga', $produk['harga']) ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Stok produk</label>
                            <input type="number" name="stok" class="form-control" value="<?= set_value('stok', $produk['stok']) ?>">
                        </div>

                        <!-- BAGIAN UPLOAD & DAFTAR GAMBAR PRODUK (SESUAI TUGAS MODUL) -->
                        <div class="form-group">
                            <label>Gambar Produk</label>
                                <!-- Pastikan ada id="inputGambar" dan onchange="previewImage(event)" -->
                                <input type="file" name="nama_gambar" id="inputGambar" class="form-control-file mb-3" onchange="previewImage(event)">

                                <!-- Pastikan ada id="livePreviewContainer" dan id="imgPreview" -->
                                <div id="livePreviewContainer" class="mb-3 d-none">
                                    <label class="text-info"><small>* Preview gambar yang baru dipilih:</small></label>
                                    <div>
                                        <img id="imgPreview" src="#" class="img-thumbnail" style="max-height: 180px;">
                                    </div>
                                </div>

                            <!-- Tampilan Grid Gambar Sesuai Modul -->
                            <div class="row">
                                <?php if (!empty($gambar)): ?>
                                    <?php foreach ($gambar as $g): ?>
                                        <div class="col-md-3 col-6 mb-3 text-center">
                                            <div class="border p-2 rounded">
                                                <img src="<?= base_url('uploads/produk/' . $g['nama_gambar']) ?>" class="img-fluid mb-2" style="height: 180px; object-fit: cover; width: 100%;">
                                                <a href="<?= base_url('admin/produk/gambar/hapus/' . $g['id_gambar']) ?>" class="btn btn-danger btn-block btn-sm" onclick="return confirm('Hapus gambar ini?')">
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"><?= set_value('deskripsi', $produk['deskripsi']) ?></textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Simpan Perubahan</button>
                        <a href="<?= base_url('admin/produk') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewImage(event) {
    const input = event.target;
    const previewContainer = document.getElementById('livePreviewContainer');
    const imgPreview = document.getElementById('imgPreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imgPreview.src = e.target.result;
            previewContainer.classList.remove('d-none'); // Tampilkan kotak preview
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        imgPreview.src = '#';
        previewContainer.classList.add('d-none'); // Sembunyikan jika tidak ada file
    }
}
</script>