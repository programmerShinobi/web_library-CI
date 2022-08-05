<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4><?= $title; ?></h4>
  <div class="card">
    <div class="card-body">
      <a href="" data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm mb-3">Tambah buku</a>
      <a href="<?= base_url('listBuku') ?>" class="btn btn-warning btn-sm mb-3">Refresh data</a>
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="data">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul Buku</th>
              <th>Nomor SKU</th>
              <th>Penulis</th>
              <th>Penerbit</th>
              <th>Kategori</th>
              <th>Tahun Terbit</th>
              <th>Tebal Buku</th>
              <th>Foto Buku</th>
              <th>Status</th>
              <th>Status Jual</th>
              <th>Stok Buku</th>
              <th>Harga Buku</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($buku as $b) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $b->buku_judul; ?></td>
              <td><?= $b->buku_noSKU; ?></td>
              <td><?= $b->buku_penulis; ?></td>
              <td><?= $b->penerbit_judul; ?></td>
              <td><?= $b->kategori_judul; ?></td>
              <td><?= $b->buku_tahunTerbit; ?></td>
              <td><?= $b->buku_tebal; ?></td>
              <td>
                <img src="<?= base_url('vendor/img/buku/'.$b->buku_foto); ?>" alt="Foto Buku" class="gbr-buku-admin">
              </td>
              <td><?php
                if($b->buku_status == 1) {
                  echo '<div class="badge badge-success">Ready</div>';
                } elseif($b->buku_status == 2) {
                  echo '<div class="badge badge-info">Booked</div>';
                } elseif($b->buku_status == 3) {
                  echo '<div class="badge badge-warning text-dark">Dipinjam</div>';
                } elseif($b->buku_status == 4) {
                  echo '<div class="badge badge-primary">Dibeli</div>';
                } elseif($b->buku_status == 5) {
                  echo '<div class="badge badge-secondary">Akan dibeli</div>';
                }
              ?></td>
              <td>
                <?php
                  if($b->buku_jual == 1) {
                    echo '<div class="badge badge-success">Akan dijual</div>';
                  } elseif($b->buku_jual == 2) {
                    echo '<div class="badge badge-info">Hanya dipinjam</div>';
                  }
                ?>
              </td>
              <td><?= $b->buku_stok; ?></td>
              <td>Rp. <?= number_format($b->buku_harga,'0',',','.'); ?></td>
              <td>
                <a href="<?= base_url('editBuku/'.$b->buku_id); ?>" class="btn btn-info btn-sm mb-2">Edit</a>
                <a href="<?= base_url('hapusBuku/'.$b->buku_id); ?>" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="add">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Tambah Buku</h5>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('addBuku'); ?>
        <div class="form-group">
          <label>Judul Buku</label>
          <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Nomor SKU</label>
          <input type="number" name="sku" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Penulis</label>
          <input type="text" name="penulis" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Penerbit</label>
          <select name="penerbit" class="form-control">
            <option disabled selected>-- Pilih Penerbit --</option>
            <?php foreach($penerbit as $p) { ?>
            <option value="<?= $p->penerbit_id ?>"><?= $p->penerbit_judul ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select name="kategori" class="form-control">
            <option disabled selected>-- Pilih Kategori --</option>
            <?php foreach($kategori as $k) { ?>
            <option value="<?= $k->kategori_id ?>"><?= $k->kategori_judul ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Tahun Terbit</label>
          <input type="number" name="tahun" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Tebal (Halaman)</label>
          <input type="number" name="tebal" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Foto Buku</label>
          <input type="file" name="foto" class="form-control">
        </div>
        <div class="form-group">
          <label>Stok Buku</label>
          <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Harga Buku</label>
          <input type="number" name="harga" value="0" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Status Buku</label>
          <select name="status" class="form-control" required>
            <option selected disabled>-- Pilih status buku --</option>
            <option value="1">Ready</option>
            <option value="5">Akan dibeli</option>
          </select>
        </div>
        <div class="form-group">
          <label>Status Jual</label>
          <select name="jual" class="form-control" required>
            <option selected disabled>-- Pilih status jual --</option>
            <option value="1">Dijual</option>
            <option value="2">Hanya dipinjam</option>
          </select>
        </div>
        <input type="submit" value="Simpan" class="btn btn-success btn-sm">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
      </div>
    </div>
  </div>
</div>