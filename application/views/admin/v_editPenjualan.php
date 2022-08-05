<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Edit Pembelian</h4>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <?= form_open('editPembelian'); ?>
            <div class="form-group">
              <label>Nomor Transaksi</label>
              <input type="number" name="transaksi" value="<?= $p->penjualan_noId; ?>" class="form-control" disabled>
            </div>
            <div class="form-group">
              <label>User</label>
              <select name="user" class="form-control" required>
                <option disabled selected>-- Pilih User --</option>
                <?php foreach($user as $u) : ?>
                <option <?php if($p->penjualan_user == $u->user_id) { echo 'selected'; } ?> value="<?= $u->user_id; ?>"><?= $u->user_noId; ?> - <?= $u->user_nama; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Buku</label>
              <select name="buku" class="form-control" required>
                <option disabled selected>-- Pilih Buku --</option>
                <?php foreach($buku as $b) : ?>
                <option <?php if($p->penjualan_buku == $b->buku_id) { echo 'selected'; } ?> value="<?= $b->buku_id; ?>"><?= $b->buku_noSKU; ?> - <?= $b->buku_judul; ?> - Rp. <?= number_format($b->buku_harga,'0',',','.'); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="hidden" name="id" value="<?= $p->penjualan_id; ?>">
              <input type="number" name="jumlah" class="form-control" value="<?= $p->penjualan_jumlah; ?>">
              <?= form_error('jumlah','<small class="text-danger">','</small>'); ?>
            </div>
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" name="tgl" class="form-control" value="<?= $p->penjualan_tanggal; ?>" required>
            </div>
            <input type="submit" value="Simpan" class="btn btn-success btn-sm">
            <input type="submit" value="Batalkan" name="cancel" class="btn btn-danger btn-sm">
          <?= form_close(); ?>          
        </div>
      </div>
    </div>
  </div>
</div>