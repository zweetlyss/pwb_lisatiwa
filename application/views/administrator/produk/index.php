<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><?= html_escape($title) ?></h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <a href="<?= base_url('admin/produk/tambah') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($produk)): ?>
                                <?php $no = 1; foreach ($produk as $p): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= html_escape($p['nama']) ?></td>
                                        <td><?= html_escape($p['nama_kategori'] ?? 'Tanpa Kategori') ?></td>
                                        <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                                        <td class="text-center"><?= $p['stok'] ?? 0 ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('admin/produk/ubah/' . $p['id_produk']) ?>" class="btn btn-warning btn-xs">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/produk/hapus/' . $p['id_produk']) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data produk.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>