<?= $this->session->flashdata('pesan'); ?>
<div class="container-fluid">
  <h4>Pengembalian Buku</h4>
  <div class="row"> 
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <?= form_open('validation_peminjaman_kembali'); ?>
            <div class="form-group">
              <label>Nama</label>
              <input type="hidden" name="peminjaman_user" value="<?= $peminjaman->peminjaman_user; ?>">
              <input type="text" name="" class="form-control" value="<?= $peminjaman->user_nama; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Buku</label>
              <input type="hidden" name="peminjaman_buku" value="<?= $peminjaman->peminjaman_buku; ?>">
              <input type="text" name="" class="form-control" value="<?= $peminjaman->buku_judul; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Jumlah Peminjaman</label>
              <input type="hidden" name="peminjaman_id" value="<?= $peminjaman->peminjaman_id; ?>">
              <input type="number" name="peminjaman_jumlah" class="form-control" value="<?= $peminjaman->peminjaman_jumlah; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Tanggal Peminjaman</label>
              <input type="date" name="peminjaman_dari" class="form-control" value="<?= $peminjaman->peminjaman_dari; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Tanggal Pengembalian</label>
              <input type="date" name="peminjaman_sampai" class="form-control" value="<?= $peminjaman->peminjaman_sampai; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Tanggal Dikembalikan</label>
              <input type="text" name="" class="form-control" value="<?= date('d/m/Y'); ?>" readonly>
              <input type="hidden" name="peminjaman_kembali" class="form-control" value="<?= date('Y/m/d'); ?>">
            </div>
            <input type="submit" value="Simpan" class="btn btn-success btn-sm">
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>