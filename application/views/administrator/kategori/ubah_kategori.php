<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Kategori</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/kategori') ?>">Kategori</a></li>
            <li class="breadcrumb-item active">Ubah Kategori</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-3">Ubah Kategori</h5>

              <form method="post" class="mt-4">
                <div class="mb-3 form-group">
                  <label for="nama_kategori" class="form-label">Nama Kategori</label>
                  <input type="text" class="form-control" name="nama_kategori" id="nama_kategori"
                         value="<?= set_value('nama_kategori', $kategori['nama']) ?>">
                  <small class="text-danger"><em><?= form_error('nama_kategori') ?></em></small>
                </div>
                <div class="mb-3 form-group">
                  <label for="deskripsi_kategori" class="form-label">Deskripsi</label>
                  <textarea name="deskripsi_kategori" id="deskripsi_kategori" rows="10"
                            class="form-control"><?= set_value('deskripsi_kategori', $kategori['deskripsi']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="<?= base_url('admin/kategori') ?>" class="btn btn-danger">Kembali</a>
              </form>

            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div><!-- /.content-wrapper -->
