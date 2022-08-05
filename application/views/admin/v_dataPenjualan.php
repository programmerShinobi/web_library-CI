<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Data Pembelian User</h4>
  <div class="card">
    <div class="card-body">
      <a href="" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#add">Tambah Data Pembelian</a>
      <a href="<?= base_url('excelPenjualan'); ?>" class="btn btn-success btn-sm mb-4" target="_blank">Export ke Excel</a>
      <a href="" class="btn btn-info btn-sm mb-4" data-toggle="modal" data-target="#addEx">Import data Excel</a>
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataVisibility">
          <thead>
            <tr>
              <th width="1%">#</th>
              <th>Nomor Transaksi</th>
              <th>User</th>
              <th>Buku</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($penjualan as $p) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td>PMB - <?= $p->penjualan_noId; ?></td>
              <td><?= $p->user_nama; ?> - <?= $p->user_noId; ?></td>
              <td><?= $p->buku_judul; ?> - <?= $p->buku_noSKU; ?></td>
              <td><?= $p->penjualan_jumlah; ?></td>
              <td>Rp. <?= number_format($p->penjualan_harga,'0',',','.'); ?></td>
              <td><?= date('d M Y', strtotime($p->penjualan_tanggal)); ?></td>
              <td>
                <a href="<?= base_url('deletePembelian/'.$p->penjualan_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')">Hapus</a>
                <a href="<?= base_url('editPembelian/'.$p->penjualan_id); ?>" class="btn btn-info btn-sm">Edit</a>
              </td>
            </tr>
            <?php endforeach; ?>
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
        <h4>Tambah Pembelian</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?= form_open('insertPembelian'); ?>
          <div class="form-group">
            <label>User</label>
            <select name="user" class="form-control" required>
              <option disabled selected>-- Pilih User --</option>
              <?php foreach($user as $u) : ?>
              <option value="<?= $u->user_id; ?>"><?= $u->user_noId; ?> - <?= $u->user_nama; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Buku</label>
            <select name="buku" class="form-control" required>
              <option disabled selected>-- Pilih Buku --</option>
              <?php foreach($buku as $b) : ?>
              <option value="<?= $b->buku_id; ?>"><?= $b->buku_noSKU; ?> - <?= $b->buku_judul; ?> - Rp. <?= number_format($b->buku_harga,'0',',','.'); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tgl" class="form-control" required>
          </div>
          <input type="submit" value="Simpan" class="btn btn-success btn-sm">
        <?= form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addEx">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Upload file excel</h5>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('uploadPenjualan') ?>
          <div class="form-group">
            <?= form_label('Unggah file excel'); ?>
            <?= form_upload('files','','class="form-control"'); ?>
          </div>
          <?= form_submit('','Upload','class="btn btn-success btn-sm"') ?>
        <?= form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
      </div>
    </div>
  </div>
</div>